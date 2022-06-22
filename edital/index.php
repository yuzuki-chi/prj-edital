<?php
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
    <p>このプロジェクトは~~です.</p>

    <h2>バージョンについて</h2>
    <ul>
        <li>v0.0.1 ... 軸となる基本機能のみを実装したもの</li>
    </ul>

    <hr/>

    <h2>機能要件・ページ構成</h2>

    <h3>児童向け画面</h3>
    <ul>
        <li><a href="/student/paper_list.php">解くことができるテスト一覧を表示するページ</a></li>
        <li><a href="/student/paper.php">テストに取り組むためのページ</a></li>
    </ul>

    <h3>教諭向け画面</h3>
    <ul>
        <li><a href="/teacher/paper_list.php">テストを閲覧することができる科目ページ</a></li>
        <li><a href="/teacher/student_list.php">特定の科目から、実際にテストを提出した児童一覧を表示するページ</a></li>
        <li><a href="/teacher/paper.php">児童が解いたテストの解答結果を閲覧するページ</a></li>
    </ul>
</body>

</html>