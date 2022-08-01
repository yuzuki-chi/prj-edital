<?php

/**
 * index.php
 * 実験用トップページ. ここから『児童用』『教諭用』に分岐することができる
 */
require_once(__DIR__ . '/../vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project EDITAL</title>
</head>

<body>
    <h1>Project EDITAL</h1>

    <h2>このプロジェクトについて</h2>
    <p>このプロジェクトでは, 多忙化が進む小学校教諭の業務負担を軽減させるためのICTツールを作成しています. EDITAL(Digitalize of Education)では, 児童の取り組み方や成長する過程を見やすくするための機能を作っています.</p>

    <h2>バージョンについて</h2>
    <ul>
        <li>v0.0.1 ... 軸となる基本機能のみを実装したもの</li>
        <li>v0.0.2 ... 使用感アンケートを基に改良したもの</li>
        <li>v0.0.3 ... 講座でいただいた意見を基に、教諭が使いたいと思える機能を洗練する</li>
    </ul>

    <hr />

    <h2>機能要件・ページ構成</h2>

    <h3>児童向け画面</h3>
    <div>
        <div>
            お名前を入力して開始してください.
        </div>
        <input type="text" name="sname" id="sname">
        <button type="submit" id="student_submit">開始する</button>
    </div>
    <script>
        const sbtn = document.getElementById('student_submit');
        sbtn.addEventListener('click', function() {
            var sname = document.getElementById('sname').value;
            if ( sname == "" ) sname = "名無し";
            //1. ユーザ追加用のPOST APIを発行する
            //2. 非同期で, 作成成功の通知が帰ってきたら, 次のページへ遷移する
            const url = "https://takaya-develop-api.hattori-lab.cs.teu.ac.jp/api/student";
            const postData = {
                name: sname,
                class_id: 1,
            };
            fetch(url, {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(postData),
                }).then(response => response.text())
                .then(text => {
                    const ret = JSON.parse(text);
                    location.href = '/student?sid='+ ret['id'] +'&dn=' + ret['name']
                    // alert(text);
                });
        }, false);
    </script>

    <h3>教諭向け画面（現在は初期メンバー１人です）</h3>
    <ul>
        <li><a href='teacher'>立石 凌 先生</a></li>
    </ul>
</body>

</html>