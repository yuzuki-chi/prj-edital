<?php
// echo $_POST['data'];
$data = json_decode($_POST['data'], true)[0];
var_dump($data);
file_put_contents('/var/www/html/output/'. $data['student'] . '_' . $data['id'] .'_answer.json', $_POST['data']);