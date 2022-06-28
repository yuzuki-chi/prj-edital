<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生徒一覧</title>
</head>
<body>
    <?php
    $qid = $_GET['q'];
    $users_data = json_decode(file_get_contents('../input/users_data.json'), true);
    ?>
    <h1>生徒一覧</h1>
    <ul>
        <?php foreach( $users_data as $user ) {
            if(!file_exists('../output/'.$user['id'].'_'.$qid.'_answer.json')) continue;
            echo "<li><a href='./paper.php?sid=". $user['id'] ."&qid=". $qid ."'>". $user['name'] ."さん</a></li>";
        }
        ?>
    </ul>
</body>
</html>