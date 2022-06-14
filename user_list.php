<?php
//0. SESSION開始！！
session_start();

//1. DB接続
include("./funcs.php");
$pdo = db_conn();

//ログイン確認
sschk();

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM user"); //SQLをセット
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入
	
//2. レコード件数取得
	$row_count = $stmt->rowCount();
	while($row = $stmt->fetch()){
		$rows[] = $row;
	}

//3. データベース接続切断
	$pdo = null;

?>
 
<!DOCTYPE html>
<html>
<head>
<title>利用者一覧</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
  <h1>利用者一覧</h1>
  ログインユーザー：<?=$_SESSION["uname"]?>
  件数：<?php echo $row_count; ?>
  <a href="user_entry.php">新規登録</a>
  <a href="logout.php">ログアウト</a><br/>
 
  <table border='0'>
    <tr><td class="index">id</td><td class="index">氏名</td><td class="index">ユーザーID</td><td class="index">専門職種</td><td class="index">所属センター</td><td class="index">管理フラグ</td><td class="index">在職フラグ</td><td class="index">編集</td><td class="index">削除</td></tr>

    <?php 
    foreach($rows as $row){
    ?> 
    
    <td class="link">  
        <a href=user_edit.php?id=<?php echo $row['id'] ;?>><?php echo $row['id'] ;?></a>
        </td>
        
        <td><?php echo h($row['uname']); ?></td> 
        <td><?php echo h($row['lid']); ?></td> 
        <td><?php echo h($row['role']); ?></td> 
        <td><?php echo h($row['center']); ?></td> 
        <td><?php echo h($row['kanri_flg']); ?></td> 
        <td><?php echo h($row['life_flg']); ?></td> 
        <td><a href=user_edit.php?id=<?php echo $row['id'] ;?>>編集</a></td> 
        <td><a href=user_delete.php?id=<?php echo $row['id'] ;?>>削除</a></td> 
      </tr> 
      <?php 
    } 
    ?>
  </table>
   <a href="./list.php">相談案件一覧</a>
 </body>
</html>