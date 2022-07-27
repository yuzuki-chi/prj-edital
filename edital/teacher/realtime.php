<?php
/**
 * teacher/realtime.php
 * 授業中の教諭用画面
 */

if (!isset($_GET['qid'])) header('Location: /teacher/paper_list.php');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>授業中の画面</title>
</head>

<body>
    <script>
        const sid = <?= $_GET['sid'] ?>;
        const qid = <?= $_GET['qid'] ?>;
    </script>

    <h1>テストの進捗</h1>
    <ul>
        <li>ひとりめ -> １の③</li>
        <li>ふたりめ -> 2の③</li>
        <li>さんにんめ -> １の②</li>
    </ul>

    <h1>筆跡の活性マップ</h1>
    <ul>
        <li>ひとりめ -> 活性レベル1</li>
        <li>ふたりめ -> 活性レベル3</li>
        <li>さんにんめ -> 活性レベル5</li>
    </ul>
    <script src="realtime.js"></script>
</body>

</html>