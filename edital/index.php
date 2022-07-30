<?php

/**
 * index.php
 * 実験用トップページ. ここから『児童用』『教諭用』に分岐することができる
 */
require_once(__DIR__ . '/../vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project EDITAL</title>
</head>

<body>
    <h1>Project EDITAL</h1>

    <h2>このプロジェクトについて</h2>
    <p>このプロジェクトでは, 多忙化が進む小学校教諭の業務負担を軽減させるためのICTツールを作成しています. EDITAL(Digitalize of Education)では, 児童の取り組み方や成長する過程を見やすくするための機能を作っています.</p>

    <h2>バージョンについて</h2>
    <ul>
        <li>v0.0.1 ... 軸となる基本機能のみを実装したもの</li>
        <li>v0.0.2 ... 使用感アンケートを基に改良したもの</li>
    </ul>

    <hr />

    <h2>機能要件・ページ構成</h2>

    <h3>児童向け画面（現在は初期メンバーとして以下の２０人がいます）</h3>
    <ul>
        <li><a href='student?sid=1&dn=りんご'>りんごさん</a></li>
        <li><a href='student?sid=2&dn=みかん'>みかんさん</a></li>
        <li><a href='student?sid=3&dn=パプリカ'>パプリカさん</a></li>
        <li><a href='student?sid=4&dn=ぶどう'>ぶどうさん</a></li>
        <li><a href='student?sid=5&dn=いちご'>いちごさん</a></li>
        <li><a href='student?sid=6&dn=れもん'>れもんさん</a></li>
        <li><a href='student?sid=7&dn=さくらんぼ'>さくらんぼさん</a></li>
        <li><a href='student?sid=8&dn=にんじん'>にんじんさん</a></li>
        <li><a href='student?sid=9&dn=ねぎ'>ねぎさん</a></li>
        <li><a href='student?sid=10&dn=ぶろっこりー'>ぶろっこりーさん</a></li>
        <li><a href='student?sid=11&dn=はくさい'>はくさいさん</a></li>
        <li><a href='student?sid=12&dn=れたす'>れたすさん</a></li>
        <li><a href='student?sid=13&dn=とまと'>とまとさん</a></li>
        <li><a href='student?sid=14&dn=きゃべつ'>きゃべつさん</a></li>
        <li><a href='student?sid=15&dn=ますかっと'>ますかっとさん</a></li>
        <li><a href='student?sid=16&dn=すいか'>すいかさん</a></li>
        <li><a href='student?sid=17&dn=めろん'>めろんさん</a></li>
        <li><a href='student?sid=18&dn=いーぶい'>いーぶいさん</a></li>
        <li><a href='student?sid=19&dn=うさぎ'>うさぎさん</a></li>
        <li><a href='student?sid=20&dn=ねこ'>ねこさん</a></li>
    </ul>

    <h3>教諭向け画面（現在は初期メンバー１人です）</h3>
    <ul>
        <li><a href='teacher'>立石 凌 先生</a></li>
    </ul>
</body>

</html>