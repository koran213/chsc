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

if (isset($ct_id['ct_id'])) {
// if (isset($ct_id)) {
  $sql = "SELECT * FROM support on id = ct_id = $ct_id";
  $stmt = $strJavaScript = 
  '<script>
      $(function(){
          document.getElementById("status").innerHTML = "<p>済</p>"
        }
      });
  </script>';
  $status = $stmt->execute();
}else {
  $search ="";
  $stmt = [];
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
      <div class="manage" style="width: 190px; display: flex;">
        <div class="out">        
          <i class="fa-solid fa-address-card centering" style="font-size:26px; color:#DB1F48;"></i>      
          <div class="mask">
            <a href="user_list.php"><div class="caption">利用者管理へ</div></a>
          </div>
        </div>
        <div class="out">        
          <i class="fa-solid fa-building centering" style="font-size:26px; color:#DB1F48;"></i>      
          <div class="mask">
            <a href="center_list.php"><div class="caption">センター管理</div></a>
          </div>
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

      <div class="list">
    
        <table border='0'>
          <tr>
            <td class="index"><p>id</p></td>
            <td class="index"><p>送信日時</p></td>
            <td class="index"><p>対応</p></td>
            <td class="index"><p>相談の種類</p></td>
            <td class="index"><p>相談者氏名</p></td>
            <td class="index"><p>相談者年齢</p></td>
            <td class="index"><p>相談の対象</p></td>
            <td class="index"><p>対象者氏名</p></td>
            <td class="index"><p>対象者年齢</p></td>
            <td class="index"><p>対象者性別</p></td>
            <td class="index"><p>編集</p></td></tr>

          <?php 
          foreach($rows as $r){
          ?> 
          
          <td class="link">  
              <a href=detail.php?id=<?php echo $r['id'] ;?>><?php echo $r['id'] ;?></a>
              </td>
              <td><?php echo h($r['cdate']); ?></td>
              <td><p id="status">新規</p></td>  
              <td><p><?php echo h($r['ctype']); ?></p></td> 
              <td><p><?php echo h($r['cname']); ?></p></td> 
              <td><p><?php echo h($r['cage']); ?></p></td> 
              <td><p><?php echo h($r['target']); ?></p></td> 
              <td><p><?php echo h($r['tname']); ?></p></td> 
              <td><p><?php echo h($r['tage']); ?></p></td> 
              <td><p><?php echo h($r['tsex']); ?></p></td> 
              <td><p><a href=detail.php?id=<?php echo $r['id'] ;?>>編集</a></p></td> 
            </tr> 
            <?php 
          } 
          ?>
        </table>
      </div>
    </div>
  </div>

  <?php
    if($_SESSION["kanri_flg"]=="2"){
      print'<p><a href="./user_list.php">ユーザー管理画面</a></p>';
      print'<p><a href="./center_list.php">センター管理画面</a></p>';
    }elseif($_SESSION["kanri_flg"]=="1"){
      exit();
      print'<a href="./user_list.php">ユーザー管理画面</a>';
    }else{
      exit();
    }
  ?>
    </body>
</html>
  
