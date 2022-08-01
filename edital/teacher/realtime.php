<?php

/**
 * teacher/realtime.php
 * 授業中の教諭用画面
 */

session_start();
$login_user = $_SESSION['login_user'];

if (!isset($_GET['qid'])) header('Location: /teacher/paper_list.php');

require_once('../lib/curl.php');

/** クラスIDから, アクティブな生徒を取得する */
$url = 'http:///192.168.179.60/api/student/state/' . '1'; //1はclass_id
$ret = curl_get($url);
if( $ret != false ) {
    $active_students = json_decode($active_students, true);
}
/** ---------------------------------- */

?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>授業中の画面</title>
</head>

<body>
    <script>
        const sid = <?= $login_user['id'] ?>;
        const qid = <?= $_GET['qid'] ?>;
    </script>

    <header>
        <div>戻る</div>
        <div>テストの進捗</div>
    </header>

    <main>
        <ul>
            <li><a href="realtime_progress.php?qid=<?= $_GET['qid'] ?>">進捗マップ</a></li>
            <li><a href="realtime_active.php?qid=<?= $_GET['qid'] ?>">活性マップ</a></li>
        </ul>
    </main>

    <footer>
    </footer>


    <script src="realtime.js"></script>
</body>

</html>