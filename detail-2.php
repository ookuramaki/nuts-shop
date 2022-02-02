<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php require '../chapter6/connect.php'; ?>
<?php
 
$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
$sql->execute([$_REQUEST['id']]);

var_dump($sql);//配列ではない、特殊なオブジェクト　表の格好=2次元配列
foreach ($sql as $row) {　//表から行を取り出している
　//$sqlは1行しか無いが、2次元の格好をしている
  //ループは1回しかしない
  // row'行'　列　col
  //　3　ひまわりの種　210


?>
	<p>
		<img src="image/<?=$row['id']?>.jpg">
	</p>
	<form action="cart-insert.php" method="post">
		<p>商品番号：<?= $row['id']?></p>
		<p>商品名：<?= $row['name']?></p>
		<p>価格：<?= $row['price']?></p>
		<p>個数：<select name="count">
		<?php	
			for ($i=1; $i<=10; $i++) {
				echo "<option value='$i'> $i</option>";
			} 
		?>
		</select></p>
		<input type="hidden" name="id" value="<?= $row['id']?>">
		<input type="hidden" name="name" value="<?= $row['name']?>">
		<input type="hidden" name="price" value="<?= $row['price']?>">
		<p><input type="submit" value="カートに追加"></p>
	</form>

	<p>
  もしフォームで書いた場合,どっちも同じ結果になる
　<form action="favorite-insert.php" method="get">
    <input type="submit" name="id"
      value="<?=$row['id']?>">
  </form>
  <a href="favorite-insert.php?id=<?= $row['id']?>">お気に入りに追加</a></p>
<?php }  //foreach end
?>
<?php require '../footer.php'; ?>
