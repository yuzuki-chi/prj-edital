<?php

if (!isset($_GET['q'])) header('Location: /student/paper_list.php');

use YuzuLib\YuzuLib\DrawCanvas\YuzuCanvas;

require_once(__DIR__ . '/../../vendor/autoload.php');

$questions_data = json_decode(file_get_contents('../input/' . $_GET['q'] . '.json'), true)[0];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト</title>
</head>

<body style="width: 1000px; margin:0 auto;">
    <h1><?= $questions_data['title'] ?></h1>
    <h2><?= $questions_data['desc'] ?></h2>
    <div>
        <?php
        $questions = $questions_data['q'];
        foreach ($questions as $question) {
            echo "<h3>【" . $question['qId'] . "】 " . $question['q'] . "</h3>";
            foreach ($question['qs'] as $question_2) {
                echo makeQ($question_2['qId'], $question_2['q'], $question['qId'] . '_' . $question_2['qId']);
            }
        }
        ?>
        <script>
            function submitPaper() {
                var submitArray = [];
                <?php
                foreach ($questions as $question) {
                    foreach ($question['qs'] as $question_2) {
                        echo '
                            JSON.stringify(
                                submitArray.push({
                                    "id": ' . $questions_data['id'] . ', 
                                    "student": '. $_GET['sid'] .',
                                    "data": inputData' . $question['qId'] . '_' . $question_2['qId'] . "
                                })
                            );";
                    }
                }
                ?>
                xhr = new XMLHttpRequest();
                xhr.onload = function(e) {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // alert(xhr.responseText);
                            alert('提出しました。最初の画面に戻ります。');
                            window.location.href = '/';
                        }
                    }
                };

                xhr.open('POST', 'submit.php', true);
                xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
                var request = "data=" + JSON.stringify(submitArray);
                xhr.send(request);

                console.log(submitArray);
            }
        </script>
        <button onclick="submitPaper()" style="width:100%; height:100px; margin: 30px auto; font-size: 28px">提出する</button>
    </div>
    <?php
    // $canvas = new YuzuCanvas(500, 500, 'sampleID', 'sampleClass');
    // echo $canvas->to_string();

    // $canvas = new YuzuCanvas(500, 500, 'secondID', 'sampleClass');
    // echo $canvas->to_string();
    ?>
</body>

</html>
<?php

