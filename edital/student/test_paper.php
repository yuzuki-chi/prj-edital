<?php

/**
 * student/paper.php
 * 児童がテストに解答するための画面
 */
session_start();
$login_user = $_SESSION['login_user'];

$assets_src = '/../assets/';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $assets_src . 'css/test_paper.css' ?>">
    <title>キャンバスモードテスト</title>
</head>

<body>
    <header>
        <h1>学年生：大きな単元名</h1>
        <h2>小さな単元名</h2>
        <div><?= $login_user['display_name'] ?>さん</div>
    </header>
    <main>
        <script>
            const student_id = <?= $login_user['id'] ?>;
            const test_id = <?= $_GET['qid'] ?>;
            var pen_mode = 1; //えんぴつ
            var stroke_start, stroke_end;
        </script>
        <div style='position:relative; height: 100vh;'>
            <h3>大問１</h3>
            <div>
                <div style='font-size: 32px'>問題文</div>
                <div>画像とかがあればここにでてくる</div>
            </div>
            <div style='font-size: 20px'>式</div>
            <div style='font-size: 20px'>答え</div>
            <canvas id='canvas' style='position:absolute; left:0; top:0;'>
            </canvas>
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