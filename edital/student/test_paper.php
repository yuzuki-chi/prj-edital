<?php
/**
 * student/paper.php
 * 児童がテストに解答するための画面
 */

if (!isset($_GET['qid'])) header('Location: /student/paper_list.php');

session_start();
$login_user = $_SESSION['login_user'];

$assets_src = '/../assets/';

//TODO
// ~~~ いずれひとつにまとめてください ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$url = 'http:///192.168.179.60/api/question/id/'.$_GET['qid'];

$header = [
    // headerに追加したい情報
    // 例）
    // “Content-Type: application/json”,
    // “Accept: application/json”,
    // “Authorization: Bearer HogeHoge”
    ];
$curl=curl_init();
curl_setopt($curl,CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡

$question= curl_exec($curl);

// エラーハンドリング用
$errno = curl_errno($curl);
// コネクションを閉じる
curl_close($curl);

// エラーハンドリング
if ($errno !== CURLE_OK) {
    echo "ERR";
}

$question = json_decode($question, true);

// var_dump(($question));

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//student_idの人がアクティブになる
$url = 'http:///192.168.179.60/api/student/updateState/'. $login_user['id'] . '/1';
// echo $login_user['id'];
$params= [
    'test' => 'test'
    ];
    $header = [
    // headerに追加したい情報
    // 例）
    // “Content-Type: application/json”,
    // “Accept: application/json”,
    // “Authorization: Bearer HogeHoge”
    ];
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
    
    $output= curl_exec($curl);
    
    // エラーハンドリング用
    $errno = curl_errno($curl);
    // コネクションを閉じる
    curl_close($curl);
    
    // エラーハンドリング
    if ($errno !== CURLE_OK) {
        echo "ERR!";
    }
    // echo $output;
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $assets_src ?>css/mainpage.css">
    <link rel="stylesheet" href="<?= $assets_src . 'css/test_paper.css' ?>">
    <title>キャンバスモードテスト</title>
</head>

<body>
    <header>
        <div class="title">
            <h1><?= $question['grade'] ?>年生：<?= $question['title'] ?></h1>
            <h2><?= $question['subject'] ?></h2>
        </div>
        <div class="name"><?= $login_user['display_name'] ?>さん</div>
    </header>
    <main>
        <script>
            const student_id = <?= $login_user['id'] ?>;
            const test_id = <?= $_GET['qid'] ?>;
            var pen_mode = 1; //えんぴつ
            var stroke_start, stroke_end;
        </script>

        <!-- 白背景で、実際に描けるスペース -->
        <div class="whitepaper" id="whitepaper">
            <div style='position:relative; padding:30px;'>
    
                <!-- 作成された問題文 -->
                <?= $question['content'] ?>
                <!-- 作成された問題文：ここまで -->
    
                <canvas id='canvas' style='position:absolute; left:0; top:0;'>
                </canvas>
            </div>
        </div>

    </main>
    <footer>
        <div class='answer_box'>
            <div>答え</div>
            <ul>
                <li>1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
                <li>8</li>
                <li>9</li>
                <li>0</li>
                <li>.</li>
                <li>㎠</li>
            </ul>
        </div>
        <div class='tools'>
            <button id='mode_pen'>✏️えんぴつ</button>
            <button id='mode_erase'>🩹消しゴム</button>
            <input type="range" name="mode_range" id="mode_range" min=1 max=100 value=1>
            <button id='answer'>答えを入力する</button>
            <button id='submit'>提出する</button>
            <script src="<?= $assets_src . 'js/submit_button.js' ?>"></script>
        </div>
    </footer>


    <script src="<?= $assets_src . 'js/test_paper.js' ?>"></script>
</body>

</html>