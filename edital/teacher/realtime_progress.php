<?php

/**
 * teacher/realtime.php
 * 授業中の教諭用画面
 */

session_start();
$login_user = $_SESSION['login_user'];
$assets_src = '/../assets/';

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
            <h1>テストの進捗</h1>
            <ul>
                <?php
                foreach ($active_students as $student) {
                    echo "<li>";
                    echo $student['name'] . " さん";
                    // echo "=> /進捗/user_id";
                    echo "</li>";
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