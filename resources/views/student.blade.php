<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>デジタルノートを使ってみよう</title>
</head>
<body>
    <div class="content">
        <h1>デジタルノートを使ってみよう</h1>
        <form action="/student/create" method="POST">
            @csrf
            <div>おなまえ</div>
            <input type="text" name="name" id="name" placeholder="おなまえを入力してください" class="name_box"><br>
            <input type="submit" value="ノートを作る" class="btn">
        </form>
    </div>
</body>
</html>

<style>
    body {
        background-color: skyblue;
        text-align: center;
    }

    .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        padding: 15px 30px;
        background: rgba(0,0,0,0.4);
        color: #fff;
        text-align: center;
        width: 100%; 
    }
    
    .name_box {
        width: 500px;
        height: 30px;
        margin: 10px auto 30px auto;
    }
    .btn {
        width: 500px;
        height: 60px;
        font-size: 22px;
    }
</style>