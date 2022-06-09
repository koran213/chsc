<?php
//１．PHP
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
$id = $_GET['id'];

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM center WHERE id=:id"); //SQLをセット
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  $row = $stmt->fetch(); 
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>センター更新</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <h1>センター更新</h1>
  <form action="center_update.php" method="POST">
    <dl class="dlTable">
      <dt><label for="id">id</label></dt>
      <dd><?php echo htmlspecialchars($id,ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label for="center">センター名</label></dt>
      <dd><input type="text" name="center" id="center" value="<?=$row["center"]?>"></dd>
      <dt><label for="address">住所</label></dt>
      <dd><input type="text" name="address" id="address" value="<?=$row["address"]?>"></dd>
      <dt><label for="tel">TEL</label></dt>
      <dd><input type="text" name="tel" id="tel" value="<?=$row["tel"]?>"></dd>
      <dt><label for="email">メールアドレス</label></dt>
      <dd><input type="text" name="email" id="email" value="<?=$row["email"]?>"></dd>
      <dt><label for="url">url</label></dt>
      <dd><input type="text" name="url" id="url" value="<?=$row["url"]?>"></dd>
    </dl>
    <!-- idを隠して送信 -->
    <input type="hidden" name="id" value="<?=$id?>">
    <!-- idを隠して送信 -->
    <input type="submit" value="送信">
  </form>
</body>
</html>