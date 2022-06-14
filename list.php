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
<title>相談案件一覧</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
  <h1>相談案件一覧</h1> 

  ログインユーザー：<?=$_SESSION["uname"]?> 
  レコード件数：<?php echo $row_count; ?>
  <a href="logout.php">ログアウト</a><br/>

 
  <table border='0'>
    <tr><td class="index">id</td><td class="index">相談の種類</td><td class="index">相談者氏名</td><td class="index">相談者年齢</td><td class="index">相談の対象</td><td class="index">対象者氏名</td><td class="index">対象者年齢</td><td class="index">対象者性別</td><td class="index">編集</td><td class="index">削除</td></tr>

    <?php 
    foreach($rows as $row){
    ?> 
    
    <td class="link">  
        <a href=detail.php?id=<?php echo $row['id'] ;?>><?php echo $row['id'] ;?></a>
        </td>
        
        <td><?php echo h($row['rtype']); ?></td> 
        <td><?php echo h($row['cname']); ?></td> 
        <td><?php echo h($row['cage']); ?></td> 
        <td><?php echo h($row['target']); ?></td> 
        <td><?php echo h($row['tname']); ?></td> 
        <td><?php echo h($row['tage']); ?></td> 
        <td><?php echo h($row['tsex']); ?></td> 
        <td><a href=detail.php?id=<?php echo $row['id'] ;?>>編集</a></td> 
        <td><a href=delete.php?id=<?php echo $row['id'] ;?>>削除</a></td> 
      </tr> 
      <?php 
    } 
    ?>
  </table>
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