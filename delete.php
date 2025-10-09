<?php
$host = 'localhost';
$dbname = 'ssp1';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // URLパラメータ（例: delete.php?id=3）を取得
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        // DELETE文を実行
        $stmt = $pdo->prepare("DELETE FROM todo WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // 削除したらトップページに戻る
    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>

