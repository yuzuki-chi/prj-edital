<?php
session_start();
$login_user = $_SESSION['login_user'];

//student_idの人がアクティブになる
$url = 'http:///192.168.179.60/api/student/updateState/'. $login_user['id'] . '/0';
// echo $login_user['id'];
$params= [
    'test' => 'test'
    ];
    $header = [
    // headerに追加したい情報
    // 例）
    // “Content-Type: application/json”,
    // “Accept: application/json”,
    // “Authorization: Bearer HogeHoge”
    ];
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
    
    $output= curl_exec($curl);
    
    // エラーハンドリング用
    $errno = curl_errno($curl);
    // コネクションを閉じる
    curl_close($curl);
    
    // エラーハンドリング
    if ($errno !== CURLE_OK) {
        echo "ERR!";
    }
    if($output == '') {
        echo '提出しました！最初の画面に戻ります';
    } else {
        echo $output;
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~