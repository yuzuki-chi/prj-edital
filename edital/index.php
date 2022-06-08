<?php
use YuzuLib\YuzuLib\DrawCanvas\Canvas;

require_once(__DIR__ . '/../vendor/autoload.php');

$a = new Canvas(100, 300);
echo $a->drawCanvas();

?>
<h2>児童向け画面</h2>
<ul>
    <li>問題一覧画面</li>
    <li>問題画面（提出ボタン）</li>
</ul>
<h2>教員向け画面</h2>
<ul>
    <li>問題一覧表示画面</li>
    <li>解いた児童一覧画面</li>
    <li>個別の解答画面（時間と過程を収集）</li>
</ul>