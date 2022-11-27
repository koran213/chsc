<?php
//直リンクされた場合index.phpにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: user_list.php");
	exit();
}
//DB接続
include("./funcs.php");
$pdo = db_conn();

$uname      = $_POST["uname"];
$lid        = $_POST["lid"];
$role       = $_POST["role"];
$center     = $_POST["center"];
$uid        = $_POST["uid"];

//データ登録SQL作成
$sql = "UPDATE user SET uname=:uname, lid=:lid, role=:role, center=:center WHERE uid=:uid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);  
$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  
$stmt->bindValue(':role', $role, PDO::PARAM_STR);  
$stmt->bindValue(':center', $center, PDO::PARAM_STR);

$status = $stmt->execute(); //$statusにはtrue,falseが返る

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}else{
  // ５．index.phpへリダイレクト
  header("Location: user_list.php");
  exit();
}

