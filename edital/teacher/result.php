<?php
/**
 * teacher/result.php
 * 取組結果画面
 */
session_start();
$login_user = $_SESSION['login_user'];
$qid = $_GET['qid'];
$papers_data = [
    [
        'id' => '101',
        'name' => '1時間目 国語',
    ],
    [
        'id' => '102',
        'name' => '2時間目 算数',
    ],
    [
        'id' => '103',
        'name' => '3時間目 理科',
    ],
    [
        'id' => '104',
        'name' => '4時間目 社会',
    ],
    [
        'id' => '105',
        'name' => '5時間目 総合',
    ],
];
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>取組結果</title>
</head>
<body>
    <header>
        <div>戻る</div>
        <div><?= $login_user['display_name'] ?>先生</div>
    </header>

    <main>
        <h1>2時間目 算数</h1>
        <h2>注意人物</h2>
        <ul>
            <li>００太郎君 -> 最後まで解けていません</li>
            <li>００次郎君 -> 毎回同じ場所で手が止まっています</li>
        </ul>
    </main>

    <footer>
    </footer>

</body>
</html>