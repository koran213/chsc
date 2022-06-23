<?php
 ini_set('display_errors',1);
 include("./funcs.php");
 $pdo = db_conn();

if (isset($_GET['search'])) {
  $search = htmlspecialchars($_GET['search']);
  $sql = "SELECT * FROM pcodelink INNER JOIN center on cid = center_id where pcode = $search";
  $stmt   = $pdo->query($sql); //SQLをセット
  $status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入
}else {
  $search ="";
  $stmt = [];
}
?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <script src="https://kit.fontawesome.com/cc574eb474.js" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="./css/style.css">
     <title>センター検索</title>
   </head>
   <body>
   <header>
    <div class="pagetitle">
      <p>新宿区高齢者総合相談センター</p>
    </div> 
    <div class="pagetitle">
      <p>担当センター確認・ご相談フォーム</p>
    </div>
  </header>

  <main>
    <div class="section">
      <h1>ご利用にあたって</h1>
      <p>こちらは新宿区の高齢者総合相談センター（地域包括支援センター）への相談フォームです。</p>
      <p>相談の対応窓口は、<span class="attention">支援対象者の住所がある市区町村</span>になります。</p>
      <p>相談者と支援対象者の住所が異なる場合は、お気をつけください。</p>
      <h1>ご利用方法</h1>
      <p>本フォームは、「①担当センター確認」「②相談フォーム」の２段階で構成されています。</p>
      <p>担当センター確認のみの方は、以下「①担当センター確認」後、「終了する」ボタンで終了してください。</p>
      <p>続けて相談を希望する方は、上記同様に確認後、「②相談フォームへ」ボタンをクリックしてください。</p>
    </div>
    <div class="section">
      <h1>① 担当センター確認</h1>
      <h2>郵便番号</h2>
      <form action="search.php" method="get">
        <input type="text" name="search" placeholder="数字７桁で入力" class="inputbox">
        <input type="submit" name="" value="確認" class="button">
     </form>

     <?php foreach ($stmt as $row): ?>
       <h2>担当センター</h2>
       <div class="center">
       <a href="<?php echo h($row['url']);?>" target="_blank" rel="noopener noreferrer"><p style="font-size: 20px; padding: 0;"><?php echo h($row['center']);?></p></a>
       <p style="padding: 0; margin-left:20px;">クリックすると別タブで詳細が開きます</p>
       </div>
    <?php endforeach; ?>

    <div class="exit">
      <form action="contact.html" method="get">
      <input type="submit" class="next" name="" value="② 相談フォームへ"></form>
      <input type="button" class="next" name="" value="終了する" onClick="window.close();">
    </div>


   </body>
 </html>
            







</body>
</html>