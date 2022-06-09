<?php

//1. DB接続
include("./funcs.php");
$pdo = db_conn();

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
 
  件数：<?php echo $row_count; ?>
  <a href="user_entry.php">新規登録</a>
 
  <table border='0'>
    <tr><td class="index">id</td><td class="index">氏名</td><td class="index">ユーザーID</td><td class="index">ユーザーPW</td><td class="index">管理フラグ</td><td class="index">所属センター</td><td class="index">編集</td><td class="index">削除</td></tr>

    <?php 
    foreach($rows as $row){
    ?> 
    
    <td class="link">  
        <a href=user_edit.php?id=<?php echo $row['id'] ;?>><?php echo $row['id'] ;?></a>
        </td>
        
        <td><?php h($row['uname']); ?></td> 
        <td><?php h($row['lid']); ?></td> 
        <td><?php h($row['lpw']); ?></td> 
        <td><?php h($row['kanri']); ?></td> 
        <td><?php h($row['center']); ?></td> 
        <td><a href=user_edit.php?id=<?php echo $row['id'] ;?>>編集</a></td> 
        <td><a href=user_delete.php?id=<?php echo $row['id'] ;?>>削除</a></td> 
      </tr> 
      <?php 
    } 
    ?>
  </table>
 </body>
</html>