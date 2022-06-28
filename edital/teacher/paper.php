<?php

if (!isset($_GET['sid'])) header('Location: /teacher/student_list.php');
if (!isset($_GET['qid'])) header('Location: /teacher/student_list.php');

use YuzuLib\YuzuLib\DrawCanvas\YuzuCanvas;

require_once(__DIR__ . '/../../vendor/autoload.php');

$questions_data = json_decode(file_get_contents('../input/' . $_GET['qid'] . '.json'), true)[0];
$answers_data = json_decode(file_get_contents('../output/' . $_GET['sid'] . '_' . $_GET['qid'] . '_answer.json'), true);
// echo "<pre>";
// var_dump($answers_data);
// echo "</pre>";
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
        $cnt = 0;
        foreach ($questions as $question) {
            echo "<h3>【" . $question['qId'] . "】 " . $question['q'] . "</h3>";
            foreach ($question['qs'] as $question_2) {
                echo makeQ($question_2['qId'], $question_2['q'], $question['qId'] . '_' . $question_2['qId']);
                
                //スライダーの最大値をそれぞれのストローク数に変更
                echo "<script> document.getElementById('stroked_" . $question['qId'] . '_' . $question_2['qId'] . "').max=". (count($answers_data[$cnt]['data'])) ."; </script>";

                echo drawA($answers_data[$cnt], $question['qId'] . '_' . $question_2['qId']);
                $cnt++;
            }
        }
        ?>
    </div>
</body>

</html>
<?php

function makeQ($index, $question, $id)
{
    $ret = "
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
            <input type='range' id='stroked_". $id ."' min='0' max='100' value='0' style='width:100%; margin-top:30px; margin-bottom:50px;'>

        <script>
            // canvas
            var cnvs" . $id . " = document.getElementById('canvas_" . $id . "');
            var ctx" . $id . " = cnvs" . $id . ".getContext('2d');
            // クリックフラグ
            var clickFlg" . $id . " = false;
            var inputData" . $id . " = [];

            // マウス
            // cnvs" . $id . ".addEventListener('mousedown', draw_start" . $id . ", false);
            // cnvs" . $id . ".addEventListener('mousemove', draw_move" . $id . ", false);
            // cnvs" . $id . ".addEventListener('mouseup', draw_end" . $id . ", false);
            // スマホ・タブレット
            // cnvs" . $id . ".addEventListener('touchstart', draw_start" . $id . ", false);
            // cnvs" . $id . ".addEventListener('touchmove', draw_move" . $id . ", false);
            // cnvs" . $id . ".addEventListener('touchend', draw_end" . $id . ", false);

            function draw_start" . $id . "(e) {
                clickFlg" . $id . " = true;
                e.preventDefault();
                ctx" . $id . ".beginPath();
                ctx" . $id . ".lineWidth = 2;
                ctx" . $id . ".strokeStyle = '#333';
                ctx" . $id . ".lineCap = 'round';
                ctx" . $id . ".moveTo(e.offsetX, e.offsetY);
                ctx" . $id . ".stroke();
                console.log(e.offsetX, e.offsetY);
                inputData" . $id . ".push({
                    'x': e.offsetX,
                    'y': e.offsetY,
                    'status': 'start',
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


        </script>
    ";
    return $ret;
}

function drawA($answers_data, $id)
{
    $stroke_count = count($answers_data['data']); //ストローク数

    for ($i=0 ; $i<$stroke_count; $i++) {
        drawStroke($answers_data, $id, $i);
    }

    //ストロークを直接レンジから変更できるようにする
    echo "
    <script>
    function change_stroke". $id ." (e) {
        ctx". $id .".clearRect(0, 0, 1000, 300);
        stroke_value = stroked_". $id .".value;
        for(let i=0; i<stroke_value; i++) {
            if( ans_stroke".$id."[i].status == 'start' ) ctx" . $id . ".beginPath();
            if( ans_stroke".$id."[i].mode == 'pen' ) ctx" . $id . ".strokeStyle = '#333';
            else if( ans_stroke".$id."[i].mode == 'erase' ) ctx" . $id . ".strokeStyle = '#FFF';
            ctx" . $id . ".stroke();
            ctx" . $id . ".lineTo( ans_stroke".$id."[i].x ,  ans_stroke".$id."[i].y );
        }
        // alert('".$id."');
    }
    //レンジで変化させたい
    var range". $id . " = document.getElementById('stroked_". $id ."');
    range". $id . ".addEventListener('change', change_stroke". $id .", false);
    </script>
    ";
}

function drawStroke($ans_data, $id, $index)
{
    $ret = "<script>";

    $data = $ans_data['data'][$index];
    echo "<script> var ans_stroke". $id ." = ". json_encode($ans_data['data'], true) ."</script>";


    switch ($data['status']) {
        case 'start':
            //消しゴム判定
            if ($data['mode'] == 'pen') $ret = $ret . "ctx" . $id . ".strokeStyle = '#333';";
            elseif ($data['mode'] == 'erase') $ret = $ret . "ctx" . $id . ".strokeStyle = '#FFF';";

            //意味ないことしてる
            $next_data = $ans_data['data'][$index + 1];
            $ret = $ret . "
                    ctx" . $id . ".beginPath();
                    ctx" . $id . ".stroke();
                    ctx" . $id . ".lineTo(" . $next_data['x'] . ", " . $next_data['y'] . ");
                ";
            break;
        case 'stop':
        default:

            $ret = $ret . "
            ctx" . $id . ".stroke();
            ctx" . $id . ".lineTo(" . $data['x'] . ", " . $data['y'] . ");
        ";
    }
    $ret = $ret . "</script>";
    echo $ret;
}
