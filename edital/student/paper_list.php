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
    $papers_data = json_decode(file_get_contents('../input/papers_data.json'), true);
    $sid = $_GET['sid'];
    ?>
    <h1>問題一覧</h1>
    <ul>
        <?php
        foreach( $papers_data as $paper ) {
            echo "<a href='/student/paper.php?sid=". $sid ."&q=". $paper['id'] ."'>
                    <li>". $paper['title'] ."</li>
                </a>";
        }
        ?>
    </ul>
</body>
</html>