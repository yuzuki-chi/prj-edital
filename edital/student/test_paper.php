<?php
/**
 * student/paper.php
 * 児童がテストに解答するための画面
 */

if (!isset($_GET['qid'])) header('Location: /student/paper_list.php');

session_start();
$login_user = $_SESSION['login_user'];

$assets_src = '/../assets/';

require_once('../lib/curl.php');

/** qidからテスト内容を取得する. */
$url = 'http:///192.168.179.60/api/question/id/' . $_GET['qid'];
$ret = curl_get( $url );
if($ret != false) {
    $question = json_decode( $ret , true );
}
/** ------------------------ */

/** ログイン中のアカウントをアクティブ状態にする */
$url = 'http:///192.168.179.60/api/student/updateState/'. $login_user['id'] . '/1';
$params= [];
curl_post($url, $params);
/** ------------------------ */

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