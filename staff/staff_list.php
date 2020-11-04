<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false) {
  print 'ログインされていません。<br />';
  print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
  exit();
}
?>
<?php
   try {

     $dbn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
     $user='root';
     $password='root';
     $dbh = new PDO($dbn,$user,$password);
     $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

     $sql = 'SELECT name FROM cafe_staff WHERE 1';
     $stmt = $dbh->prepare($sql);
     $stmt->execute();

     $dbh = null;



   } catch(Exception $e) {
     print 'ただいま障害によりご迷惑をおかけしています。';
     exit();
   }
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHPポートフォリオ</title>
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
        <li><a href="../shop/menu.php">MENU</a></li>
        <li><a href="../contact.html">CONTACT</a></li>
        <li><a href="staff_login_branch.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="staff-wrapper">
  <h2 class="title staff-title">スタッフ一覧</h2>
  <?php
     try {

       $dbn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
       $user='root';
       $password='root';
       $dbh = new PDO($dbn,$user,$password);
       $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

       $sql = 'SELECT name,code FROM cafe_staff WHERE 1';
       $stmt = $dbh->prepare($sql);
       $stmt->execute();

       $dbh = null;

     } catch(Exception $e) {
       print 'ただいま障害によりご迷惑をおかけしています。';
       exit();
     }
   ?>

   <?php while(true): ?>
     <?php $rec=$stmt->fetch(PDO::FETCH_ASSOC); ?>


     <?php if($rec===false): ?>
       <?php break; ?>
     <?php endif; ?>

     <?php print '<form method="post" action="staff_branch.php">' ?>
       <ul>
        <?php print '<input type="radio" name="staffcode" value="'.$rec['code'].'" class="form-check-input">'; ?>
         <li style="display:inline"><?php echo $rec['name']; ?></li>
       </ul>
  <?php endwhile; ?>
  <?php print '<input type="submit" name="disp" value="詳細" class="btn btn-success">'; ?>
  <?php print '<input type="submit" name="add" value="追加" class="btn btn-success">'; ?>
     <?php print '<input type="submit" name="edit" value="修正" class="btn btn-success">'; ?>
     <?php print '<input type="submit" name="delete" value="削除" class="btn btn-success">'; ?>
     <?php print '</form>'; ?>

    <a href="../staff_login/staff_top.php" class="btn btn-primary mt-3">トップメニューへ</a>









 </div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
