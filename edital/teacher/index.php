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

$assets_src = '/../assets/';

?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $assets_src ?>css/toppage.css">
    <title>教諭トップページ</title>
</head>
<body>
    <header>
        <div class="content_box">
            <p><?= $login_user['display_name'] ?>先生、こんにちは！</p>
            <ul>
                <li><a href='./paper_list.php'>授業を行う</a></li>
                <li><a href='./result_list.php'>取組結果をみる</a></li>
            </ul>
        </div>
    </header>
    <main></main>
    <footer></footer>
</body>
</html>