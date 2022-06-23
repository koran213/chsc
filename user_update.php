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
$kanri_flg  = $_POST["kanri_flg"];
$life_flg   = $_POST["life_flg"];
$uid        = $_POST["uid"];

//データ登録SQL作成
$sql = "UPDATE user SET uname=:uname, lid=:lid, role=:role, center=:center, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE uid=:uid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);  
$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  
$stmt->bindValue(':role', $role, PDO::PARAM_STR);  
$stmt->bindValue(':center', $center, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);   
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);   
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

