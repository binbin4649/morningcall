<?php

/**
 * run all baser lib tests
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2015, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @since			baserCMS v 3.1.0-beta
 * @license			http://basercms.net/license/index.html
 */

/**
 * @package Baser.Test.Case
 */
class BcAllLibTest extends CakeTestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Lib tests');
		$suite->addTestDirectory(BASER_TEST_CASES . DS . 'Lib' . DS);
		return $suite;
	}

}
