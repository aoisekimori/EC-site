<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false) {
  print 'ログインされていません。<br />';
  print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
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
        <li><a href="../staff_login_branch.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="staff-wrapper">
  <h2 class="title staff-title">ショップ管理画面トップメニュー</h2>
  <p><?php print $_SESSION['staff_name']; ?>さんがログイン中</p>
  <a href="../staff/staff_list.php" class="btn btn-primary mt-3">スタッフ管理画面へ</a>
  <a href="../product/pro_list.php" class="btn btn-primary mt-3 ml-3">商品管理画面へ</a><br />
  <a href="staff_logout.php" class="btn btn-danger mt-5">ログアウト</a>
</div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
