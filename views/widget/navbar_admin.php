<?php

session_start();
if(empty($_SESSION['user_id'])){
  header('location: ../index.php');
}else{
  include '../config/Database.php';
  $data=new Database();
  $db=$data->connect();
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM tb_users WHERE user_id=:user_id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":user_id", $user_id);
  $stmt->execute();
  $users = $stmt->fetch(PDO::FETCH_ASSOC);
  if($users['usertype'] == 'user'){
    header('location: logout.php?logout=logout');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>documen</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="fade-web d-flex flex-column min-vh-100 bg-web">

  <section style="width: 300px; height: 100vh;" class="sticky-top bg-dark shadow">
    <div class="container-sm py-5 mt-5">
      <div class="text-center profile">
        <img src="../image/user/<?= $users['image'] ?>" width="110px" height="110px" class="rounded-circle image-css border border" alt=""><br>
        <div class="mt-3 pop-up">
          <span style="font-size:15px;" class="badge bg-primary rounded-pill shadow"> แอดมิน <?= $users['fname'] ?> <?= $users['lname'] ?></span>
        </div>
      </div>
      <div class="text-center mt-3">
        <div class="mb-3">
          <a href="edit_users.php" class="btn btn-outline-light w-100 rounded-pill pop-up fw-bold shadow">จัดการตารางสมาชิก</a>
        </div>
        <div class="mb-3">
          <a href="edit_playlists.php" class="btn btn-outline-light w-100 rounded-pill pop-up fw-bold shadow">จัดการตารางเพลลิส</a>
        </div>
        <div class="mb-3">
          <a href="edit_videos.php" class="btn btn-outline-light w-100 rounded-pill pop-up fw-bold shadow">จัดการตารางคลิปวิดีโอ</a>
        </div>
        <div class="mb-3">
          <a href="edit_comments.php" class="btn btn-outline-light w-100 rounded-pill pop-up fw-bold shadow">จัดการตารางคอมเมนต์</a>
        </div>
        <div class="mb-3">
          <a href="edit_reports.php" class="btn btn-outline-light w-100 rounded-pill pop-up fw-bold shadow">รายงานปัญหา</a>
        </div>
      </div>
      <a href="logout.php?logout=logout" class="text-decoration-none">
        <div class="position-fixed bottom-0 start-0 bg-danger text-center text-light py-2" style="width:300px;">
        <h4>ออกจากระบบ</h4>
      </div>
      </a>
    </div>

  </section>

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/action.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <?php include_once 'widget/modal.php'; ?>
</body>

</html>