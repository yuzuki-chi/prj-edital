<?php
/**
 * student/paper_list.php
 * 児童のテスト一覧ページ
 */
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト一覧</title>
</head>
<body>
    <?php
    $papers_data = [
        [
            'id'=>'101',
            'name'=>'提供されているテスト1',
        ],
        [
            'id'=>'102',
            'name'=>'提供されているテスト2',
        ],
        [
            'id'=>'103',
            'name'=>'提供されているテスト3',
        ],
    ];
    $sid = $_GET['sid'];
    ?>
    <h1>いま 受けることができるテスト</h1>
    <ul>
        <?php
        foreach( $papers_data as $paper ) {
            echo "<a href='/student/paper.php?sid=". $sid ."&q=". $paper['id'] ."'>
                    <li>". $paper['name'] ."</li>
                </a>";
        }
        ?>
    </ul>
</body>
</html>