<?php
//0. SESSION開始！！
session_start();

//1. DB接続
include("./funcs.php");
$pdo = db_conn();

//ログイン確認
sschk();

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM contact"); //SQLをセット
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入
	
//3. レコード件数取得
	$row_count = $stmt->rowCount();
	while($row = $stmt->fetch()){
		$rows[] = $row;
	}

//4. データベース接続切断
	$pdo = null;

?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>相談案件一覧</title>
<script src="https://kit.fontawesome.com/cc574eb474.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/list.css">
</head>

<body>
  <div class="wrap">
    
    <div class="header">
      <div class="pagetitle">
        <i class="fas fa-file-alt fa-2x" style="color:#DB1F48"></i>
        <p style="font-size: 20px; margin:0; font-family: 'Kosugi Maru', sans-serif;line-height: 40px;">相談案件一覧</p>
      </div>
      <div class="count"><p>レコード件数：<?php echo $row_count; ?></p></div>
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

      <div class="list">
    
        <table border='0'>
          <tr><td class="index">id</td><td class="index">送信日時</td><td class="index">相談の種類</td><td class="index">相談者氏名</td><td class="index">相談者年齢</td><td class="index">相談の対象</td><td class="index">対象者氏名</td><td class="index">対象者年齢</td><td class="index">対象者性別</td><td class="index">編集</td><td class="index">削除</td></tr>

          <?php 
          foreach($rows as $r){
          ?> 
          
          <td class="link">  
              <a href=detail.php?id=<?php echo $r['id'] ;?>><?php echo $r['id'] ;?></a>
              </td>
              <td><?php echo h($r['cdate']); ?></td> 
              <td><?php echo h($r['ctype']); ?></td> 
              <td><?php echo h($r['cname']); ?></td> 
              <td><?php echo h($r['cage']); ?></td> 
              <td><?php echo h($r['target']); ?></td> 
              <td><?php echo h($r['tname']); ?></td> 
              <td><?php echo h($r['tage']); ?></td> 
              <td><?php echo h($r['tsex']); ?></td> 
              <td><a href=detail.php?id=<?php echo $r['id'] ;?>>編集</a></td> 
              <td><a href=delete.php?id=<?php echo $r['id'] ;?>>削除</a></td> 
            </tr> 
            <?php 
          } 
          ?>
        </table>
      </div>
    </div>
  </div>

  <?php
    if($_SESSION["kanri_flg"]=="1"){
      print'<a href="./user_list.php">ユーザー管理画面</a>';

        // exit();
      }else{
      exit();
      }
  ?>
    </body>
</html>
  
