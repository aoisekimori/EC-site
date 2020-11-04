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
        <li><a href="staff_login_branch.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="staff-wrapper">
  <h2 class="title staff-title">確認</h2>
  <?php

   require_once('../common/common.php');
   $post=sanitize($_POST);
    $staff_name=$post['name'];
    $staff_pass=$post['pass'];
    $staff_pass2=$post['pass2'];

   ?>
   <?php if($staff_name==''): ?>
     <p>スタッフ名が入力されていません。</p>
   <?php else: ?>
     <p>スタッフ名:<?php echo $staff_name; ?></p>
   <?php endif; ?>

   <?php if($staff_pass==''): ?>
     <p>パスワードが入力されていません。</p>
   <?php endif; ?>

   <?php if($staff_pass!=$staff_pass2): ?>
     <p>パスワードが一致しません。</p>
   <?php endif; ?>

   <?php if($staff_name=='' || $staff_pass=='' || $staff_pass != $staff_pass2): ?>
     <form>
       <input type="button" onclick="history.back()" value="戻る" class="btn btn-success">
     </form>
   <?php else: ?>
     <form method="post" action="staff_add_done.php">
        <?php $staff_pass=md5($staff_pass); ?>
       <?php print '<input type="hidden" name="name" value="'.$staff_name.'">'; ?>
       <?php print '<input type="hidden" name="pass" value="'.$staff_pass.'">'; ?>
       <input type="button" onclick="history.back()" value="戻る" class="btn btn-success">
       <input type="submit" value="OK" class="btn btn-success">
     </form>
  <?php endif; ?>

 </div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
