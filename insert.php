<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];
$age    = $_POST["age"];

//2. DB接続します
//*** function化する！  *****************
include("funcs.php");//外部ファイル読み込み
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO gs_table_3(name, email, naiyou, age,indate)
        VALUES(:name, :email, :naiyou, :age, sysdate())";
$stmt = $pdo->prepare("INSERT INTO gs_table_3(name,email,age,naiyou,indate)VALUES(:name,:email,:age,:naiyou,sysdate())");
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email',  $email,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age',    $age,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("index.php");
}
?>