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

//４．センターデータ呼び出し
$sql2 = "SELECT * FROM pcodelink INNER JOIN center on cid = center_id where pcode = $tpcode";
$stmt2   = $pdo->query($sql2); //SQLをセット
$status2 = $stmt2->execute(); //SQLを実行

//５．メール送信
mb_language("Japanese");  //言語の指定
mb_internal_encoding("UTF-8"); //文字コードの指定

$to = $cmail; //送信先アドレスの指定
$subject = '自動送信【新宿区地域包括支援センター】ご相談受付完了のお知らせ';
$message = 'ご相談につきまして、以下の内容で受け付けました。'."\r\n";
$message .= '送信完了後３稼働日以内に、センターの担当者より返信いたします。今しばらくお待ちください。'."\r\n";
$message .= 'なお、今回のご相談に変更が生じた場合は、本メール末尾の担当センターまでお知らせください。'."\r\n";
$message .= '-----------------------------------'."\r\n";
$message .= '【ご相談内容】'."\r\n";
$message .= $detail."\r\n";
$message .= '-----------------------------------'."\r\n";
$message .= " \r\n";
foreach ($stmt2 as $r):
$message .= $r['center']."\r\n";
$message .= $r['address']."\r\n";
$message .= $r['tel']."\r\n";
$message .= $r['email']."\r\n";
endforeach;
// $additional_headers = "Content-Type: text/html; charset=\"ISO-2022-JP\";\r\n
// From: rankot@sakura.ne.jp\r\n
// Reply-To: rankot@sakura.ne.jp\r\n";//送信元の設定とヘッダのエンコード指定

$headers = "From: rankot@sakura.ne.jp";

mb_send_mail ($to, $subject,$message,$headers);

//６．データ登録・メール送信処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_error:".$error[2]);
}
?>

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
      <p>送信完了後３稼働日以内に、センターの担当者より返信いたします。今しばらくお待ちください。</p>
      <p>なお、自動返信メールが届かない場合、今回のご相談に変更が生じた場合は、自動返信メール内に記載のある担当センターまでお知らせください。</p>
            <input type='button' onclick='location.href="./search.php"' value='戻る' class="next">
          </div>
    </div>
  </main>

</body>
</html>