<?php

/**
 * teacher/result_list.php
 * 取組結果一覧を表示するための教諭用画面
 */
session_start();
$login_user = $_SESSION['login_user'];
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
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>取組結果一覧</title>
</head>

<body>
    <header>
        <div>戻る</div>
        <div><?= $login_user['display_name'] ?>先生</div>
    </header>
    <main>
        <ul>
            <li><a href="result.php">授業ごとの取り組み情報を見る</a></li>
            <ul>
                <?php
                foreach ($papers_data as $paper) {
                    echo "<a href='result.php?qid=" . $paper['id'] . "'>
                        <li>" . $paper['name'] . "</li>
                    </a>";
                }
                ?>
            </ul>
            <li><a href="result_all.php">これまでの内容から分析結果を見る</a></li>
        </ul>
    </main>
</body>

</html>