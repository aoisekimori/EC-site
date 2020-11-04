<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHPポートフォリオ-MENU</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="wrap">
  <div class="menu-wrapper">
  <div class="header">
    <h1 class="title">IMAGINARY<br />CAFE</h1>
    <nav>
      <ul class="header-menu">
        <li><a href="../top.html">TOP</a></li>
        <li><a href="menu.php">MENU</a></li>
        <li><a href="../contact.html">CONTACT</a></li>
        <li><a href="../staff_login/staff_login_branch.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="header-title center">
    <h2 class="title">MENU</h2>
    <p class="stress">IMAGINARY CAFEは、有機食材を使用した出前専用のカフェです。<br>無添加ながらとても美味しく、”地球に近い”本来の味を楽しむことができます。<br>リラックスしたい時、身体に良いものを摂りたい時などにご利用ください。</p>
  </div>
</div>

<?php
   try {

     $cart=$_SESSION['cart'];
     $max=count($cart);

     $dbn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
     $user='root';
     $password='root';
     $dbh = new PDO($dbn,$user,$password);
     $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

     $sql = 'SELECT code,name,price,gazou FROM cafe_product WHERE 1';
     $stmt = $dbh->prepare($sql);
     $stmt->execute();

     $dbh = null;

   } catch(Exception $e) {
     print 'ただいま障害によりご迷惑をおかけしています。';
     exit();
   }
 ?>



<div class="menu-content">
  <a href="shop_cartlook.php" class="btn btn-danger ml-3 mt-4"><i class="fas fa-cart-plus"></i> カートを見る(<?php print $max; ?>)</a>
  <div class="grid">
    <?php while(true): ?>
      <?php $rec=$stmt->fetch(PDO::FETCH_ASSOC); ?>


      <?php if($rec===false): ?>
        <?php break; ?>
      <?php endif; ?>
    <div class="item">
      <img src="../product/gazou/<?php print $rec['gazou']; ?>">
      <p class="menu-name"><a href="shop_product.php?procode=<?php print $rec['code']; ?>"><?php print $rec['name'].'__'.$rec['price'].'円'; ?></a></p>
    </div>
    <?php endwhile; ?>
  </div>

</div>

<footer>
  <p class="copyright">©︎ 2020 IMAGINARY CAFE</p>
</footer>
</div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
