<?php session_start();?>
<?php require '../header.php';?>
<?php require 'menu.php';?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=ookura_maki_shop;charset=utf8','ookura_maki','Asdf3333-');
if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];
  
  $sql=$pdo->prepare(
		'select * from customer 
		where id!=? and login=?');
	$sql->execute([$id, $_REQUEST['login']]);
	
} else {
	$sql=$pdo->prepare('select * from customer 
	where login=?');
	$sql->execute([$_REQUEST['login']]);
}

if (empty($sql->fetchAll())) {

	$hash = password_hash($_REQUEST['password'] , PASSWORD_DEFAULT);

		if (isset($_SESSION['customer'])) {

			$sql=$pdo->prepare(
				'update customer 
					set name=?, address=?, login=?, password=? 
					where id=?' );

				$sql->execute([
					$_REQUEST['name'], 
					$_REQUEST['address'], 
					$_REQUEST['login'], 
					$hash, 
					$id
				]);

				$_SESSION['customer']=[
						'id'=>$id, 
						'name'=>$_REQUEST['name'], 
						'address'=>$_REQUEST['address'], 
						'login'=>$_REQUEST['login'], 
				];
			
				echo 'お客様情報を更新しました。';

		} else {

			$sql=$pdo->prepare(
				'insert into customer 
				 values(null,?,?,?,?)'
			);
			$sql->execute([
				$_REQUEST['name'], 
				$_REQUEST['address'], 
				$_REQUEST['login'], 
				$hash
			]);
			echo 'お客様情報を登録しました。';
		}

} else {

	echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>
<?php require '../footer.php'; ?>