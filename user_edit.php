<?php

include("./funcs.php");
$pdo = db_conn();
$id = $_GET['id'];

$stmt = $pdo -> prepare('SELECT * FROM user WHERE id= :id');
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

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
  <title>利用者更新</title>
</head>

<body>
  <h1>利用者更新</h1>
  <form action="user_update.php" method="POST">
    <dl class="dlTable">
      <dt><label for="id">id</label></dt>
      <dd><?php echo htmlspecialchars($id,ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label for="uname">氏名</label></dt>
      <dd><input type="text" name="uname" id="uname" value="<?=$row["uname"]?>"></dd>
      <dt><label for="lid">利用者ID</label></dt>
      <dd><input type="text" name="lid" id="lid" value="<?=$row["lid"]?>"></dd>
      <dt><label for="lpw">利用者パスワード</label></dt>
      <dd><input type="text" name="lpw" id="lpw" value="<?=$row["lpw"]?>"></dd>
      <dt><label for="kanri">管理フラグ</label></dt>
      <dd><input type="text" name="kanri" id="kanri" value="<?=$row["kanri"]?>"></dd>
      <dt><label for="center">センター</label></dt>
      <dd><input type="text" name="center" id="center" value="<?=$row["center"]?>"></dd>
    </dl>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="submit" value="送信">
    
  </form>
  
</body>
</html>