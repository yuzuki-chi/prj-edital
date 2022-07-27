<?php

/**
 * student/paper_list.php
 * 児童のテスト一覧ページ
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
    <title>授業をうける</title>
</head>

<body>
    <header>
        <div>戻る</div>
        <div><?= $login_user['display_name'] ?>さん</div>
    </header>

    <main>
        <div>7月28日 木よう日</div>
        <ul>
            <?php
            foreach ($papers_data as $paper) {
                echo "<a href='/student/test_paper.php?qid=" . $paper['id'] . "'>
                    <li>" . $paper['name'] . "</li>
                </a>";
            }
            ?>
        </ul>
        <div>ほかの授業をうける</div>
    </main>

    <footer>
    </footer>
</body>

</html>