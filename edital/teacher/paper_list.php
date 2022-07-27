<?php

/**
 * teacher/paper_list.php
 * 教諭が(テストを開始するときに)選択するテスト一覧
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
    <title>問題一覧</title>
</head>

<body>
    <header>
        <div>戻る</div>
        <div><?= $login_user['display_name'] ?>先生</div>
    </header>

    <main>
        <h1>7月28日 木曜日</h1>
        <ul>
            <?php
            foreach ($papers_data as $paper) {
                echo "<a href='realtime.php?qid=" . $paper['id'] . "'>
                        <li>" . $paper['name'] . "</li>
                    </a>";
            }
            ?>
        </ul>
    </main>

    <footer>
    </footer>
</body>

</html>