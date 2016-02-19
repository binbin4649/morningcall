<?php

/**
 * BcGmapsComponentのテスト
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Favorites Community <http://sites.google.com/site/baserFavorites/>
 *
 * @copyright   Copyright 2008 - 2015, baserCMS Favorites Community
 * @link      http://basercms.net baserCMS Project
 * @since     baserCMS v 3.0.0-beta
 * @license     http://basercms.net/license/index.html
 */
App::uses('BcGmapsComponent', 'Controller/Component');
App::uses('Controller', 'Controller');


/**
 * 偽コントローラ
 *
 * @package       Cake.Test.Case.Controller.Component
 */
class BcGmapsTestController extends Controller {

	public $components = array('BcGmaps');

}


class BcGmapsComponentTest extends BaserTestCase {

	public $fixtures = array();

	public $components = array('BcGmaps');

	public function setUp() {
		parent::setUp();

		// コンポーネントと偽のテストコントローラをセットアップする
		$request = new CakeRequest();
		$response = $this->getMock('CakeResponse');
		$this->Controller = new BcGmapsTestController($request, $response);

		$collection = new ComponentCollection();
		$collection->init($this->Controller);
		$this->BcGmaps = new BcGmapsComponent($collection);
		$this->BcGmaps->request = $request;
		$this->BcGmaps->response = $response;

		$this->Controller->Components->init($this->Controller);

		Router::reload();
		Router::connect('/:controller/:action/*');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->Controller);
		unset($this->BcGmaps);
	}


/**
 * Construct
 * 
 * @return void
 * @access private
 */
	public function test__construct() {
		$this->BcGmaps->__construct();
		$result = $this->BcGmaps->_baseUrl;
		$expected = "http://" . MAPS_HOST . "/maps/api/geocode/xml?";

		$this->assertEquals($expected, $result, 'APIのURLが正しくありません');
	}

/**
 * getInfoLocation
 *
 * @param string $address
 * @param string $city
 * @param string $state
 * @return boolean
 * @access public
 */
	public function testGetInfoLocation() {

		$result = $this->BcGmaps->getInfoLocation('東京タワー');
		$this->assertTrue($result, 'getInfoLocationで情報を取得できません');

		$lat = round($this->BcGmaps->getLatitude(), 1);
		$lng = round($this->BcGmaps->getLongitude(), 1);

		$this->assertEquals(35.7, $lat, '位置情報を正しく取得できません');
		$this->assertEquals(139.7, $lng, '位置情報を正しく取得できません');

		$result = $this->BcGmaps->getInfoLocation('');
		$this->assertFalse($result, 'getInfoLocationに空のアドレスにtrueが返ってきます');

	}

}