function makeQ($index, $question, $id)
{
    $ret = "
        <br/>
        <button id='mode_pen_". $id ."'>えんぴつ</button>
        <button id='mode_erase_". $id ."'>消しゴム</button>
        <div style='position:relative; width:1000px; height:300px; border:solid 1px; padding: 10px;'>
            <div>
                <div style='font-size: 32px'>(" . $index . ") " . $question . "</div>
                <div style='font-size: 20px'>式</div>
                <br><br><br><br>
                <div style='font-size: 20px'>答え</div>
            </div>
            <canvas id='canvas_" . $id . "' width='1000' height='300' style='position:absolute; left:0; top:0;'>
            </canvas>
        </div>

        <script>
            // canvas
            var cnvs" . $id . " = document.getElementById('canvas_" . $id . "');
            var ctx" . $id . " = cnvs" . $id . ".getContext('2d');
            // クリックフラグ
            var clickFlg" . $id . " = false;
            var inputData" . $id . " = [];

            // マウス
            cnvs" . $id . ".addEventListener('mousedown', draw_start" . $id . ", false);
            cnvs" . $id . ".addEventListener('mousemove', draw_move" . $id . ", false);
            cnvs" . $id . ".addEventListener('mouseup', draw_end" . $id . ", false);
            // スマホ・タブレット
            cnvs" . $id . ".addEventListener('touchstart', touch_start" . $id . ", false);
            cnvs" . $id . ".addEventListener('touchmove', touch_move" . $id . ", false);
            cnvs" . $id . ".addEventListener('touchend', touch_end" . $id . ", false);
            //鉛筆・消しゴム切り替えボタン
            ctx" . $id . "_strokeStyle = '#333'
            mode" . $id . " = 'pen';
            var btn_pen_". $id ." = document.getElementById('mode_pen_". $id ."');
            var btn_erase_". $id ." = document.getElementById('mode_erase_". $id ."');
            btn_pen_". $id .".addEventListener('click', mode_pen_". $id .", false);
            btn_erase_". $id .".addEventListener('click', mode_erase_". $id .", false);

            function mode_pen_". $id ."(e) {
                ctx" . $id . "_strokeStyle = '#333';
                mode" . $id . " = 'pen';
            }

            function mode_erase_". $id ."(e) {
                ctx" . $id . "_strokeStyle = '#FFF';
                mode" . $id . " = 'erase';
            }

            function draw_start" . $id . "(e) {
                clickFlg" . $id . " = true;
                e.preventDefault();
                ctx" . $id . ".beginPath();
                ctx" . $id . ".lineWidth = 2;
                ctx" . $id . ".strokeStyle = ctx" . $id . "_strokeStyle;
                ctx" . $id . ".lineCap = 'round';
                ctx" . $id . ".moveTo(e.offsetX, e.offsetY);
                ctx" . $id . ".stroke();
                console.log(e.offsetX, e.offsetY);
                inputData" . $id . ".push({
                    'x': e.offsetX,
                    'y': e.offsetY,
                    'status': 'start',
                    'mode': mode". $id .",
                    'time': new Date().getTime()
                });
            }

            function draw_move" . $id . "(e) {
                if (clickFlg" . $id . " == false) return false;
                ctx" . $id . ".lineTo(e.offsetX, e.offsetY);
                ctx" . $id . ".stroke();
                inputData" . $id . ".push({
                    'x': e.offsetX,
                    'y': e.offsetY,
                    'status': 'move'
                });
            }

            function draw_end" . $id . "(e) {
                clickFlg" . $id . " = false;
                ctx" . $id . ".lineTo(e.offsetX, e.offsetY);
                ctx" . $id . ".stroke();
                inputData" . $id . ".push({
                    'x': e.offsetX,
                    'y': e.offsetY,
                    'status': 'end'
                });
                var json = JSON.stringify(inputData" . $id . ");
                console.log(json);
            }

            function touch_start" . $id . "(e) {
                clickFlg" . $id . " = true;
                e.preventDefault();
                var touch_x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
                var touch_y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top;

                ctx" . $id . ".beginPath();
                ctx" . $id . ".lineWidth = 2;
                ctx" . $id . ".strokeStyle = ctx" . $id . "_strokeStyle;
                ctx" . $id . ".lineCap = 'round';
                ctx" . $id . ".moveTo(touch_x, touch_y);
                ctx" . $id . ".stroke();
                console.log(e.offsetX, e.offsetY);
                inputData" . $id . ".push({
                    'x': touch_x,
                    'y': touch_y,
                    'status': 'start',
                    'mode': mode". $id .",
                    'time': new Date().getTime()
                });
            }

            function touch_move" . $id . "(e) {
                var touch_x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left ;
                var touch_y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top;

                if (clickFlg" . $id . " == false) return false;
                ctx" . $id . ".lineTo(touch_x, touch_y);
                ctx" . $id . ".stroke();
                inputData" . $id . ".push({
                    'x': touch_x,
                    'y': touch_y,
                    'status': 'move'
                });
            }

            function touch_end" . $id . "(e) {
                var touch_x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
                var touch_y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top;

                clickFlg" . $id . " = false;
                ctx" . $id . ".lineTo(touch_x, touch_y);
                ctx" . $id . ".stroke();
                inputData" . $id . ".push({
                    'x': touch_x,
                    'y': touch_y,
                    'status': 'end'
                });
                var json = JSON.stringify(inputData" . $id . ");
                console.log(json);
            }
        </script>
    ";
    return $ret;
}
