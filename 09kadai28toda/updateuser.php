<?php
//1. POSTデータ取得
$id = $_POST["id"];
$bookname = $_POST["name"];
$bookurl = $_POST["lid"];
$comment = $_POST["lpw"];
//var_dump($_POST);

//2. DB接続します
try { //エラー入ったときに
  $pdo = new PDO('mysql:dbname=gs_db28;charset=utf8;host=localhost','root','');
} catch (PDOException $e) { //受信します
  exit('DbConnectError:'.$e->getMessage()); //エラー表示
}


//３．データ登録SQL作成
$update = $pdo->prepare("UPDATE gs_user_table SET name=:name,lid=:lid,lpw=:lpw WHERE id=:id");
$update->bindValue(':id', $id, PDO::PARAM_INT);
$update->bindValue(':name', $bookname, PDO::PARAM_STR);
$update->bindValue(':lid', $bookurl, PDO::PARAM_STR);
$update->bindValue(':lpw', $comment, PDO::PARAM_STR);
$status = $update->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $update->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    header("Location: selectuser.php");
    exit;

}




?>