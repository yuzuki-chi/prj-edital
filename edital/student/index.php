<?php
/**
 * student/index.php
 * 児童のトップページ
 */

session_start();
// if( !( isset($_SESSION['login_user']['id']) && isset($_SESSION['login_user']['display_name']) )) {
    if( isset($_GET['sid']) && isset($_GET['dn']))
    {
        $user = [
            'id'=>$_GET['sid'],
            'display_name'=>$_GET['dn']
        ];
        $_SESSION['login_user'] = $user;    
    } else {
        print("
        <script>
            alert('児童の情報を入力し直してください.'); 
            document.location = '/';
        </script>
        ");
    }
// }


$assets_src = '/../assets/';

?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $assets_src ?>css/toppage.css">
    <title>児童トップページ</title>
</head>
<body>
    <header>
        <div class="content_box">
            <p><?= $_SESSION['login_user']['display_name'] ?>さん、こんにちは！</p>
            <ul>
                <li><a href='paper_list.php'>授業を受ける</a></li>
                <li>成せき を見る</li>
            </ul>
        </div>
    </header>
    <main>
    </main>
    <footer></footer>
</body>
</html>