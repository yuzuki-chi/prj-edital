<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>変わった解き方をしてる子をみつける</title>
</head>
<body>
    <h1>変わった解き方をしている子をみつける</h1>
    <div class="accent_box">
        @foreach ($accsents as $accent)
        <div class="student_box" style='<?php 
            if($accent["level"] == "1") {
                echo("background-color: red;");
            } elseif ($accent["level"] == "0") {
                echo("background-color: blue;");
            }
        ?>'>
            <p>{{ $accent['name'] }}</p>
            <p>（{{ $accent['level'] }}）</p>
        </div>
        @endforeach
    </div>

    <style>
        .accent_box {
            margin-top: 30px;
            display: flex; 
            flex-direction: row; 
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .student_box {
            width:300px; 
            height:150px; 
            border: solid 1px black; 
            margin: 3px;
        }
    </style>

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