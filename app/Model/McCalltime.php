<?php
//App::uses('User', 'Model');

class McCalltime extends AppModel {

	public $name = 'McCalltime';

	public $useTable = 'mc_calltimes';

	//public $belongsTo = 'User';

	public function bulkSave($lastday, $yearmonth, $weekday_data, $holiday_data, $user_id){
		$today_month = date('Ym', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
		$today = (int)date('j');
		$save_time = 0;
		//設定を回す　再設定
		for($i = 1; $i <= $lastday; $i++){
			$judg = true;
			if($yearmonth == $today_month){
		    	if($i <= $today) $judg = false;
		    }
		    if($judg){
	    		if($this->isHoliday($yearmonth, $i)){
	    			$result = $this->saveCalltime($yearmonth.$i, $holiday_data, $user_id);
	    		}else{
	    			$result = $this->saveCalltime($yearmonth.$i, $weekday_data, $user_id);
	    		}
	    		$save_time = $save_time + $result;
	    	}
		}
		return $save_time;
	}

	public function isHoliday($yearmonth, $day){
		$nationalHoliday = Configure::read('morningcall.nationalHoliday');
		$year = substr($yearmonth, 0, 4);
		$month = substr($yearmonth, 4, 2);
		$datetime = date_create();
	    date_date_set($datetime, $year, $month, $day);
	    $w = (int)date_format($datetime, 'w');
	    $judg = false;
		if($w == 0 or $w == 6) $judg = true;
		foreach($nationalHoliday as $key=>$value){
	    	if($key == $yearmonth.$day) $judg = true;
	    }
	    return $judg;
	    // true:休日　false:平日
	}

	public function bulkClean($lastday, $yearmonth, $user_id){
		$today_month = date('Ym', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
		$today = (int)date('j');
		//設定を一旦削除
		for($i = 1; $i <= $lastday; $i++){
			$judg = true;
			if($yearmonth == $today_month){
		    	if($i <= $today) $judg = false;
		    }
		    if($judg){
	    		$result = $this->cleanReserve($yearmonth.$i, $user_id);
	    	}
		}
	}

	public function cleanReserve($date, $user_id){
		$calltime = $this->find('first', array(
			'conditions' => array(
				"Calltime.user_id" => $user_id,
				"Calltime.date" => $date,
			),
			'recursive' => -1
		));
		/*
		if($calltime){
			if($calltime['Calltime']['call_time'] >= 1){
				return false;
			}else{
				$calltime['Calltime']['reserve'] = '';
				if($this->save($calltime)){
					return true;
				}else{
					return false;
				}	
			}
		}
		*/
		if($calltime['Calltime']['call_time'] >= 1){
			return false;
		}elseif($calltime){
			$calltime['Calltime']['reserve'] = '';
			if($this->save($calltime)){
				return true;
			}else{
				return false;
			}
		}
	}

	public function saveCalltime($date, $value, $user_id){
		App::import('Model','Userinfo');
        $Userinfo = new Userinfo;
		$calltime = $this->find('first', array(
			'conditions' => array(
				"McCalltime.user_id" => $user_id,
				"McCalltime.date" => $date,
			),
			'recursive' => -1
		));
		$return = 0;
		$juge = true;
		if(!empty($calltime['McCalltime']['call_time'])){
			if($calltime['McCalltime']['call_time'] >= 1){
				$juge = false;
			}
		}
		if($juge){
			if($calltime){
				if(empty($value) and !empty($calltime['Calltime']['reserve'])){
					//設定を削除する場合、マイナス
					$Userinfo->creditMinus($user_id, $calltime['Calltime']['call_plan']);
					$calltime['Calltime']['call_plan'] = '';
				}elseif(!empty($value) and empty($calltime['Calltime']['reserve'])){
					//新たに設定する場合は、プラス
					$calltime['Calltime']['call_plan'] = $Userinfo->creditPlus($user_id);
					$return = 1;
				}
				$calltime['Calltime']['reserve'] = $value;
			}else{
				if(!empty($value)){
					//新規登録なので、プラス、いちようvalueが入ってることを確認
					$calltime['Calltime']['call_plan'] = $Userinfo->creditPlus($user_id);
					$return = 1;
					$calltime['Calltime']['user_id'] = $user_id;
					$calltime['Calltime']['date'] = $date;
					$calltime['Calltime']['reserve'] = $value;
					$this->create($calltime);
				}else{
					$calltime['Calltime']['user_id'] = $user_id;
					$calltime['Calltime']['date'] = $date;
					$this->create($calltime);
				}
			}
			if(empty($calltime['Calltime']['call_plan'])){
				$calltime['Calltime']['reserve'] = '';
			}
			if($this->save($calltime)){
				return $return;
			}else{
				return false;
			}
		}
	}

	public function makePhoneCall(){
		App::uses('QuizzesController', 'Controller');
		$quiz_controller = new QuizzesController();

		$date = date('Ymj');
		//$time = date('g:ia');
		$hour = date('g');
		$minute = date('i');
		$ampm = date('a');
		$m = substr($minute, 0, 1);
		$reserve = $hour.':'.$m.'0'.$ampm;

		//date( "Y-m-d H:i:s" , strtotime("-10 min") );
		$hour2 = date('g', strtotime("-10 min"));
		$minute2 = date('i', strtotime("-10 min"));
		$ampm2 = date('a', strtotime("-10 min"));
		$m2 = substr($minute2, 0, 1);
		$reserve2 = $hour2.':'.$m2.'0'.$ampm2;

		$hour3 = date('g', strtotime("-20 min"));
		$minute3 = date('i', strtotime("-20 min"));
		$ampm3 = date('a', strtotime("-20 min"));
		$m3 = substr($minute3, 0, 1);
		$reserve3 = $hour3.':'.$m3.'0'.$ampm3;

		$hour4 = date('g', strtotime("-30 min"));
		$minute4 = date('i', strtotime("-30 min"));
		$ampm4 = date('a', strtotime("-30 min"));
		$m4 = substr($minute4, 0, 1);
		$reserve4 = $hour4.':'.$m4.'0'.$ampm4;
		/*
		$calltimes = $this->find('all', array(
			'conditions' => array(
				"Calltime.date" => $date,
				"Calltime.run" => 0,
				"Calltime.reserve" => $reserve,
			),
			'recursive' => 1
		));
		*/
		$calltimes = $this->find('all', array(
			'conditions' => array(
				"Calltime.call_time <" => 4,//201500813
				"Calltime.date" => $date,
				"Calltime.run" => 0,
				array(
					'OR'=>array(
						array("Calltime.reserve" => $reserve),
						array("Calltime.reserve" => $reserve2),
						array("Calltime.reserve" => $reserve3),
						array("Calltime.reserve" => $reserve4),
					)
				),
			),
			'recursive' => 1
		));
		foreach($calltimes as $calltime){
			$quiz_controller->phoneCall($calltime);
		}
	}

	public function sparePhoneCall(){
		App::uses('QuizzesController', 'Controller');
		$quiz_controller = new QuizzesController();
		$calltimes = $this->find('all', array(
			'conditions' => array(
				"Calltime.call_time" => 4,
				"Calltime.run" => 0,//20150813
				"Calltime.mail_submit" => 0,
			),
			'recursive' => 1
		));
		foreach($calltimes as $calltime){
			$quiz_controller->spareCall($calltime);
		}
	}

	public function makeVoiceCache(){
		App::uses('QuizzesController', 'Controller');
		$quiz_controller = new QuizzesController();
		$date = date('Ymj');
		$hour = date('g', strtotime("+10 min"));
		$minute = date('i', strtotime("+10 min"));
		$ampm = date('a', strtotime("+10 min"));
		$m = substr($minute, 0, 1);
		$reserve = $hour.':'.$m.'0'.$ampm;
		$calltimes = $this->find('all', array(
			'conditions' => array(
				"Calltime.date" => $date,
				"Calltime.run" => 0,
				"Calltime.reserve" => $reserve
			),
			'recursive' => 1
		));
		foreach($calltimes as $calltime){
			$quiz_controller->startVoiceCache($calltime['Calltime']['id']);
			$quiz_controller->basicVoiceCache($calltime['Calltime']['id']);
			$quiz_controller->spareVoiceCache($calltime['Calltime']['id']);
		}
	}

	//そのユーザーの未実行のrunの件数を返す。または、設定されている件数を返す。
	public function unexecuted($user_id){
		$calltimes = $this->find('all', array(
			'conditions' => array(
				"McCalltime.user_id" => $user_id,
				"McCalltime.run" => 0,
				"McCalltime.call_time" => 0,
			),
			'recursive' => -1
		));
		$i = 0;
		foreach($calltimes as $calltime){
			if(!empty($calltime['Calltime']['reserve'])) $i = $i+1;
		}
		return $i;
	}

	// mypage_head.php で creditが合っているかチェックする
	public function creditCheck($info){
		App::import('Model','Userinfo');
		$Userinfo = new Userinfo;
		$calltimes = $this->find('all', array(
			'conditions' => array(
				"Calltime.user_id" => $info['user_id'],
				"Calltime.run" => 0,
				"Calltime.call_time" => 0,
			),
			'recursive' => -1
		));
		$check_point = 0;
		foreach($calltimes as $calltime){
			if(!empty($calltime['Calltime']['reserve'])){
				$call_point = $Userinfo->callPlanOfPoint($calltime['Calltime']['call_plan']);
				$check_point = $check_point + $call_point;
			}
		}
		if($info['credit'] == $check_point){
			return true;
		}else{
			$this->log('Calltime creditCheck 358 check_point:'.$check_point);
			$this->log($info);
			return false;
		}
	}

	//使わないかも
	public function callLog($calltime, $data){
		$date = date("Y年m月d日 H時i分s秒");
		$status = $this->CallStatus($data['CallStatus']);
		$push_log = $date.' from:'.$data['From'].' to:'.$data['To'].' '.$status;
		if(isset($data['Digits'])){
			$push_log .= ' Push:'.$data['Digits'];
		}
		$push_log .= "\n";
		$calltime['Calltime']['logdata'] = $calltime['Calltime']['logdata'].$push_log;
		$this->id = $calltime['Calltime']['id'];
		$fields = array('logdata');
		$this->save($calltime, false, $fields);
		$this->log($push_log);
		return $calltime;
	}

	public function basic($calltime){
		$calltime['Calltime']['run'] = 1;
		$this->id = $calltime['Calltime']['id'];
		$fields = array('run');
		$result = $this->save($calltime, false, $fields);
		if(!$result) $this->log($result);
		if(!$result) $this->log($calltime);
	}

	public function correct($calltime, $Digits){
		//calltimeに正解したかどうか？answerを保存
		$calltime['Calltime']['answer'] = 1;
		//番号が押されたのでcalltime終了
		$calltime['Calltime']['run'] = 1;
		//押された番号を保存
		$calltime['Calltime']['digits'] = $Digits;

		$this->id = $calltime['Calltime']['id'];
		$fields = array('answer', 'run', 'digits');
		$result = $this->save($calltime, false, $fields);
		if(!$result) $this->log($result);
		if(!$result) $this->log($calltime);
		return $calltime;
	}

	public function incorrect($calltime, $Digits){
		$calltime['Calltime']['answer'] = 2;
		$calltime['Calltime']['run'] = 1;
		$calltime['Calltime']['digits'] = $Digits;
		$this->id = $calltime['Calltime']['id'];
		$fields = array('answer', 'run', 'digits');
		$result = $this->save($calltime, false, $fields);
		if(!$result) $this->log($result);
		if(!$result) $this->log($calltime);
		return $calltime;
	}

	public function question($calltime, $quizzes_id){
		$calltime['Calltime']['quizzes_id'] = $quizzes_id;
		$this->id = $calltime['Calltime']['id'];
		$fields = array('quizzes_id');
		$result = $this->save($calltime, false, $fields);
		if(!$result) $this->log($result);
		if(!$result) $this->log($calltime);
		return $calltime;
	}

	//使わないかも
	public function callEndLog($data){
		$date = date("Y年m月d日 H時i分s秒");
		$calltime = $this->find('first', array(
			'conditions' => array(
				array(
					'OR'=>array(
						array("Calltime.callsid1" => $data['CallSid']),
						array("Calltime.callsid2" => $data['CallSid']),
						array("Calltime.callsid3" => $data['CallSid']),
						array("Calltime.callsid4" => $data['CallSid']),
						array("Calltime.callsid5" => $data['CallSid']),
					)
				),
			),
			'recursive' => 1
		));
		$this->log('Calltime:208 '.$calltime);
		$status = $this->CallStatus($data['CallStatus']);
		$push_log = $date.' from:'.$data['From'].' to:'.$data['To'].' '.$status;
		if(isset($data['Digits'])){
			$push_log .= ' Push:'.$data['Digits'];
		}
		$push_log .= "\n";
		$calltime['Calltime']['logdata'] = $calltime['Calltime']['logdata'].$push_log;
		$this->id = $calltime['Calltime']['id'];
		$fields = array('logdata');
		$result = $this->save($calltime, false, $fields);
	}

	public function CallStatus($eng_status){
		switch ($eng_status){
			case 'in-progress':
			  $status = '応答有、通話中。';
			  break;
			case 'canceled':
			  $status = '呼び出し中にキャンセル。';
			  break;
			case 'completed':
			  $status = '通話終了。';
			  break;
			case 'busy':
			  $status = 'ビジー信号を受信。';
			  break;
			case 'failed':
			  $status = '接続不可。番号が存在しない可能性有り。';
			  break;
			case 'no-answer':
			  $status = '応答無し、発信終了。';
			  break;
			case 'ringing':
			  $status = '呼び出し中。';
			  break;
			case 'queued':
			  $status = '通話、発信待ち。';
			  break;
			default:
			  $status = $eng_status;
		}
		return $status;
	}

	public function DetailReserve($user_id, $year, $month){
		$calltimes = $this->find('all', array(
			'conditions' => array("McCalltime.user_id" => $user_id, "McCalltime.date LIKE" => $year.$month.'%'),
			'recursive' => 1
		));
		foreach($calltimes as $key=>$calltime){
			$calltimes[$key]['Log'] = $this->viewLogFormat($calltime);
		}
		return $calltimes;
	}

	public function viewLogFormat($calltime, $save_log = null){
		App::uses('QuizzesController', 'Controller');
		$quiz_controller = new QuizzesController();
		$modified = strtotime(date($calltime['Calltime']['modified']));
		$quiz = $quiz_controller->findVal($calltime['Calltime']['quizzes_id']);
		if($calltime['Calltime']['call_plan'] == 'quiz'){
			if($quiz['true_number'] == 1){
				$ox = 'マル';
			}else{
				$ox = 'バツ';
			}
			if($calltime['Calltime']['answer'] == 1){
				$announce = '正解です。';
			}elseif($calltime['Calltime']['answer'] == 2){
				$announce = '不正解でした。';
			}else{
				$announce = '回答がありませんでした。';
			}
		}else{
			$ox = '';
			$announce = '';
		}
		$body = array(
        	'name' => $calltime['User']['real_name_1'],
        	'email' => $calltime['User']['email'],
        	'logdata' => $save_log,
        	'reserve' => $calltime['Calltime']['reserve'],
        	'date' => $calltime['Calltime']['date'],
        	'answer' => $calltime['Calltime']['answer'],
        	'question' => $quiz['question'],
        	'true_number' => $quiz['true_number'],
        	'digits' => $calltime['Calltime']['digits'],
        	'ox' => $ox,
        	'announce' => $announce,
        	'additional' => $quiz['additional'],
        	'call_plan' => $calltime['Calltime']['call_plan'],
        );
        return $body;
	}

	public function createLogFormat($calltime, $save_log = null){
		App::uses('QuizzesController', 'Controller');
		$quiz_controller = new QuizzesController();
		App::import('Model','Userinfo');
        $Userinfo = new Userinfo;
		$modified = strtotime(date($calltime['Calltime']['modified']));

		$quiz = $quiz_controller->findVal($calltime['Calltime']['quizzes_id']);
		$userinfo = $Userinfo->find('first', array(
			'conditions' => array("Userinfo.user_id" => $calltime['Calltime']['user_id']),
			'recursive' => -1
		));
		if($calltime['Calltime']['call_plan'] == 'quiz'){
			if($quiz['true_number'] == 1){
				$ox = 'マル';
			}else{
				$ox = 'バツ';
			}
			if($calltime['Calltime']['answer'] == 1){
				$announce = '正解です。 現在'.$userinfo['Userinfo']['continual'].'連チャン中です！';
			}elseif($calltime['Calltime']['answer'] == 2){
				$announce = '不正解でした。';
			}else{
				$announce = '回答がありませんでした。';
			}
		}else{
			$ox = '';
			$announce = '';
		}
		
		$body = array(
        	'name' => $calltime['User']['real_name_1'],
        	'email' => $calltime['User']['email'],
        	'logdata' => $save_log,
        	'reserve' => $calltime['Calltime']['reserve'],
        	'date' => $calltime['Calltime']['date'],
        	'answer' => $calltime['Calltime']['answer'],
        	'continual' => $userinfo['Userinfo']['continual'],
        	'question' => $quiz['question'],
        	'true_number' => $quiz['true_number'],
        	'digits' => $calltime['Calltime']['digits'],
        	'ox' => $ox,
        	'announce' => $announce,
        	'additional' => $quiz['additional'],
        	'call_plan' => $calltime['Calltime']['call_plan'],
        );
        return $body;
	}

	public function submitMail(){
		$calltimes = $this->find('all', array(
			'conditions' => array("Calltime.run" => 1, "Calltime.mail_submit" => 0),
			'recursive' => 1
		));
		if($calltimes) $this->submitMailMain($calltimes);
		$calltimes = $this->find('all', array(
			'conditions' => array("Calltime.call_time" => 5, "Calltime.mail_submit" => 0),
			'recursive' => 1
		));
		if($calltimes) $this->submitMailMain($calltimes);
	}

	public function submitMailMain($calltimes){
		App::uses('CalltimesController', 'Controller');
		$calltime_controller = new CalltimesController();
		App::uses('QuizzesController', 'Controller');
		$quiz_controller = new QuizzesController();
		App::import('Model','Pointbook');
        $PointbookModel = new Pointbook;

        /*
		$calltimes = $this->find('all', array(
			'conditions' => array("Calltime.run" => 1, "Calltime.mail_submit" => 0),
			'recursive' => 1
		));
		*/
		foreach($calltimes as $calltime){
			$modified = strtotime(date($calltime['Calltime']['modified']));
			$time_lag = time() - $modified;
			$progress = 60 * 30;
			if($time_lag > $progress){ //30分以上経過してたらメールを送信
				//$save_log = $calltime['Calltime']['logdata']; //そういや、ログは1回しか保存されないんだ。
				$save_log = '';
				if(!empty($calltime['Calltime']['callsid1'])){
					$save_log .= $quiz_controller->getLog($calltime['Calltime']['callsid1']);
				}
				if(!empty($calltime['Calltime']['callsid2'])){
					$save_log .= $quiz_controller->getLog($calltime['Calltime']['callsid2']);
				}
				if(!empty($calltime['Calltime']['callsid3'])){
					$save_log .= $quiz_controller->getLog($calltime['Calltime']['callsid3']);
				}
				if(!empty($calltime['Calltime']['callsid4'])){
					$save_log .= $quiz_controller->getLog($calltime['Calltime']['callsid4']);
				}
				if(!empty($calltime['Calltime']['callsid5'])){
					$save_log .= $quiz_controller->getLog($calltime['Calltime']['callsid5']);
				}
				//quizメール
				if($calltime['Calltime']['call_plan'] == 'quiz'){
					$body = $this->createLogFormat($calltime, $save_log);
					$calltime_controller->sendCallmail($body);
				}elseif($calltime['Calltime']['call_plan'] == 'basic'){
				//basicメール
					$body = $this->createLogFormat($calltime, $save_log);
					$calltime_controller->sendCallmailBasic($body);
				}
				$calltime['Calltime']['logdata'] = $save_log;
				$calltime['Calltime']['mail_submit'] = 1;
				$this->id = $calltime['Calltime']['id'];
				$fields = array('mail_submit', 'logdata');
				$this->save($calltime, false, $fields);
				$PointbookModel->run($calltime);
			}
		}
	}

	public function checkNextMonth(){
		App::import('Model','Userinfo');
        $Userinfo = new Userinfo;
        App::uses('CalltimesController', 'Controller');
		$calltime_controller = new CalltimesController();
        $userinfos = $Userinfo->find('all', array(
			'conditions' => array("Userinfo.point >" => '49'),
			//'conditions' => array("Userinfo.user_id" => 29),
			'recursive' => 1
		));
		foreach($userinfos as $userinfo){
			$diff = $userinfo['Userinfo']['point'] - $userinfo['Userinfo']['credit'];
			if($diff > 49){
				$i = $this->unexecuted($userinfo['Userinfo']['user_id']);
				if($i == 0){
					$body = array(
			        	'name' => $userinfo['User']['real_name_1'],
			        	'email' => $userinfo['User']['email'],
			        	'point' => $userinfo['Userinfo']['point'],
			        );
					$calltime_controller->infoNextMonth($body);
				}
			}
		}
	}


}
