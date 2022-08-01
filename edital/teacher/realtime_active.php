<?php

/**
 * teacher/realtime.php
 * 授業中の教諭用画面
 */

session_start();
$login_user = $_SESSION['login_user'];
$assets_src = '/../assets/';

if (!isset($_GET['qid'])) header('Location: /teacher/paper_list.php');

require_once('../lib/curl.php');

/** クラスIDから, アクティブな生徒を取得する */
$url = 'http:///192.168.179.60/api/student/state/' . '1'; //1はclass_id
$ret = curl_get($url);
if( $ret != false ) {
    $active_students = json_decode($ret, true);
}
/** ---------------------------------- */

?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $assets_src ?>css/realtime.css">
    <title>授業中の画面</title>
</head>

<body>
    <script>
        const sid = <?= $login_user['id'] ?>;
        const qid = <?= $_GET['qid'] ?>;
    </script>

    <header>
        <div><a href="index.php" style="color:#FCDBC3">＜ 戻る</a></div>
        <div>テストの進捗</div>
    </header>

    <main>
        <div class="progress_map">
            <h1>活性マップ</h1>
            <ul>
                <?php
                foreach ($active_students as $student) {
                    $id = $student['id'];
                    echo "
                    <li label=" . $id . " style='display:flex;'>
                        <div>
                            ". $student['name'] . "
                        </div>
                        <div label=" . $id . ">0 秒</div>
                    </li>";
                }
                ?>
            </ul>
        </div>
    </main>

    <footer>
    </footer>

    <script src="realtime.js"></script>
</body>

</html>