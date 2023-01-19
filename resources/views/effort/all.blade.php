<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>みんなの取り組みを見る</title>
</head>
<body>
    <h1>みんなの取り組みを見る</h1>
    <ul style="display: flex; flex-direction: row; justify-content: space-around; flex-wrap: wrap; margin-top:30px;">
        @foreach ($effort_bin as $effort)
            <li style="list-style-type:none; min-height:300px">
                <p>{{ $effort['name'] }}</p>
                {{-- <p>{{ $effort['png_binary'] }}</p> --}}
                <img src="{{ $effort['png_binary'] }}" alt="{{ $effort['id'] }}" style="border: solid 1px black; width:90%; max-width: 500px;">
            </li>
        @endforeach
    </ul>

    <script>
        const timer = 5000    // ミリ秒で間隔の時間を指定
        window.addEventListener('load',function(){
        setInterval('location.reload()',timer);
        });
    </script>

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
</body>
</html>