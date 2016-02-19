<!-- BaserPageTagBegin -->
<?php $this->BcBaser->setTitle('Bootstrapのサンプル') ?>
<?php $this->BcBaser->setDescription('') ?>
<?php $this->BcBaser->setPageEditLink(24) ?>
<!-- BaserPageTagEnd -->

<p>CSSフレームワーク「Bootstrap 3」の、このテーマのデザインに対応しているパーツのサンプルです。<br />
詳しい利用方法は下記を参照ください。</p>

<ul>
	<li><a href="http://getbootstrap.com/css/" target="_blank">http://getbootstrap.com/css/</a></li>
	<li><a href="http://getbootstrap.com/components/" target="_blank">http://getbootstrap.com/components/</a></li>
</ul>

<p class="text-danger">対応していないパーツのデザインを変更する場合は、テーマファイルの /css/style.css に追記してください。</p>

<h2 class="h3">.page-header</h2>

<p>コンテンツヘッダに利用されています。下のラインにテーマのメインカラーが反映されます。</p>

<div class="page-header">
<h1>ページの見出しです<small>添え字です</small></h1>
</div>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;div class=&quot;page-header&quot;&gt;
&lt;h1&gt;ページの見出しです&lt;small&gt;添え字です&lt;/small&gt;&lt;/h1&gt;
&lt;/div&gt;</textarea></p>

<h2 class="h3">.btn</h2>

<p>default・primary・info・linkが対応しています。</p>

<p><strong>default:</strong> ボーダーにテーマのリンクカラーが反映されます。<br />
<strong>primary:</strong> 背景にテーマのリンクカラーが反映されます。<br />
<strong>info:</strong> 背景にテーマのメインカラーが反映されます。<br />
<strong>link:</strong> フォームボタンなどに使用すると、通常のリンクと同じ見た目になります。</p>

<p><button class="btn btn-lg btn-default" type="button">Default</button>
　<button class="btn btn-lg btn-primary" type="button">Primary</button>
　<button class="btn btn-lg btn-success" type="button">Success</button>
　<button class="btn btn-lg btn-info" type="button">Info</button><br />
<button class="btn btn-lg btn-warning" type="button">Warning</button>
　<button class="btn btn-lg btn-danger" type="button">Danger</button>
　<button class="btn btn-lg btn-link" type="button">Link</button></p>

<p><button class="btn btn-default" type="button">Default</button>
　<button class="btn btn-primary" type="button">Primary</button>
　<button class="btn btn-success" type="button">Success</button>
　<button class="btn btn-info" type="button">Info</button>
　<button class="btn btn-warning" type="button">Warning</button>
　<button class="btn btn-danger" type="button">Danger</button>
　<button class="btn btn-link" type="button">Link</button></p>

<p><button class="btn btn-sm btn-default" type="button">Default</button>
　<button class="btn btn-sm btn-primary" type="button">Primary</button>
　<button class="btn btn-sm btn-success" type="button">Success</button>
　<button class="btn btn-sm btn-info" type="button">Info</button>
　<button class="btn btn-sm btn-warning" type="button">Warning</button>
　<button class="btn btn-sm btn-danger" type="button">Danger</button>
　<button class="btn btn-sm btn-link" type="button">Link</button></p>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;p&gt;&lt;button class=&quot;btn btn-lg btn-default&quot; type=&quot;button&quot;&gt;Default&lt;/button&gt;
　&lt;button class=&quot;btn btn-lg btn-primary&quot; type=&quot;button&quot;&gt;Primary&lt;/button&gt;
　&lt;button class=&quot;btn btn-lg btn-success&quot; type=&quot;button&quot;&gt;Success&lt;/button&gt;
　&lt;button class=&quot;btn btn-lg btn-info&quot; type=&quot;button&quot;&gt;Info&lt;/button&gt;&lt;br&gt;
&lt;button class=&quot;btn btn-lg btn-warning&quot; type=&quot;button&quot;&gt;Warning&lt;/button&gt;
　&lt;button class=&quot;btn btn-lg btn-danger&quot; type=&quot;button&quot;&gt;Danger&lt;/button&gt;
　&lt;button class=&quot;btn btn-lg btn-link&quot; type=&quot;button&quot;&gt;Link&lt;/button&gt;&lt;/p&gt;

