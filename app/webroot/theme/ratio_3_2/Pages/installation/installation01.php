<!-- BaserPageTagBegin -->
<?php $this->BcBaser->setTitle('1. テーマの初期データを読み込む') ?>
<?php $this->BcBaser->setDescription('') ?>
<?php $this->BcBaser->setPageEditLink(13) ?>
<!-- BaserPageTagEnd -->

<div class="thumbnail"><img align="" alt="ratio_3_2_install.jpg" class="img-responsive" src="/theme/ratio_3_2/img/default/ratio_3_2_install__large.jpg" width="760" /></div>

<p>管理画面の「テーマ管理 &gt; テーマ一覧」へ移動し、「ratio_3_2」テーマを有効にしてください。</p>

<p>このテーマは、ふたつの初期データを持っています。<br />
「default」には、テーマの紹介やこの導入手順が書かれています。テーマをいろいろと試してみたいときに読み込んでください。<br />
もう作成するサイトが決まっている場合は、余分なデータが入っていない<strong>「blank」</strong>を読み込んでください。</p>

<h2>初期データで使用されている画像について</h2>

<p>ページ内の画像や、サイドメニューの「べっしーのバナー」は、baserCMSがドメインのルートディレクトリ以外に設置していると表示されません。<br />
管理画面の「固定ページ管理」「ウィジェット管理」で、画像が表示されていないimg要素のsrc属性の「サーバーパス」を、設置したサイトでリンクがつながるよう変更してください。</p>

<p>例：サイト内の「abc」ディレクトリに設置した場合<br />
/theme/ratio_3_2/img/default/&hellip;<br />
&rarr;　<strong>/abc/theme/ratio_3_2/img/default/&hellip;</strong></p>