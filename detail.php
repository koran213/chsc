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
$sql = 'SELECT * FROM contact WHERE id= :id';//WHERE contact.id=idによりid変数を指定
$stmt = $pdo -> prepare($sql);

// (4) 登録するデータをセット
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$stmt->execute();

// (5) SQL実行
//fetch()で一つのデータを取得
$case=$stmt->fetch(PDO::FETCH_ASSOC);

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
  <title>対応詳細‗地域包括支援センター</title>
  <link rel="stylesheet" href="./css/center.css">
</head>

<body>
ログインユーザー：<?=$_SESSION["uname"]?>
<a href="logout.php">ログアウト</a><br/>
 <div class="card">
   <div class="index flex">
     <div class="no">id:<?php echo htmlspecialchars($id,ENT_QUOTES,'UTF-8'); ?></div>
     <div class="center">角筈地域支援センター</div>
     <div class="createdate">送信日時</div>
   </div>
   <dl class="section client"><p>相談者</p>
    <div class="flex">
      <dt><label class="cname label">氏名</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['cname'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="cage label">年齢</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['cage'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="cmail label">メールアドレス</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['cmail'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="target label">相談の対象者</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['target'],ENT_QUOTES,'UTF-8'); ?></dd>
    </div>
   </dl>
   <dl class="section target"><p>対象者</p>
    <div class="flex">
      <dt><label class="cname label">氏名</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['tname'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="cage label">年齢</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['tage'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="cage label">性別</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['tsex'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="cage label">郵便番号</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['tpcode'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="cmail label">住所</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['taddress'],ENT_QUOTES,'UTF-8'); ?></dd>
    </div>
    </dl>  
    <dl class="section client"><p>相談案件</p>
      <div class="flex">
      <dt><label class="rtype label">相談の種類</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['rtype'],ENT_QUOTES,'UTF-8'); ?></dd>
      <dt><label class="contact label">希望する応対</label></dt>
      <dd class="data"><?php echo htmlspecialchars($case['contact'],ENT_QUOTES,'UTF-8'); ?></dd>
     </div>
      <dt><label class="detail tlabel">相談の内容</label></dt>
      <dd class="textarea"><?php echo htmlspecialchars($case['detail'],ENT_QUOTES,'UTF-8'); ?></dd>
    </dl> 
    <dl class="section target"><p>支援対応</p>
      <div class="flex">
        <dt><label class="area label">担当地域センター</label></dt>
        <dd class="data">角筈</dd>
        <dt><label class="supporter label">担当者</label></dt>
        <dd class="data">鼠坂ネズ</dd>
      </div>
    </dl> 
 </div>
 <a href="list.php">一覧に戻る</a><br/>
  
</body>
</html>