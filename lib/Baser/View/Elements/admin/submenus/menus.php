<?php
/**
 * [ADMIN] メニュー用のメニュー
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2014, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2014, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
?>


<tr>
	<th>メニュー管理メニュー</th>
	<td>
		<ul class="cleafix">
			<li><?php $this->BcBaser->link('メニュー一覧', array('controller' => 'menus', 'action' => 'index')) ?></li>
			<li><?php $this->BcBaser->link('メニュー新規追加', array('controller' => 'menus', 'action' => 'add')) ?></li>
		</ul>
	</td>
</tr>
