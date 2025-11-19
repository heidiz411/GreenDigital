<?php

session_start();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="home.php">
      <i class="bi bi-lightbulb-fill me-2"></i>
      <span class="fw-bold">Green Digital</span>
    </a>
    
      <?php
      
        include_once '../config/Database.php';
          $data = new Database();
          $db = $data->connect();
          $user_id = $_SESSION['user_id'];
          $sql = "SELECT * FROM tb_users WHERE user_id=:user_id";
          $stmt = $db->prepare($sql);
          $stmt->bindParam(":user_id", $user_id);
          $stmt->execute();
          $users = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
      <?php include_once '../views/widget/modal.php'; ?>
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <script src="../assets/js/jquery-3.7.1.min.js"></script>
      <script src="../assets/js/action.js"></script>
      <script src="../assets/js/bootstrap.bundle.min.js"></script>
      <form class="d-flex ms-auto" action="search_playlist.php" method="POST">
        <input class="form-control me-2" name="search" type="search" placeholder="ค้นหาคลิป..." aria-label="Search">
        <button class="btn btn-success" type="submit">ค้นหา</button>
      </form>
      <div class="ms-3">
        <a href="profile.php">
          <img src="../image/user/<?= $users['image'] ?? 'avata.jpg' ?>" class="rounded-circle me-2" width="40px" height="40px" alt="User">
          <span class="fw-semibold text-light "><?= $users['fname'] ?> <?= $users['lname'] ?></span>
        </a>
      </div>
   

  </div>
</nav>