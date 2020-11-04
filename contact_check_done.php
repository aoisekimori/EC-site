<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHPポートフォリオ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrap">
  <div class="contact-header">
  <div class="header">
    <h1 class="title">IMAGINARY<br />CAFE</h1>
    <nav>
      <ul class="header-menu">
        <li><a href="top.html">TOP</a></li>
        <li><a href="shop/menu.php">MENU</a></li>
        <li><a href="contact.html">CONTACT</a></li>
        <li><a href="staff_login/staff_login.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <?php
    $name=$_POST['name'];
    $email=$_POST['email'];
    $content=$_POST['content'];
   ?>

  <div class="header-title pl-3">
    <h2 class="title contact-title">送信完了</h2>
    <p class="ml-4">送信が完了しました。</p>
    <a href="top.html" class="btn btn-success ml-4">TOPへ</a>
</div>
<footer>
  <p class="copyright">©︎ 2020 IMAGINARY CAFE</p>
</footer>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
