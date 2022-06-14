<?php
//直リンクされた場合index.phpにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: index.html");
	exit();
}

//1. POSTデータ取得
include('post_data.php');

//2. DB接続
include("./funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO contact (cname,cmail,cage,target,tname,tage,tsex,tpcode,taddress,rtype,contact,detail)
VALUES(:cname, :cmail, :cage, :target, :tname, :tage, :tsex, :tpcode, :taddress, :rtype, :contact, :detail)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':cname', $cname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cmail', $cmail, PDO::PARAM_STR);  
$stmt->bindValue(':cage', $cage, PDO::PARAM_INT);  
$stmt->bindValue(':target', $target, PDO::PARAM_STR);  
$stmt->bindValue(':tname', $tname, PDO::PARAM_STR);  
$stmt->bindValue(':tage', $tage, PDO::PARAM_INT);  
$stmt->bindValue(':tsex', $tsex, PDO::PARAM_STR);  
$stmt->bindValue(':tpcode', $tpcode, PDO::PARAM_INT);  
$stmt->bindValue(':taddress', $taddress, PDO::PARAM_STR);  
$stmt->bindValue(':rtype', $rtype, PDO::PARAM_STR);  
$stmt->bindValue(':contact', $contact, PDO::PARAM_STR);  
$stmt->bindValue(':detail', $detail, PDO::PARAM_STR);  
$status = $stmt->execute(); //$statusにはtrue,falseが返る

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  // header("Location: index.html");
  // exit();
  //５．メール送信

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>完了画面</title>
<style type="text/css">
	body {
		background-color: #f9fff2;
	}
</style>
</head>
<body>
	<h2>送信完了</h2>
 	<p>今回のご相談内容が自動返信で届きます。</p>
  <p>もし届いていないようでしたら、確認いたしますので●●までお知らせください。</p>
  <p>送信完了後３稼働日以内に、センターの担当者より返信いたします。今しばらくお待ちください。</p>
 	<p>なお、センターからの返信の前に、今回のご相談に変更が生じた場合は、自動返信メール内に記載のある担当センターまでお知らせください。</p>
 	<p><a href="index.html">ご相談フォームトップへ</p>

</body>
</html>