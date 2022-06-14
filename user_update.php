<?php
//直リンクされた場合index.phpにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: user_list.php");
	exit();
}
//DB接続
include("./funcs.php");
$pdo = db_conn();

$uname = $_POST["uname"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri = $_POST["kanri"];
$center = $_POST["center"];
$id    = $_POST["id"];

//データ登録SQL作成
$sql = "UPDATE user SET uname=:uname, lid=:lid, lpw=:lpw, kanri=:kanri, center=:center WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  
$stmt->bindValue(':kanri', $kanri, PDO::PARAM_INT);  
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
