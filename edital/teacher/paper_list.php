<?php

/**
 * teacher/paper_list.php
 * 教諭が(テストを開始するときに)選択するテスト一覧
 */
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
    <?php
    $papers_data = [
        [
            'id' => '101',
            'name' => '提供されているテスト1',
        ],
        [
            'id' => '102',
            'name' => '提供されているテスト2',
        ],
        [
            'id' => '103',
            'name' => '提供されているテスト3',
        ],
    ];
    ?>
    <h1>問題一覧</h1>
    <ul>
        <?php
        foreach ($papers_data as $paper) {
            echo "<a href='realtime.php?qid=" . $paper['id'] . "'>
                    <li>" . $paper['name'] . "</li>
                </a>";
        }
        ?>
    </ul>
</body>

</html>