<?php

session_start();


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
            <a class="navbar-brand" href="logout.php">
               <?php
                echo 'ようこそ ', $_SESSION['name'], ' さん';
                ?>
            </a>
        <?php } ?>
        </div>
    </div>
  </nav>
</header>



?>