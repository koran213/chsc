<?php
include("./post_data.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>確認画面</title>
</head>
<body>

<form action="complete.php" method="post">
<h1>入力内容確認</h1>
<dl class="dlTable">
    <dt><label for="cname">相談者のお名前</label></dt>
	  <dd><?php echo htmlspecialchars($cname,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="cmail">相談者のメールアドレス</label></dt>
	  <dd><?php echo htmlspecialchars($cmail,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="cage">相談者の年齢</label></dt>
	  <dd><?php echo htmlspecialchars($cage,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="target">相談の対象者</label></dt>
    <dd><?php echo htmlspecialchars($target,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="tname">対象者のお名前</label></dt>
	  <dd><?php echo htmlspecialchars($tname,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="tage">対象者の年齢</label></dt>
	  <dd><?php echo htmlspecialchars($tage,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="tsex">対象者の性別</label></dt>
	  <dd><?php echo htmlspecialchars($tsex,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="tpcode">対象者の住所（郵便番号）</label></dt>
	  <dd><?php echo htmlspecialchars($tpcode,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="taddress">対象者の住所（市区町村以下）</label></dt>
	  <dd><?php echo htmlspecialchars($taddress,ENT_QUOTES,'UTF-8');?></dd>
    <dt><label for="rtype">相談の種類</label></dt>
    <dd><?php echo $rtype;?></dd>
    <dt><label for="contact">希望する応対</label></dt>
    <dd><?php echo $contact;?></dd>
    <dt><label for="detail">相談の内容</label></dt>
    <dd><?php echo nl2br(htmlspecialchars($detail,ENT_QUOTES,'UTF-8'));?></dd>
</dl>
<input type='button' onclick='history.back()' value='戻る' class="btn-border">
<input type="submit" name="submit" value="送信" class="btn-border">
<input type="hidden" name="cname" value="<?php echo $cname;?>">
<input type="hidden" name="cmail" value="<?php echo $cmail;?>">
<input type="hidden" name="cage" value="<?php echo $cage;?>">
<input type="hidden" name="target" value="<?php echo $target;?>">
<input type="hidden" name="tname" value="<?php echo $tname;?>">
<input type="hidden" name="tage" value="<?php echo $tage;?>">
<input type="hidden" name="tsex" value="<?php echo $tsex;?>">
<input type="hidden" name="tpcode" value="<?php echo $tpcode;?>">
<input type="hidden" name="taddress" value="<?php echo $taddress;?>">
<input type="hidden" name="rtype" value="<?php echo $rtype;?>">
<input type="hidden" name="contact" value="<?php echo $contact;?>">
<input type="hidden" name="detail" value="<?php echo $detail;?>">
</form>


</body>
</html>