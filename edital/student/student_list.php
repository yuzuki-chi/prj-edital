<?php
if( isset($_POST['student_name'])) {
    $users_data = json_decode(file_get_contents('../input/users_data.json'), true);
    $users_data[] = ['id'=>end($users_data)['id']+1, 'name'=>$_POST['student_name']];
    $json = json_encode($users_data, true);
    file_put_contents('../input/users_data.json', $json);
}
?>
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
    $users_data = json_decode(file_get_contents('../input/users_data.json'), true);
    ?>
    <h1>生徒一覧</h1>
    <ul>
        <?php foreach( $users_data as $user ) {
            echo "<li><a href='./paper_list.php?sid=". $user['id'] . "'>". $user['name'] ."さん</a></li>";
        }
        ?>
    </ul>
    <h2>生徒を新規追加する</h2>
    <form action="./student_list.php" method="post">
        お名前：<input type="text" name="student_name">
        <button type="submit">新規追加する</button>
    </form>
</body>
</html>