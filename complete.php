<?php
// 直リンクされた場合search.phpにリダイレクト
if($_SERVER["REQUEST_METHOD"] != "POST"){
	header("Location: search.php");
	exit();
}

//1. POSTデータ取得
include('post_data.php');

//2. DB接続
include("./funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO contact (cname,cage,ctel,cmail,cway,target,tname,tage,tsex,tpcode,taddress,ctype,contact,detail,cdate)
VALUES(:cname, :cage, :ctel, :cmail, :cway, :target, :tname, :tage, :tsex, :tpcode, :taddress, :ctype, :contact, :detail, sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':cname', $cname, PDO::PARAM_STR);  //Inrtypeteger（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cage', $cage, PDO::PARAM_INT);  
$stmt->bindValue(':ctel', $ctel, PDO::PARAM_STR);  
$stmt->bindValue(':cmail', $cmail, PDO::PARAM_STR);  
$stmt->bindValue(':cway', $cway, PDO::PARAM_STR);  
$stmt->bindValue(':target', $target, PDO::PARAM_STR);  
$stmt->bindValue(':tname', $tname, PDO::PARAM_STR);  
$stmt->bindValue(':tage', $tage, PDO::PARAM_INT);  
$stmt->bindValue(':tsex', $tsex, PDO::PARAM_STR);  
$stmt->bindValue(':tpcode', $tpcode, PDO::PARAM_INT);  
$stmt->bindValue(':taddress', $taddress, PDO::PARAM_STR);  
$stmt->bindValue(':ctype', $ctype, PDO::PARAM_STR);  
$stmt->bindValue(':contact', $contact, PDO::PARAM_STR);  
$stmt->bindValue(':detail', $detail, PDO::PARAM_STR);  
$status = $stmt->execute(); //$statusにはtrue,falseが返る

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}else{
  //５．メール送信
  //６．index.phpへリダイレクト
  // header("Location: index.html");
  // exit();
}
// ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>完了画面</title>
  <script src="https://kit.fontawesome.com/cc574eb474.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <header>
    <div class="pagetitle">
      <p>新宿区高齢者総合相談センター</p>
    </div> 
    <div class="pagetitle">
      <p>ご相談フォーム</p>
    </div>
  </header>
  <main> 
    <div class="section">
      <h1>受付完了</h1>

      <p>今回のご相談内容が自動返信で届きます。</p>
      <p>もし届いていないようでしたら、確認いたしますので●●までお知らせください。</p>
      <p>送信完了後３稼働日以内に、センターの担当者より返信いたします。今しばらくお待ちください。</p>
      <p>なお、センターからの返信の前に、今回のご相談に変更が生じた場合は、自動返信メール内に記載のある担当センターまでお知らせください。</p>
      <!-- <p><a href="search.php">ご相談フォームトップへ</p> -->
      <!-- <div class="button"> -->
            <input type='button' onclick='href="search.php"' value='トップへ戻る' class="next">
          </div>
    </div>
  </main>

</body>
</html>