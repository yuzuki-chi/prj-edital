<?php
try {
    $dbh = new PDO('sqlite:host=localhost:3306;dbname=edital_general', 'yuzukichi', 'yuzukichi');
    foreach($dbh->query('SELECT * from logs') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
}