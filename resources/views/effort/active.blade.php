<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>みんなの筆記状況をみる</title>
</head>
<body>
    <h1>みんなの筆記状況をみる</h1>

    <div style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-around; text-align: center; margin-top:30px;">
        @foreach ($active_data as $actives)
            <div style='width:300px; height: 150px; border: solid 1px black; margin: 3px;<?php
            $color = "none)";
            if( $actives['diff'] < 5 ) {
                $color = "rgb(255, 0, 0)";
            } elseif ($actives['diff'] < 10) {
                $color = "rgb(200, 0, 55)";
            } elseif ($actives['diff'] < 15) {
                $color = "rgb(100, 0, 155)";
            } elseif ($actives['diff'] < 30) {
                $color = "rgb(50, 0, 205)";
            } elseif ($actives['diff'] < 60*3) {
                $color = "rgb(0, 0, 255)";
            }
            echo("background-color: " . $color);
            ?>'>
                <?php
                //あんまり大きい秒数だと微妙なので、最大値を設ける
                $max_sec = 60 * 3;
                if( $actives['diff'] < $max_sec) {
                    $diff_sec = $actives['diff'] . ' 秒';
                } else {
                    $diff_sec = 'しばらく書き込んでません';
                }
                ?>
                <p>{{ $actives['name']}}</p>
                <p>最後の書き込みから{{ $diff_sec }}</p>
            </div>
        @endforeach
    </div>

    <style>
        html {
            margin: 0;
            padding: 0;
        }
        body {
            margin: 0;
            padding: 0;
        }
        h1 {
            margin: 0;
            padding: 30px 20px;
            background-color: skyblue;
            text-align: center;
        }
    </style>

    <script>
        const timer = 5000    // ミリ秒で間隔の時間を指定
        window.addEventListener('load',function(){
        setInterval('location.reload()',timer);
        });
    </script>
</body>
</html>