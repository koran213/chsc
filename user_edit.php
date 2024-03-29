<?php
//0. SESSION開始！！
session_start();

include("./funcs.php");
$pdo = db_conn();
$uid = $_GET['uid'];

//ログイン確認
sschk();

$stmt = $pdo -> prepare('SELECT * FROM user WHERE uid= :uid');
$stmt->bindValue(':uid',$uid,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  $row = $stmt->fetch(); 
}

//4．centerテーブルからselect候補一覧取得
$center = "";
if ($stmt2 = $pdo -> query("SELECT * FROM center")) {
    foreach ($stmt2 as $center_val) {
        $center .= "<option value='". $center_val['cc'];
        $center .= "'>". $center_val['cc']. "</option>";
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>利用者更新</title>
</head>

<body>
ログインユーザー：<?=$_SESSION["uname"]?>
<a href="logout.php">ログアウト</a><br/>

  <h1>利用者更新</h1>
  <form action="user_update.php" method="POST">
    <dl class="dlTable">
      <dt><label for="uid">id</label></dt>
      <dd><?php echo h($uid); ?></dd>
      <dt><label for="uname">氏名</label></dt>
      <dd><input type="text" name="uname" id="uname" value="<?=$row["uname"]?>"></dd>
      <dt><label for="lid">利用者ID</label></dt>
      <dd><input type="text" name="lid" id="lid" value="<?=$row["lid"]?>"></dd>
      <dt><label for="role">専門職種</label></dt>
      <dd><input type="text" name="role" id="role" value="<?=$row["role"]?>"></dd>
      <dt><label for="center">センター</label></dt>
      <dd>
        <select name="center" id="center">
          <option selected hidden><?= $row["center"];?></option>
          <?php echo $center; ?>
        </select>
      </dd>
    </dl>
    <input type="hidden" name="uid" value="<?=$uid?>">
    <input type="submit" value="送信">
    
  </form>
  <a href="user_list.php">一覧に戻る</a>
  
</body>
</html>