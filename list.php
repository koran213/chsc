<?php

//1. DB接続
include("./funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM contact"); //SQLをセット
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
<title>相談案件一覧</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
  <h1>相談案件一覧</h1> 
 
  レコード件数：<?php echo $row_count; ?>
 
  <table border='0'>
    <tr><td class="index">id</td><td class="index">相談の種類</td><td class="index">相談者氏名</td><td class="index">相談者年齢</td><td class="index">相談の対象</td><td class="index">対象者氏名</td><td class="index">対象者年齢</td><td class="index">対象者性別</td><td class="index">編集</td><td class="index">削除</td></tr>

    <?php 
    foreach($rows as $row){
    ?> 
    
    <td class="link">  
        <a href=detail.php?id=<?php echo $row['id'] ;?>><?php echo $row['id'] ;?></a>
        </td>
        
        <td><?php h($row['rtype']); ?></td> 
        <td><?php h($row['cname']); ?></td> 
        <td><?php h($row['cage']); ?></td> 
        <td><?php h($row['target']); ?></td> 
        <td><?php h($row['tname']); ?></td> 
        <td><?php h($row['tage']); ?></td> 
        <td><?php h($row['tsex']); ?></td> 
        <td><a href=detail.php?id=<?php echo $row['id'] ;?>>編集</a></td> 
        <td><a href=delete.php?id=<?php echo $row['id'] ;?>>削除</a></td> 
      </tr> 
      <?php 
    } 
    ?>
  </table>
 </body>
</html>