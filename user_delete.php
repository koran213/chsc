<?php
//1. POSTデータ取得
$id   = $_GET["uid"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

//３．データ登録SQL作成
$sql = "DELETE FROM user WHERE uid=:uid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':uid',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //redirect("Location: list.php");
    header("Location: user_list.php");
    exit();
}

?>
