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

//TODO
/**いずれ一つにまとめてください... */
$url = 'http:///192.168.179.60/api/question';

$header = [
    // headerに追加したい情報
    // 例）
    // “Content-Type: application/json”,
    // “Accept: application/json”,
    // “Authorization: Bearer HogeHoge”
    ];
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
    
    $question_list= curl_exec($curl);
    
    // エラーハンドリング用
    $errno = curl_errno($curl);
    // コネクションを閉じる
    curl_close($curl);
    
    // エラーハンドリング
    if ($errno !== CURLE_OK) {
        $question_list = [];
    }

    $question_list = json_decode($question_list, true);
    
    // var_dump(($question_list));
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
            foreach ($question_list as $question) {
                echo "<a href='/student/test_paper.php?qid=" . $question['id'] . "'>
                    <li>" . $question['title'] . "</li>
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