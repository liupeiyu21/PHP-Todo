<?php
$host = 'localhost';
$dbname = 'ssp1';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 追加
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['text'])) {
    //     $text = $_POST['text'];
    //     $stmt = $pdo->prepare("INSERT INTO todo (`text`, `is_done`) VALUES (:text, 0)");
    //     $stmt->execute([':text' => $text]);
    // }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $text = trim($_POST['text']);

        if ($text !== '' ) {
          $stmt = $pdo->prepare("INSERT INTO todo (`text`, `is_done`) VALUES (:text, 0)");
          $stmt->execute([':text' => $text]);
        }

    } 



    // 未完了TODO
    $incomplete = $pdo->query("SELECT * FROM todo WHERE is_done = 0 ORDER BY id DESC");

    // 完了TODO
    $complete = $pdo->query("SELECT * FROM todo WHERE is_done = 1 ORDER BY id DESC");

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>TODO</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>PHP</h1>

    <!-- <h2>未完了のTODO</h2> -->
    <form method="post" action="">
      <input type="text" name="text" placeholder="TODOを入力" required>
      <button type="submit">追加</button>
    </form>

  <div class="incomplete-area">
      <p>未完了のTODO</p>
    <ul>
      <?php foreach ($incomplete as $row): ?>
        <li>
          <?= htmlspecialchars($row['text']) ?>
          <button onclick="location.href='complete.php?id=<?= $row['id'] ?>'">完了</button>
          <button onclick="location.href='delete.php?id=<?= $row['id'] ?>'">削除</button>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="complete-area">
    <p>完了のTODO</p>
    <ul>
      <?php foreach ($complete as $row): ?>
        <li>
          <?= htmlspecialchars($row['text']) ?>
          <button onclick="location.href='back.php?id=<?= $row['id'] ?>'">戻す</button>
        </li>
        
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
