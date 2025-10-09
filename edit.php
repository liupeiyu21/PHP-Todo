<?php
$host = 'localhost';
$dbname = 'ssp1';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 処理後トップページに戻る
    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}

?>