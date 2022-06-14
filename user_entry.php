<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>利用者登録</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <h1>利用者登録</h1>
  <form action="user_confirm.php" method="post">
    <dl class="dlTable">
      <dt><label for="uname">氏名</label></dt>
      <dd><input type="text" name="uname" id="uname"></dd>
      <dt><label for="lid">利用者ID</label></dt>
      <dd><input type="text" name="lid" id="lid"></dd>
      <dt><label for="lpw">利用者パスワード</label></dt>
      <dd><input type="password" name="lpw" id="lpw"></dd>
      <dt><label for="role">職種</label></dt>
      <dd><input type="text" name="role" id="role"></dd>
      <dt><label for="center">センター</label></dt>
      <dd><input type="text" name="center" id="center"></dd>
      <dt><label for="kanri_flg">ユーザー種別</label></dt>
      <dd><input type="text" name="kanri_flg" id="kanri_flg"></dd>
      <dt><label for="life_flg">在職種別</label></dt>
      <dd><input type="text" name="life_flg" id="life_flg"></dd>
    </dl>
    <input type="submit" value="送信">
  </form>
  
</body>
</html>