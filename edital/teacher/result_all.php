<?php
/**
 * teacher/result_all.php
 * 全体のテストの取組結果を表示するページ
 */
session_start();
$login_user = $_SESSION['login_user'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>全体のテストの取組み結果</title>
</head>

<body>
    <header>
        <div>戻る</div>
        <div><?= $login_user['display_name'] ?>先生</div>
    </header>

    <main>
        <h1>テストの分析結果</h1>
        <h2>算数：面積の差は？</h2>
        <h3>【要支援】</h3>
        <ul>
            <li>サンプル太郎君</li>
            <ul>
                <li>全ての答えが間違っています</li>
                <li>途中式を書く時間が極端に短いため、理解できていない可能性があります</li>
            </ul>
            <li>サンプル次郎君</li>
            <ul>
                <li>途中式を書かずに間違え違えています</li>
                <li>式の作り方を理解してない可能性があります</li>
            </ul>
        </ul>
        <h3>【その他】</h3>
        <ul>
            <li>サンプル三郎君</li>
            <ul>
                <li>途中式に時間をかけて、全問正解しています</li>
                <li>問題が進むにつれて、解答時間が短くなっています</li>
            </ul>
        </ul>
    </main>

    <footer>
    </footer>
</body>

</html>