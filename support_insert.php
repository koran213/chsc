<?php
//直リンクされた場合center_listにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: list.php");
	exit();
}

//1. POSTデータ取得
$ct_id    = $_POST["id"];
$ccode   = $_POST["ccode"];
$supporter  = $_POST["uname"];
$role      = $_POST["role"];
$support    = $_POST["support"]; 

//2. DB接続
include("./funcs.php");
$pdo = db_conn();

// ３．データ登録SQL作成
$sql = "INSERT INTO support (ct_id,ccode,supporter,role,support,sdate)
VALUES(:ct_id, :ccode, :supporter, :role, :support, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ct_id', $ct_id, PDO::PARAM_INT); 
$stmt->bindValue(':ccode', $ccode, PDO::PARAM_STR);  
$stmt->bindValue(':supporter', $supporter, PDO::PARAM_STR);  
$stmt->bindValue(':role', $role, PDO::PARAM_STR);  
$stmt->bindValue(':support', $support, PDO::PARAM_STR);  
$status = $stmt->execute(); //$statusにはtrue,falseが返る

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}else{
  //５．center_list.phpへリダイレクト
  header("Location: detail_2.php?id=".$ct_id);
  exit();
}



