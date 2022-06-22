<?php

use YuzuLib\YuzuLib\DrawCanvas\YuzuCanvas;

require_once( __DIR__ . '/../../vendor/autoload.php' );

$questions = [
    '24 : 42',
    '3.5 : 8.4',
    '0.24 : 0.4',
];
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト</title>
</head>
<body style="width: 1000px; margin:0 auto;">
    <h1>5. 比を簡単にする（１）</h1>
    <h2>次の（１）〜（２）の比を簡単にしなさい。</h2>
    <div>
        <?php
        foreach($questions as $index => $question) { ?>
            <div style="position:relative; width:1000px; height:300px; border:solid 1px; padding: 10px;">
                <div>
                    <div style="font-size: 32px">(<?= $index+1 ?>) <?= $question ?></div>
                    <div style="font-size: 20px">式</div>
                    <br><br><br><br>
                    <div style="font-size: 20px">答え</div>
                </div>
                <canvas id='canvas_<?= $index+1 ?>' width='1000' height='300' style="position:absolute; left:0; top:0;">
                </canvas>
            </div>

            <script>
                // canvas
                var cnvs<?=$index+1?> = document.getElementById('canvas_<?= $index+1 ?>');
                var ctx<?=$index+1?> = cnvs<?=$index+1?>.getContext('2d');
                // クリックフラグ
                var clickFlg<?=$index+1?> = false;

                // マウス
                cnvs<?=$index+1?>.addEventListener('mousedown', draw_start<?=$index+1?>, false);
                cnvs<?=$index+1?>.addEventListener('mousemove', draw_move<?=$index+1?>, false);
                cnvs<?=$index+1?>.addEventListener('mouseup', draw_end<?=$index+1?>, false);
                // スマホ・タブレット
                cnvs<?=$index+1?>.addEventListener('touchstart', draw_start<?=$index+1?>, false);
                cnvs<?=$index+1?>.addEventListener('touchmove', draw_move<?=$index+1?>, false);
                cnvs<?=$index+1?>.addEventListener('touchend', draw_end<?=$index+1?>, false);

                function draw_start<?=$index+1?>(e) {
                    clickFlg = true;
                    e.preventDefault();
                    ctx<?=$index+1?>.beginPath();
                    ctx<?=$index+1?>.lineWidth = 2;
                    ctx<?=$index+1?>.strokeStyle = "#333";
                    ctx<?=$index+1?>.lineCap = "round";
                    ctx<?=$index+1?>.moveTo(e.offsetX, e.offsetY);
                    ctx<?=$index+1?>.stroke();
                }

                function draw_move<?=$index+1?>(e) {
                    if (clickFlg == false) return false;
                    ctx<?=$index+1?>.lineTo(e.offsetX, e.offsetY);
                    ctx<?=$index+1?>.stroke();
                }

                function draw_end<?=$index+1?>(e) {
                    clickFlg = false;
                    ctx<?=$index+1?>.lineTo(e.offsetX, e.offsetY);
                    ctx<?=$index+1?>.stroke();
                }
            </script>
            <?php 
            } ?>
            <script>
                function submitPaper() {
                    alert('提出しました');
                }
            </script>
    </div>
    <button onclick="submitPaper()">提出する</button>
    <?php
    $canvas = new YuzuCanvas(500, 500, 'sampleID', 'sampleClass');
    echo $canvas->to_string();
    
    $canvas = new YuzuCanvas(500, 500, 'secondID', 'sampleClass');
    echo $canvas->to_string();
    ?>
</body>
</html>