<?php

/**
 * curl.php
 * cURLを実行し, 結果を返す関数たち
 */

function curl_get($url)
{
    $header = [
        // “Content-Type: application/json”,
        // “Accept: application/json”,
        // “Authorization: Bearer HogeHoge”
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡

    $question = curl_exec($curl);

    // エラーハンドリング用
    $errno = curl_errno($curl);
    // コネクションを閉じる
    curl_close($curl);

    // エラーハンドリング
    if ($errno !== CURLE_OK) {
        return false;
    }

    return $question;
}

/**
 * @param string $url
 * @param array $params
 */
function curl_post($url, $params)
{
    $header = [
        // “Content-Type: application/json”,
        // “Accept: application/json”,
        // “Authorization: Bearer HogeHoge”
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 証明書の検証を無効化
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 証明書の検証を無効化
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); // 返り値を文字列に変更
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡

    $output = curl_exec($curl);

    // エラーハンドリング用
    $errno = curl_errno($curl);
    // コネクションを閉じる
    curl_close($curl);

    // エラーハンドリング
    if ($errno !== CURLE_OK) {
        return false;
    }

    return $output;
}
