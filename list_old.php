<?php

//1. DB接続
include("./funcs.php");
$pdo = db_conn();
$sql = 'SELECT * FROM contact';
$stmt = $pdo -> query($sql);
	
//2. レコード件数取得
	$row_count = $stmt->rowCount();
	while($row = $stmt->fetch()){
		$rows[] = $row;
	}
	/*
	foreach ($statement as $row) {
		$rows[] = $row;
	}
	*/
	
//3. データベース接続切断
	$pdo = null;
    
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }

 
// try{
// 	$dbh = new PDO($dsn, $user, $password);
// 	echo "接続成功";

?>
 
<!DOCTYPE html>
<html>
<head>
<title>nameテーブル表示</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/list.css">
</head>
<body>
  <h1>相談案件一覧</h1> 
 
  レコード件数：<?php echo $row_count; ?>
 
  <table border='0'>
    <tr><td class="index">id</td><td class="index">相談の種類</td><td class="index">相談者氏名</td><td class="index">相談者年齢</td><td class="index">相談の対象</td><td class="index">対象者氏名</td><td class="index">対象者年齢</td><td class="index">対象者性別</td></tr>
    
    <?php 
    foreach($rows as $row){
    ?> 
      <tr> 
        <!-- <td><?php echo $row['id']; ?></td>  -->

        <!-- <td><a href="detail.php?id=<?php echo $value['id']; ?>"><?php echo $row['id']; ?></a></td>    -->

        <!-- <td>
        <a href="detail.php?id=<?php echo $id; ?>"><?php echo $row['id'];?></a>
        </td>    -->

        <!-- <td>
        <a href="detail.php?id=<?php $_GET['id'];?>"><?php echo $row['id'];?></a>
        </td>    -->

        <td class="link">
        <?php
        $link_d = "detail.php?id=3";
        $link_d_id = $row['id'];
        echo"<a href=". $link_d .">". $link_d_id ."</a>";
        echo "<br />";?>
        </td>
        
        <td><?php echo htmlspecialchars($row['rtype'],ENT_QUOTES,'UTF-8'); ?></td> 
        <td><?php echo htmlspecialchars($row['cname'],ENT_QUOTES,'UTF-8'); ?></td> 
        <td><?php echo htmlspecialchars($row['cage'],ENT_QUOTES,'UTF-8'); ?></td> 
        <td><?php echo htmlspecialchars($row['target'],ENT_QUOTES,'UTF-8'); ?></td> 
        <td><?php echo htmlspecialchars($row['tname'],ENT_QUOTES,'UTF-8'); ?></td> 
        <td><?php echo htmlspecialchars($row['tage'],ENT_QUOTES,'UTF-8'); ?></td> 
        <td><?php echo htmlspecialchars($row['tsex'],ENT_QUOTES,'UTF-8'); ?></td> 
      </tr> 
    <?php 
    } 
    ?>
  </table>
 </body>
</html>