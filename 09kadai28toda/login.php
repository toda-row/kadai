<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>09ログイン</title>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a>
        <a class="navbar-brand" href="selectbook.php">書籍の一覧</a>
        <?php
            if(
                !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
            ) {
        ?>
            <a class="navbar-brand" href="login.php">ログイン</a>
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
        <?php } ?>
        </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
  <div class="container jumbotron">
   <fieldset>
    <legend>ログインする</legend>
     <label>ID:<input type="text" name="lid"></label><br>
     <label>PW:<input type="password" name="lpw"></label><br>
     <input type="submit" value="LOGIN">
    </fieldset>
  </div>
</form>



</body>
</html>