<?php
$host = 'localhost';
$dbname = 'ssp1';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        //  完了→未完了に戻す（is_doneを0にする）
        $stmt = $pdo->prepare("UPDATE todo SET is_done = 0 WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // 処理後トップページに戻る
    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
