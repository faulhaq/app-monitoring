<?php

$pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=monitoring", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$json = json_decode(file_get_contents(__DIR__."/surah.json"));

$q = "INSERT INTO surah (id, nama, jumlah_ayat) VALUES ";
$d = [];
foreach ($json as $s) {
    $q .= "(?, ?, ?),";
    $d[] = (int)$s->index;
    $d[] = $s->title;
    $d[] = $s->count;
}

$q = rtrim($q, ",");
$pdo->prepare($q)->execute($d);
unset($pdo);
