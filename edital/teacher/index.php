<?php
/**
 * teacher/index.php
 * 教諭側のトップページ
 */

session_start();
    
$user = [
    'id'=>100,
    'display_name'=>'立石 凌'
];
$_SESSION['login_user'] = $user;
$login_user = $_SESSION['login_user'];
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教諭トップページ</title>
</head>
<body>
    <h1><?= $login_user['display_name'] ?>先生、こんにちは！</h1>
    <ul>
        <li><a href='./paper_list.php'>授業を行う</a></li>
        <li><a href='./result_list.php'>取組結果をみる</a></li>
    </ul>
</body>
</html>