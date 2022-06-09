<?php
//直リンクされた場合center_listにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: center_list.html");
	exit();
}

//1. POSTデータ取得
$id    = $_POST["id"];
$center   = $_POST["center"];
$address  = $_POST["address"];
$tel      = $_POST["tel"];
$email    = $_POST["email"]; 
$url      = $_POST["url"]; 

//2. DB接続
include("./funcs.php");
$pdo = db_conn();

// ３．データ登録SQL作成
$sql = "INSERT INTO center (center,address,tel,email,url)
VALUES(:center, :address, :tel, :email, :url)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':center', $center, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':address', $address, PDO::PARAM_STR);  
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);  
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  
$status = $stmt->execute(); //$statusにはtrue,falseが返る

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}else{
  //５．center_list.phpへリダイレクト
  header("Location: center_list.php");
  exit();
}



