<?php

/**
 * teacher/realtime.php
 * 授業中の教諭用画面
 */

session_start();
$login_user = $_SESSION['login_user'];

if (!isset($_GET['qid'])) header('Location: /teacher/paper_list.php');

//TODO
// ~~~ いずれひとつにまとめてください ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$url = 'http:///192.168.179.60/api/student/state/' . '10'; //10はclass_id

$header = [
    // headerに追加したい情報
    // 例）
    // “Content-Type: application/json”,
    // “Accept: application/json”,
    // “Authorization: Bearer HogeHoge”
];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡

$active_students = curl_exec($curl);
$errno = curl_errno($curl);
curl_close($curl);

if ($errno !== CURLE_OK) {
    echo "ERR";
}

$active_students = json_decode($active_students, true);

// var_dump(($active_students));

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

?>
<!DOCTYPE html>
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