<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include_once 'widget/navbar.php'; ?>
    <?php include_once 'check_data.php'; ?>


<!-- Profile Page -->
<div class="container py-5">
  <div class="row">
    <!-- Profile Sidebar -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <!-- Profile Picture -->
          <img src="../image/user/<?=$users['image'] ?? 'avata.jpg'?>" alt="Profile"
               class="rounded-circle mb-3" width="120" height="120">
          <h4 class="fw-bold mb-0"><?=$users['fname'];?> <?=$users['lname'];?></h4>
          <p class="text-muted"><?=$users['email'];?></p>

          <!-- Edit Profile Button -->
          <button class="btn btn-outline-primary btn-sm btn-modal"  data-modal="edit_users" data-controllers="../controllers/users/get_users.php" data-id="<?=$users['user_id']?>">
            แก้ไขข้อมูล
          </button>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <div class="list-group mt-4">
        <a href="playlist.php" class="list-group-item list-group-item-action">
          <i class="bi bi-collection-play me-2"></i> จัดการเพลย์ลิสต์
        </a>
        <a href="#" class="list-group-item list-group-item-action btn-modal" data-modal="reports">
          <i class="bi bi-bar-chart-line me-2"></i> รายงานปัญหา
        </a>
        <a href="logout.php?logout=logout" class="list-group-item list-group-item-action">
          <i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ
        </a>
      </div>
    </div>

    <?php
    $sql="SELECT sum(v.vie_view) as views,count(DISTINCT  l.list_id) as list,count(DISTINCT v.vie_id) as video,u.user_id,v.vie_id,l.list_id FROM tb_users as u LEFT JOIN tb_videos as v on u.user_id = v.user_id LEFT JOIN tb_lists as l on v.list_id=l.list_id WHERE u.user_id=:user_id GROUP BY u.user_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":user_id",$users['user_id']);
    $stmt->execute();
    $profile=$stmt->fetch(PDO::FETCH_ASSOC);
    
    ?>
    <!-- Profile Content -->
    <div class="col-md-8">
      <!-- Channel Stats -->
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3">สถิติช่องของฉัน</h5>
          <div class="row text-center">
            <div class="col-4">
              <h4 class="fw-bold"><?=$profile['views'] ?? "0";?></h4>
              <p class="text-muted small">ยอดวิวรวม</p>
            </div>
            <div class="col-4">
              <h4 class="fw-bold"><?=$profile['video'];?></h4>
              <p class="text-muted small">วิดีโอทั้งหมด</p>
            </div>
            <div class="col-4">
              <h4 class="fw-bold"><?=$profile['list'];?></h4>
              <p class="text-muted small">เพลย์ลิสต์</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Uploaded Videos -->
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="fw-bold mb-3">วิดีโอล่าสุด</h5>
          <div class="row g-3">
            <?php
              $sql="SELECT * FROM tb_videos WHERE user_id=:user_id ORDER BY vie_date DESC LIMIT 3";
              $stmt=$db->prepare($sql);
              $stmt->bindParam(":user_id",$users['user_id']);
              $stmt->execute();
              $info=$stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($info as $row) :?>
            <div class="col-md-6">
              <div class="ratio ratio-16x9 mb-2">
                <img src="../image/poster/<?=$row['vie_poster']?>" alt="">
              </div>
              <h6 class="mb-0"><?=$row['vie_title']?></h6>
              <p class="text-muted small"><?=$row['vie_view'] ?? 0 ?> วิว • <?=$row['vie_date']?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
