<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/live_lesson.css') }}">
    <title>Document</title>
</head>
<body>
    授業ID：<?= $lesson_id ?><br/>
    セッションID：<?= $session_id ?><br/>
    <header></header>
    <main>
        <div class="container">
            <textbook>
                <h1>図形・正多角形</h1>
                <h2>1 軸（じく）とは</h2>
                <p>１つの直線を折り目にして折ったとき、両側がぴったり重なる図形を線対称な図形といいます。また、その直線を対称の軸(じく)といいます。</p>
                <p>対応する点Ａや対応する線ＡＢなどの言葉を新しく使うことを理解させたいと思います。</p>
                <img src="{{ asset('image/live_lesson.png') }}" alt="img">
                <p>・対応する２つの点を結ぶ直線は、対称の中心を通ります。<br/>・対称の中心から、対応する点から２つの点までの長さは等しくなっています。</p>
            </textbook>
            <div class="controller">
            </div>
            <worksheet>
                <h1>やってみよう！</h1>
                <h2>問1</h2>
                <p>三角形ABCの線対称となる三角形DEFを書いてみましょう。<br/>作るには定規をうんたらこうたら。</p>
                <p>三角形を作るプログラムを作りたい場合、どのような手順をすれば良いでしょうか。</p>
                <p>① はじめとなる点の場所を決める<br/>② ふたつめの点の場所を決める<br/>③ ひとつめの点とふたつめの点を結ぶ線を書く<br/>④ みっつめの</p>

                <button>このデータで提出する</button>
            </worksheet>
        </div>
    </main>
    <footer></footer>
</body>
</html>