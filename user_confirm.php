<?php
//直リンクされた場合index.phpにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: user_entry.php");
	exit();
}

//1. POSTデータ取得
$uname = $_POST["uname"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$role = $_POST["role"];
$center = $_POST["center"];
// $kanri_flg = $_POST["kanri_flg"];
// $life_flg = $_POST["life_flg"];

//2. lpwハッシュ化
$hashed_lpw = password_hash($lpw, PASSWORD_DEFAULT);

//3. DB接続
include("./funcs.php");
$pdo = db_conn();

//4. データ登録SQL作成
$sql = "INSERT INTO user(uname, lid, lpw, role, center)
VALUES(:uname, :lid, :lpw, :role, :center)";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  
$stmt->bindValue(':lpw', $hashed_lpw, PDO::PARAM_STR);
$stmt->bindValue(':role', $role, PDO::PARAM_STR);
$stmt->bindValue(':center', $center, PDO::PARAM_STR);
// $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  
// $stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  

$status = $stmt->execute();//$statusにはtrue,falseが返る

//5. データ登録処理後
if($status==false){
  // SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}else{
  //user_list.phpへリダイレクト
  header("Location: user_list.php");
  exit();
}

