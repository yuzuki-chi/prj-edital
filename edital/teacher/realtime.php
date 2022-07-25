<?php

/**
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
    児童一覧
    <ul>
        <li>ひとりめ</li>
        <li>ふたりめ</li>
        <li>さんにんめ</li>
    </ul>
    <script src="realtime.js"></script>
</body>

</html>