&lt;p&gt;&lt;button class=&quot;btn btn-default&quot; type=&quot;button&quot;&gt;Default&lt;/button&gt;
　&lt;button class=&quot;btn btn-primary&quot; type=&quot;button&quot;&gt;Primary&lt;/button&gt;
　&lt;button class=&quot;btn btn-success&quot; type=&quot;button&quot;&gt;Success&lt;/button&gt;
　&lt;button class=&quot;btn btn-info&quot; type=&quot;button&quot;&gt;Info&lt;/button&gt;
　&lt;button class=&quot;btn btn-warning&quot; type=&quot;button&quot;&gt;Warning&lt;/button&gt;
　&lt;button class=&quot;btn btn-danger&quot; type=&quot;button&quot;&gt;Danger&lt;/button&gt;
　&lt;button class=&quot;btn btn-link&quot; type=&quot;button&quot;&gt;Link&lt;/button&gt;&lt;/p&gt;

&lt;p&gt;&lt;button class=&quot;btn btn-sm btn-default&quot; type=&quot;button&quot;&gt;Default&lt;/button&gt;
　&lt;button class=&quot;btn btn-sm btn-primary&quot; type=&quot;button&quot;&gt;Primary&lt;/button&gt;
　&lt;button class=&quot;btn btn-sm btn-success&quot; type=&quot;button&quot;&gt;Success&lt;/button&gt;
　&lt;button class=&quot;btn btn-sm btn-info&quot; type=&quot;button&quot;&gt;Info&lt;/button&gt;
　&lt;button class=&quot;btn btn-sm btn-warning&quot; type=&quot;button&quot;&gt;Warning&lt;/button&gt;
　&lt;button class=&quot;btn btn-sm btn-danger&quot; type=&quot;button&quot;&gt;Danger&lt;/button&gt;
　&lt;button class=&quot;btn btn-sm btn-link&quot; type=&quot;button&quot;&gt;Link&lt;/button&gt;&lt;/p&gt;</textarea></p>

<h2 class="h3">.label</h2>

<p>default・primary・infoが対応しています。</p>

<p><strong>default:</strong> ボーダーにテーマのリンクカラーが反映されます。<br />
<strong>primary:</strong> 背景にテーマのリンクカラーが反映されます。<br />
<strong>info:</strong> 背景にテーマのメインカラーが反映されます。</p>

<p><span class="label label-default">Default</span>
　<span class="label label-primary">Prmary</span>
　<span class="label label-success">Success</span>
　<span class="label label-info">Info</span>
　<span class="label label-warning">Warning</span>
　<span class="label label-danger">Danger</span></p>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;p&gt;
&lt;span class=&quot;label label-default&quot;&gt;Default&lt;/span&gt;
　&lt;span class=&quot;label label-primary&quot;&gt;Prmary&lt;/span&gt;
　&lt;span class=&quot;label label-success&quot;&gt;Success&lt;/span&gt;
　&lt;span class=&quot;label label-info&quot;&gt;Info&lt;/span&gt;
　&lt;span class=&quot;label label-warning&quot;&gt;Warning&lt;/span&gt;
　&lt;span class=&quot;label label-danger&quot;&gt;Danger&lt;/span&gt;
&lt;/p&gt;</textarea></p>

<h2 class="h3">.thumbnail</h2>

<div class="row">
<div class="col-sm-6 col-sm-push-3"><img class="thumbnail img-responsive" src="/theme/ratio_3_2/img/main_image_3.jpg" width="360" /></div>
</div>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;img class=&quot;thumbnail img-responsive&quot; src=&quot;画像のURL&quot; /&gt;</textarea></p>

