<?php

//1. DB接続
include("./funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM center"); //SQLをセット
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
<title>センター一覧</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
  <h1>センター一覧</h1> 
 
  件数：<?php echo $row_count; ?>
  <a href="center_entry.html">新規登録</a>
 
  <table border='0'>
    <tr>
      <td class="index">id</td>
      <td class="index">略称</td>
      <td class="index">センター名</td>
      <!-- <td class="index">住所</td> -->
      <td class="index">電話番号</td>
      <td class="index">メールアドレス</td>
      <!-- <td class="index">URL</td> -->
      <td class="index">編集</td>
      <td class="index">削除</td></tr>

    <?php 
     foreach($rows as $r){
    ?> 
    
    <td class="link">  
        <a href=center_edit.php?center_id=<?php echo $r['center_id'] ;?>><?php echo $r['center_id'] ;?></a>
        </td>
        <td><?php echo h($r['cc']); ?></td> 
        <td><?php echo h($r['center']); ?></td> 
        <!-- <td><?php echo h($r['address']); ?></td>  -->
        <td><?php echo h($r['tel']); ?></td> 
        <td><?php echo h($r['email']); ?></td> 
        <!-- <td><?php echo h($r['url']); ?></td>  -->
        <td><a href=center_edit.php?center_id=<?php echo $r['center_id'] ;?>>編集</a></td> 
        <td><a href=center_delete.php?center_id=<?php echo $r['center_id'] ;?>>削除</a></td> 
      </tr> 
      <?php 
    } 
    ?>

  </table>
  <a href="./list.php">相談案件一覧へ</a>
 </body>
</html>