<?php
include("./funcs.php");
include("./post_data.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>入力内容確認</title>
  <script src="https://kit.fontawesome.com/cc574eb474.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/contact.css">

</head>

<body>
  <div class="wrap">
  
    <header>
      <div class="pagetitle">
        <p>新宿区高齢者総合相談センター</p>
      </div> 
      <div class="pagetitle">
        <p>ご相談フォーム</p>
    </header>

    <main> 
      <div class="section">
      <h1>入力内容確認</h1>
        <form action="complete.php" method="post" class="request">
          <div class="section_label">
            <p>相談者</p>
          </div> 
          <dl class="dlTable">
            <dt><label for="cname" class="cname label"><p>氏名</p></label></dt>
            <dd><p><?php echo h($cname);?></p></dd>
            <dt><label for="cage" class="cage label"><p>年齢</p></label></dt>
            <dd><p><?php echo h($cage);?></p></dd>
            <dt><label for="ctel" class="target label"><p>電話番号</p></label></dt>
            <dd><p><?php echo h($ctel);?></p></dd>
            <dt><label for="cmail" class="target label"><p>メールアドレス</p></label></dt>
            <dd><p><?php echo h($cmail);?></p></dd>
            <dt><label for="cway" class="target label"><p>希望する連絡手段</p></label></dt>
            <dd><p><?php echo h($cway);?></p></dd>
            <dt><label for="target" class="cmail label"><p>支援対象との間柄</p></label></dt>
            <dd><p><?php echo h($target);?></p></dd>
          </dl>

          <div class="section_label">
            <p>支援対象</p>
          </div>
          <dl class="dlTable">
            <dt><label for="tname" class="cname label"><p>氏名</p></label></dt>
            <dd><p><?php echo h($tname);?></p></dd>
            <dt><label for="tage" class="cage label"><p>年齢</p></label></dt>
            <dd><p><?php echo h($tage);?></p></dd>
            <dt><label for="tsex" class="tsex label"><p>性別</p></label></dt>
            <dd><p><?php echo h($tsex);?></p></dd>
            <dt><label for="tpcode" class="cage label"><p>〒</p></label></dt>
            <dd><p><?php echo h($tpcode);?></p></dd>
            <dt><label for="taddress" class="cmail label"><p>住所</p></label></dt>
            <dd><p><?php echo h($taddress);?></p></dd>
          </dl>  

          <div class="section_label">
            <p>相談内容</p>
          </div>
          <dl class="dlTable">
            <dt><label for="ctype" class="ctype label"><p>相談の種類</p></label></dt>
            <dd><p><?php echo h($ctype);?></p></dd>
            <dt><label for="contact" class="contact label"><p>希望する応対</p></label></dt>
            <dd><p><?php echo h($contact);?></p></dd>
            <dt class="row_high_2"><label for="detail" class="detail tlabel"><p>相談の内容</p></label></dt>
            <dd class="row_high_2"><p><?php echo h($detail);?></p></dd>
          </dl>
          <div class="button">
            <input type='button' onclick='history.back()' value='戻る' class="next">
            <input type="submit" name="submit" value="送信"  class="next">
          </div>
          <input type="hidden" name="cname" value="<?php echo $cname;?>">
          <input type="hidden" name="cage" value="<?php echo $cage;?>">
          <input type="hidden" name="ctel" value="<?php echo $ctel;?>">
          <input type="hidden" name="cmail" value="<?php echo $cmail;?>">
          <input type="hidden" name="cway" value="<?php echo $cway;?>">
          <input type="hidden" name="target" value="<?php echo $target;?>">
          <input type="hidden" name="tname" value="<?php echo $tname;?>">
          <input type="hidden" name="tage" value="<?php echo $tage;?>">
          <input type="hidden" name="tsex" value="<?php echo $tsex;?>">
          <input type="hidden" name="tpcode" value="<?php echo $tpcode;?>">
          <input type="hidden" name="taddress" value="<?php echo $taddress;?>">
          <input type="hidden" name="ctype" value="<?php echo $ctype;?>">
          <input type="hidden" name="contact" value="<?php echo $contact;?>">
          <input type="hidden" name="detail" value="<?php echo $detail;?>">
        </form>
      </div>
    </main>
  </div>


</body>
</html>