<div class="row">
<div class="col-sm-6 col-sm-push-3">
<div class="thumbnail"><img class="img-responsive" src="/theme/ratio_3_2/img/main_image_3.jpg" width="360" />
<div class="caption">
<p class="mb0">説明文です説明文です説明文です説明文です説明文です説明文です</p>
</div>
</div>
</div>
</div>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;div class=&quot;thumbnail&quot;&gt;
&lt;img class=&quot;img-responsive&quot; src=&quot;画像のURL&quot; /&gt;
&lt;div class=&quot;caption&quot;&gt;
&lt;p class=&quot;mb0&quot;&gt;説明文です説明文です説明文です説明文です説明文です説明文です&lt;/p&gt;
&lt;/div&gt;
&lt;/div&gt;
</textarea></p>

<h2 class="h3">.alert</h2>

<p>フォームに利用されています。テーマのカラー設定は反映されません。別途スタイルを追加してください。</p>

<div class="alert alert-success"><strong>Well done!</strong> You successfully read this important alert message.</div>

<div class="alert alert-info"><strong>Heads up!</strong> This alert needs your attention, but it&#39;s not super important.</div>

<div class="alert alert-warning"><strong>Warning!</strong> Best check yo self, you&#39;re not looking too good.</div>

<div class="alert alert-danger"><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;div class=&quot;alert alert-success&quot;&gt;&lt;strong&gt;Well done!&lt;/strong&gt; You successfully read this important alert message.&lt;/div&gt;

&lt;div class=&quot;alert alert-info&quot;&gt;&lt;strong&gt;Heads up!&lt;/strong&gt; This alert needs your attention, but it&#39;s not super important.&lt;/div&gt;

&lt;div class=&quot;alert alert-warning&quot;&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Best check yo self, you&#39;re not looking too good.&lt;/div&gt;

&lt;div class=&quot;alert alert-danger&quot;&gt;&lt;strong&gt;Oh snap!&lt;/strong&gt; Change a few things up and try submitting again.&lt;/div&gt;</textarea></p>

<h2 class="h3">.well</h2>

<p>背景色にテーマのサブカラーが反映されます。</p>

<div class="well">
<p>吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。吾輩はここで始めて人間というものを見た。しかもあとで聞くとそれは書生という人間中で一番獰悪な種族であったそうだ。</p>
</div>

<p><textarea class="form-control" cols="100" readonly="readonly" rows="5">&lt;div class=&quot;well&quot;&gt;
&lt;p&gt;吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。吾輩はここで始めて人間というものを見た。しかもあとで聞くとそれは書生という人間中で一番獰悪な種族であったそうだ。&lt;/p&gt;
&lt;/div&gt;</textarea></p>

<h2 class="h3">.table</h2>

<p>利用できますが、テーマのカラー設定は反映されません。別途スタイルを追加してください。</p>

<table class="table">
	<caption>下線のみの表</caption>
	<thead>
		<tr>
			<th>thead/th</th>
			<th>thead/th</th>
			<th>thead/th</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
	</tbody>
</table>

<table class="table table-borderd">
	<caption>全体に罫線がある表</caption>
	<thead>
		<tr>
			<th>thead/th</th>
			<th>thead/th</th>
			<th>thead/th</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
	</tbody>
</table>

<table class="table table-condensed">
	<caption>ちょっとスリムな表</caption>
	<thead>
		<tr>
			<th>thead/th</th>
			<th>thead/th</th>
			<th>thead/th</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
	</tbody>
</table>

<table class="table table-responsive">
	<caption>レスポンシブ対応の表</caption>
	<thead>
		<tr>
			<th>thead/th</th>
			<th>thead/th</th>
			<th>thead/th</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
		<tr>
			<th>tbody/th</th>
			<td>tbody/td</td>
			<td>tbody/td</td>
		</tr>
	</tbody>
</table>