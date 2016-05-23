<?php

/**
 * BcUtilクラスのテスト
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2015, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @since			baserCMS v 3.1.0-beta
 * @license			http://basercms.net/license/index.html
 */
App::uses('BcUtil', 'Lib');
App::uses('BcAuthComponent', 'Controller/Component');


/**
 * BcUtilTest class
 * 
 * @package Baser.Test.Case.Lib
 */
class BcUtilTest extends BaserTestCase {
/**
 * Fixtures
 * @var array
 */
	public $fixtures = array(
		'baser.Default.SiteConfig'
	);

/**
 * set up
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->util = new BcUtil();
	}

	public function tearDown() {
		unset($this->util);
		parent::tearDown();
	}


/**
 * 管理システムかチェック
 * 
 * @param string $url 対象URL
 * @param bool $expect 期待値
 * @dataProvider isAdminSystemDataProvider
 */
	public function testIsAdminSystem($url, $expect) {
		Configure::write('BcRequest.pureUrl', $url);
		$result = $this->util->isAdminSystem();

		$this->assertEquals($expect, $result, '正しく管理システムかチェックできません');
	}

/**
 * isAdminSystem用データプロバイダ
 *
 * @return array
 */
	public function isAdminSystemDataProvider() {
		return array(
			array('admin', true),
			array('/admin', false),
			array('admin/', true),
			array('hoge', false),
			array('hoge/', false),
		);
	}

/**
 * 管理ユーザーかチェック
 * 
 * @param string $usergroup ユーザーグループ名
 * @param bool $expect 期待値
 * @dataProvider isAdminUserDataProvider
 */
	public function testIsAdminUser($usergroup, $expect) {
		// 偽装ログイン
		session_id('baser');  // 適当な文字列を与え強制的にコンソール上でセッションを有効にする
		$this->util->Session = new CakeSession();
		$this->util->Session->write('Auth.User.UserGroup.name', $usergroup);

		$result = $this->util->isAdminUser();
		$this->assertEquals($expect, $result, '正しく管理ユーザーがチェックできません');
	}

/**
 * isAdminUser用データプロバイダ
 *
 * @return array
 */
	public function isAdminUserDataProvider() {
		return array(
			array('admins', true),
			array('hoge', false),
			array('', false),
		);
	}

/**
 * ログインユーザーのデータを取得する
 */
	public function testLoginUser() {
		// ログインしていない場合
		$result = $this->util->loginUser();
		$this->assertNull($result, 'ログインユーザーのデータを正しく取得できません');

		// ログインしている場合
		session_id('baser');  // 適当な文字列を与え強制的にコンソール上でセッションを有効にする
		$this->util->Session = new CakeSession();
		$this->util->Session->write('Auth.User.name', 'admin');

		$result = $this->util->loginUser();
		$this->assertEquals($result['name'], 'admin', 'ログインユーザーのデータを正しく取得できません');
	}

/**
 * ログインしているユーザー名を取得
 */
	public function testLoginUserName() {
		// ログインしていない場合
		$result = $this->util->loginUserName();
		$this->assertEmpty($result, 'ログインユーザーのデータを正しく取得できません');

		// ログインしている場合
		session_id('baser'); // 適当な文字列を与え強制的にコンソール上でセッションを有効にする
		$this->util->Session = new CakeSession();
		$this->util->Session->write('Auth.User.name', 'hoge');
		$result = $this->util->loginUserName();
		$this->assertEquals('hoge', $result, 'ログインユーザーのデータを正しく取得できません');
	}

/**
 * ログインしているユーザーのセッションキーを取得
 */
	public function testGetLoginUserSessionKey() {
		// セッションキーを未設定の場合
		$result = $this->util->getLoginUserSessionKey();
		$this->assertEquals('User', $result, 'セッションキーを取得を正しく取得できません');
		
		// セッションキーを設定した場合
		BcAuthComponent::$sessionKey = 'Auth.Hoge';
		$result = $this->util->getLoginUserSessionKey();
		$this->assertEquals($result, 'Hoge', 'セッションキーを取得を正しく取得できません');
	}


/**
 * テーマ梱包プラグインのリストを取得する
 */
	public function testGetCurrentThemesPlugins() {
		// プラグインが存在しない場合(デフォルトのbccolumn)
		$result = $this->util->getCurrentThemesPlugins();
		$expect = array();
		$this->assertEquals($expect, $result, 'テーマ梱包プラグインのリストを正しく取得できません');

		// プラグインが存在する場合
		// ダミーのプラグインディレクトリを作成
		$theme = Configure::read('BcSite.theme');
		$path = BASER_THEMES . $theme . DS . 'Plugin';
		$Folder = new Folder();
		$Folder->create($path . DS . 'dummy1');
		$Folder->create($path . DS . 'dummy2');

		$result = $this->util->getCurrentThemesPlugins();
		// ダミーのプラグインディレクトリを削除
		$Folder->delete($path);

		$expect = array('dummy1', 'dummy2');
		$this->assertEquals($expect, $result, 'テーマ梱包プラグインのリストを正しく取得できません');
	}
	
/**
 * スキーマ情報のパスを取得する
 */
	public function testGetSchemaPath() {
		// Core
		$result = $this->util->getSchemaPath();
		$this->assertEquals(BASER_CONFIGS . 'Schema', $result, 'Coreのスキーマ情報のパスを正しく取得できません');

		// Blog
		$result = $this->util->getSchemaPath('Blog');
		$this->assertEquals(BASER_PLUGINS . 'Blog/Config/Schema', $result, 'プラグインのスキーマ情報のパスを正しく取得できません');
	}
	
/**
 * 初期データのパスを取得する
 * 
 * 初期データのフォルダは アンダースコア区切り推奨
 * 
 * @param string $plugin プラグイン名
 * @param string $theme テーマ名
 * @param string $pattern 初期データの類型
 * @param string $expect 期待値
 * @dataProvider getDefaultDataPathDataProvider
 */
	public function testGetDefaultDataPath($plugin, $theme, $pattern, $expect) {
		$isset_ptt = isset($pattern) && isset($theme);
		$isset_plt = isset($plugin) && isset($theme);
		$isset_plptt = isset($plugin) && isset($pattern) && isset($theme);
		$Folder = new Folder();
		
		// 初期データ用のダミーディレクトリを作成
		if ($isset_ptt) {
			$Folder->create(BASER_THEMES . $theme . DS . 'Config' . DS . 'data' . DS . $pattern);
		}
		if ($isset_plt && !$isset_plptt) {
			$Folder->create(BASER_THEMES . $theme . DS . 'Config' . DS . 'data' . DS . 'default' . DS . $plugin);
		}
		if ($isset_plptt) {
			$Folder->create(BASER_THEMES . $theme . DS . 'Config' . DS . 'data' . DS . $pattern . DS . $plugin);
		}

		$result = $this->util->getDefaultDataPath($plugin, $theme, $pattern);

		// 初期データ用のダミーディレクトリを削除
		if ($isset_ptt) {
			$Folder->delete(BASER_THEMES . $theme . DS . 'Config' . DS . 'data' . DS . $pattern);
		}
		if ($isset_plt && !$isset_plptt) {
			$Folder->delete(BASER_THEMES . $theme . DS . 'Config' . DS . 'data' . DS . 'default' . DS . $plugin);
		}
		if ($isset_plptt) {
			$Folder->delete(BASER_THEMES . $theme . DS . 'Config' . DS . 'data' . DS . $pattern . DS . $plugin);
		}

		$this->assertEquals($expect, $result, '初期データのパスを正しく取得できません');
	}

/**
 * getDefaultDataPath用データプロバイダ
 *
 * @return array
 */
	public function getDefaultDataPathDataProvider() {
		return array(
			array(null, null, null, BASER_CONFIGS . 'data/default'),
			array(null, 'nada-icons', null, BASER_THEMES . 'nada-icons/Config/data/default'),
			array(null, 'nada-icons', 'not_default', BASER_THEMES . 'nada-icons/Config/data/not_default'),
			array('Blog', null, null, BASER_PLUGINS . 'Blog/Config/data/default'),
			array('Blog', 'nada-icons', null, BASER_THEMES . 'nada-icons/Config/data/default/Blog'),
			array('Blog', 'nada-icons', 'not_default', BASER_THEMES . 'nada-icons/Config/data/not_default/Blog'),
		);
	}

/**
 * シリアライズ / アンシリアライズ
 */
	public function testSerialize() {
		// BcUtil::serialize()でシリアライズした場合
		$serialized = $this->util->serialize('hoge');
		$result = $this->util->unserialize($serialized);
		$this->assertEquals('hoge', $result, 'BcUtil::serialize()で正しくシリアライズ/アンシリアライズできません');

		// serialize()のみでシリアライズした場合
		$serialized = serialize('hoge');
		$result = $this->util->unserialize($serialized);
		$this->assertEquals('hoge', $result, 'serializeのみで正しくシリアライズ/アンシリアライズできません');

	}

}