<?php
session_start();

//1. POSTデータ取得

$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];


//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg, date )VALUES(NULL, :name, :lid, :lpw, 0, 0, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute(); //executeは実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php"); //Location:　のあとに必ずスペースが必要
  exit;

}
?>
