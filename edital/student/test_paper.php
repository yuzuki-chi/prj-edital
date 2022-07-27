<?php
/**
 * student/paper.php
 * 児童がテストに解答するための画面
 */

$assets_src = '/../assets/';
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $assets_src . 'css/test_paper.css' ?>">
    <title>キャンバスモードテスト</title>
</head>

<body id='body'>
    <script>
        const student_id = <?= $_GET['sid'] ?>;
        const test_id = <?= $_GET['q'] ?>;
        var pen_mode = 1; //えんぴつ
        var stroke_start, stroke_end;
    </script>
    <div style='position:relative; height: 100vh;'>
        <h1>学年生：大きな単元名</h1>
        <h2>小さな単元名</h2>
        <h3>大問１</h3>
        <div>
            <div style='font-size: 32px'>問題文</div>
            <div>画像とかがあればここにでてくる</div>
        </div>
        <div style='font-size: 20px'>式</div>
        <div style='font-size: 20px'>答え</div>
        <canvas id='canvas' style='position:absolute; left:0; top:0;'>
        </canvas>
        <div class='tools'>
            <button id='mode_pen'>✏️えんぴつ</button>
            <button id='mode_erase'>🩹消しゴム</button>
            <input type="range" name="mode_range" id="mode_range" min=1 max=100 value=1>
            <button id='answer'>答えを入力する</button>
            <button id='submit'>提出する</button>
            <script src="<?= $assets_src . 'js/submit_button.js' ?>"></script>
        </div>
    </div>


    <script src="<?= $assets_src . 'js/test_paper.js' ?>"></script>
</body>

</html>