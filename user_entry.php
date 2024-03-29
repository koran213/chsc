<?php
//0. SESSION開始！！
session_start();

//1. DB接続
include("./funcs.php");
$pdo = db_conn();

//ログイン確認
sschk();

//２．centerテーブルからselect候補一覧取得
$sql   = "SELECT * FROM center";
$center = "";
if ($stmt = $pdo->query($sql)) {
    foreach ($stmt as $center_val) {
        $center .= "<option value='". $center_val['cc'];
        $center .= "'>". $center_val['cc']. "</option>";
    }
}

//3. データベース接続切断
$pdo = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>利用者登録</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <h1>利用者登録</h1>
  <form action="user_confirm.php" method="post">
    <dl class="dlTable">
      <dt><label for="uname">氏名</label></dt>
      <dd><input type="text" name="uname" id="uname"></dd>
      <dt><label for="lid">利用者ID</label></dt>
      <dd><input type="text" name="lid" id="lid"></dd>
      <dt><label for="lmail">利用者メールアドレス</label></dt>
      <dd><input type="email" name="lmail" id="lmail"></dd>
      <dt><label for="lpw">利用者パスワード</label></dt>
      <dd><input type="password" name="lpw" id="lpw"></dd>
      <dt><label for="role">職種</label></dt>
      <dd>
        <ul>
          <li><input type="radio" name="role" value="看護師">看護師</li>
          <li><input type="radio" name="role" value="社会福祉士">社会福祉士</li>
          <li><input type="radio" name="role" value="主任ケアマネ">主任ケアマネ</li>
          <li><input type="radio" name="role" value="施設担当">施設担当</li>
          <li><input type="radio" name="role" value="行政担当">行政担当</li>
        </ul>
      </dd>
      <dt><label for="center">センター</label></dt>
      <dd>
        <select name="center" id="center">
          <?php echo $center; ?>
        </select>
      </dd>
    </dl>
    <input type="submit" value="送信">
  </form>
 
</body>
</html>