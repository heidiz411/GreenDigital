
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Green Digital - หน้าแรก</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include_once 'widget/navbar.php'; ?>
    <?php include_once 'check_data.php'; ?>

<!-- เพลย์ลิสต์ -->
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold mb-4">เพลย์ลิสต์ที่น่าสนใจ</h3>
    <div class="row g-4">
      <?php
              $sql="SELECT 
    SUM(v.vie_view) AS views,
    l.list_title,
    l.list_image,
    l.list_id,
    u.fname,
    u.lname
    FROM tb_lists AS l LEFT JOIN tb_videos AS v ON l.list_id = v.list_id LEFT JOIN tb_users AS u ON l.user_id = u.user_id GROUP BY l.list_id, l.list_title, u.fname, u.lname ORDER BY views DESC LIMIT 3;";
              $stmt=$db->prepare($sql);
              $stmt->execute();
              $info=$stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($info as $row) : ?>
      <!-- Playlist Card -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <a href="list_video.php?list_id=<?=$row['list_id']?>" class="text-decoration-none">
          <div class="ratio ratio-16x9">
          <img src="../image/list/<?=$row['list_image']?>" alt="" class="img-fluid">
        </div>
          <div class="card-body">
            <h5 class="card-title"><?=$row['list_title']?></h5>
            <p class="text-muted mb-1"><i class="bi bi-person-circle me-1"></i><?=$row['fname']?> <?=$row['lname']?></p>
            <p class="text-muted mb-1"><i class="bi bi-eye me-1"></i>เข้าชม <?=$row['views']?> ครั้ง</p>
            <p class="text-muted"><i class="bi bi-star-fill text-warning me-1"></i>คะแนน 4.8/5</p>
          </div>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
     
    </div>
  </div>
</section>

<!-- วิดีโอมาแรง -->
<section class="py-5 bg-light border-top">
  <div class="container">
    <h3 class="fw-bold mb-4">วิดีโอมาแรง</h3>
    <div class="row g-4">
      <?php
              $sql="SELECT * FROM tb_videos as v LEFT JOIN tb_users as u on v.user_id=u.user_id ORDER BY v.vie_view DESC LIMIT 3";
              $stmt=$db->prepare($sql);
              $stmt->execute();
              $info=$stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($info as $row) : ?>
      <!-- Video Card -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="ratio ratio-16x9">
            <img src="../image/poster/<?=$row['vie_poster']?>" alt="" class="img-fluid">
          </div>
          <a href="show_video.php?vie_id=<?=$row['vie_id']?>"  class="text-decoration-none">
          <div class="card-body">
            <h6 class="card-title"><?=$row['vie_title']?></h6>
            <p class="text-muted mb-1"><i class="bi bi-person-circle me-1"></i><?=$row['fname']?> <?=$row['lname']?></p>
            <p class="text-muted mb-1"><i class="bi bi-eye me-1"></i><?=$row['vie_view']?> วิว</p>
            <p class="text-muted"><i class="bi bi-calendar me-1"></i>อัปโหลด <?=$row['vie_date']?></p>
          </div>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
      
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="py-4 bg-light border-top text-center">
  <div class="container">
    <div class="small text-muted">© <span id="year"></span> Green Digital</div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById("year").innerText = new Date().getFullYear();
</script>
</body>
</html>
```
