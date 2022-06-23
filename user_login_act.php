<?php
//PHPエラーを非表示にする
ini_set('display_errors', 0);

//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//1.  DB接続
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$sql="SELECT * FROM user WHERE lid=:lid";
$stmt = $pdo->prepare($sql); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();  //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]

$pw = password_verify($lpw, $val["lpw"]);
if( $pw ){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"]     = $val['kanri_flg'];
  $_SESSION["uname"]     = $val['uname'];
  $_SESSION["role"]     = $val['role'];
  //pwは絶対預けない
  //Login成功時（リダイレクト）
  redirect("list.php");
}else{
  // //Login失敗時(Logoutを経由：リダイレクト)
  // redirect("user_login.html");
  
  print'ログインエラーです<br/?>';
  print'<a href="./user_login.html">ログイン画面へ</a>';
}

exit();
//事件の時はexitを上において動作確認


