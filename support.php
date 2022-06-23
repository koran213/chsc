<?php

//0. SESSION開始！！
session_start();

//(1) 取得するデータのidを指定
 $id = $_GET['id'];

//(2) データベースに接続
include("./funcs.php");
$pdo = db_conn();

//ログイン確認
sschk();
  
// (3) SQL作成
$sql = 'SELECT * FROM contact INNER JOIN pcodelink on tpcode = pcode WHERE id= :id';//WHERE contact.id=idによりid変数を指定
$stmt = $pdo -> prepare($sql);

// (4) 登録するデータをセット
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$stmt->execute();

// (5) SQL実行
//fetch()で一つのデータを取得
$r=$stmt->fetch(PDO::FETCH_ASSOC);

//(6) データベースの接続解除
$stmt = null;
$pdo = null;

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>対応詳細</title>
    <script src="https://kit.fontawesome.com/cc574eb474.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/detail.css">

  </head>

  <body>
    <div class="wrap">
    
      <div class="header">
        <div class="pagetitle">
          <i class="fas fa-file-alt fa-2x" style="color:#DB1F48"></i>
          <p style="font-size: 20px; margin:0; font-family: 'Kosugi Maru', sans-serif;line-height: 40px;">相談案件対応</p>
        </div>
        <div class="out">
          <i class="fa-solid fa-circle-chevron-left centering" style="font-size:24px; color:#DB1F48"></i>
          <div class="mask">
            <a href="list.php"><div class="caption">一覧に戻る</div></a>
          </div>
        </div>
        <div class="login">
          <div class="login_user">
            <i class="fas fa-user-circle centering" style="font-size:24px; color:#01949A;"></i><p>&nbsp;<?=$_SESSION["uname"]?></p>
          </div>
          <div class="out">        
            <i class="fas fa-sign-out-alt centering" style="font-size:24px; color:#01949A;"></i>      
            <div class="mask">
              <a href="logout.php"><div class="caption">ログアウト</div></a>
            </div>
          </div>
        </div>
      </div>

      <div class="main">  

        <div class="request">
          <div class="index flex">
            <p>ID：<?php echo h($r['id']); ?></p>
            <p>送信日時:<?php echo h($r['cdate']); ?></p>         
          </div>
          <dl class="section">
            <div class="section_label">
              <i class="fa-solid fa-hand-holding-heart" style="font-size:24px; color:#DB1F48;"></i><p>相談者</p>
            </div>  
            <div class="flex">
              <dt><label class="cname label"><p>氏名</p></label></dt>
              <dd class="data"><p><?php echo h($r['cname']); ?></p></dd>
              <dt><label class="cage label"><p>年齢</p></label></dt>
              <dd class="data"><p><?php echo h($r['cage']); ?></p></dd>
              <dt><label class="cmail label"><p>支援対象との間柄</p></label></dt>
              <dd class="data"><p><?php echo h($r['target']); ?></p></dd>
              <dt><label class="target label"><p>電話番号</p></label></dt>
              <dd class="data"><p><?php echo h($r['ctel']); ?></p></dd>
              <dt><label class="target label"><p>メールアドレス</p></label></dt>
              <dd class="data"><p><?php echo h($r['cmail']); ?></p></dd>
            </div>
            <div class="flex">
              <dt><label class="target label"><p>希望する連絡手段</p></label></dt>
                <dd class="data"><p><?php echo h($r['cway']); ?></p></dd>
            </div>
          </dl>
          <dl class="section">
            <div class="section_label">
              <i class="fa-solid fa-person-circle-exclamation" style="font-size:24px; color:#DB1F48;"></i><p>支援対象</p>
            </div>
            <div class="flex">
              <dt><label class="cname label"><p>氏名</p></label></dt>
              <dd class="data"><p><?php echo h($r['tname']); ?></p></dd>
              <dt><label class="cage label"><p>年齢</p></label></dt>
              <dd class="data"><p><?php echo h($r['tage']); ?></p></dd>
              <dt><label class="cage label"><p>性別</p></label></dt>
              <dd class="data"><p><?php echo h($r['tsex']); ?></p></dd>
              <dt><label class="cage label"><p>〒</p></label></dt>
              <dd class="data"><p><?php echo h($r['tpcode']); ?></p></dd>
              <dt><label class="cmail label"><p>住所</p></label></dt>
              <dd class="data"><p><?php echo h($r['taddress']); ?></p></dd>
            </div>
          </dl>  
          <dl class="section">
            <div class="section_label">
              <i class="fa-solid fa-comment-dots" style="font-size:24px; color:#DB1F48;"></i><p>相談内容</p>
            </div>
            <div class="flex">
              <dt><label class="ctype label"><p>相談の種類</p></label></dt>
              <dd class="data"><p><?php echo h($r['ctype']); ?></p></dd>
              <dt><label class="contact label"><p>希望する応対</p></label></dt>
              <dd class="data"><p><?php echo h($r['contact']); ?></p></dd>
            </div>
              <dt><label class="detail tlabel"><p>相談の内容</p></label></dt>
              <dd class="textarea"><p><?php echo h($r['detail']); ?></p></dd>
          </dl>
          <!-- <div class="out right">
            <i class="fa-solid fa-handshake-simple" style="font-size:24px; color:#DB1F48"></i>
            <div class="mask">
              <a href="detail_edit.php"><div class="caption">対応する</div></a>
            </div>
          </div> -->
        </div>

        <div class="support">
          <div class="index flex">
            <p></p>
            <p></p>         
          </div>
          <form action="support_insert.php" method="POST">
          <dl class="section">
            <div class="section_label">
              <i class="fa-solid fa-people-roof" style="font-size:24px; color:#DB1F48;"></i><p>支援対応</p>
            </div>
            <div class="flex">
              <dt><label class="area label"><p>担当地域センター</p></label></dt>
              <dd class="data"><p><?php echo h($r['ccode']);?>  
              <dt><label class="supporter label"><p>担当者</p></label></dt>
              <dd class="data"><p><?=$_SESSION["uname"]?></p></dd>
              <dt><label class="supporter label"><p>専門職種</p></label></dt>
              <dd class="data"><p><?=$_SESSION["role"]?></p></dd>
            </div>
              <dt><label class="detail tlabel"><p>対応内容</p></label></dt>
              <dd class="textarea"><p><textarea name="support" id="support" cols="30" rows="10" class="textarea"></textarea></p></dd>        
          </dl> 
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="ccode" value="<?=$r['ccode']?>">
          <input type="hidden" name="uname" value="<?=$_SESSION["uname"]?>">
          <input type="hidden" name="role" value="<?=$_SESSION["role"]?>">

          <input type="submit" class="next" value="登録する">
          <!-- <input type="submit" class="next" value="相談者へ送信"> -->

        </div>
      </div>
    </div>
  </body>
</html>

