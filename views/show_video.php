<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php include_once 'widget/navbar-old.php'; ?>
    <?php include_once 'check_data.php'; ?>

  <?php
  $vie_id = $_GET['vie_id'] ?? null;
  if(isset($vie_id)){
  $sql="SELECT * FROM tb_videos as v LEFT JOIN tb_users as u on v.user_id=u.user_id WHERE v.vie_id=:vie_id";
  $stmt=$db->prepare($sql);
  $stmt->bindParam(":vie_id",$vie_id);
  $stmt->execute();
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  $views=$row['vie_view'];
  $up_views=++$views ;
  $sql="UPDATE tb_videos SET vie_view=:vie_view WHERE vie_id=:vie_id";
  $stmt=$db->prepare($sql);
  $stmt->bindParam(":vie_id",$vie_id);
  $stmt->bindParam(":vie_view",$up_views);
  $stmt->execute();
}
  ?>
  <!-- Video Player Page -->
  <div class="container py-5">
    <div class="row">
      <!-- Main Video -->
        <div class="ratio ratio-16x9 mb-3">
          <video controls>
            <source src="../image/video/<?=$row['vie_file']?>" name="mainvideo" type="video/mp4">
          </video>
        </div>
        <h4 class="fw-bold mb-1" ><?=$row['vie_title']?></h4><br>
        <h6>โดย <?=$row['fname']?> <?=$row['lname']?></h6>
        <p class="text-muted small mb-2"> • <?=$row['vie_view'] ?? 0 ?> วิว • <?=$row['vie_date']?></p>
        <p class="mb-4"><?=$row['vie_detail']?></p>

        <!-- Comment Section -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body">
            <h5 class="fw-bold mb-3">ความคิดเห็น</h5>
            <!-- Comment Form -->
            <form class="mb-3 form-ajax" action="../controllers/comments/save_comments.php" method="POST">
              <input type="hidden" value="<?=$vie_id?>" name="vie_id">
              <textarea class="form-control mb-2" rows="3" placeholder="แสดงความคิดเห็น..." name="com_content" required></textarea>
              <input type="submit" class="btn btn-primary btn-sm" value="ส่งความคิดเห็น"></input>
            </form>
            <?php
            $sql="SELECT * FROM tb_comments as c LEFT JOIN tb_users as u on c.user_id=u.user_id WHERE c.vie_id =:vie_id";
            $stmt=$db->prepare($sql);
            $stmt->bindParam(":vie_id",$vie_id);
            $stmt->execute();
            $comment=$stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($comment as $row): ?>
            <!-- Comments List -->
            <div class="mb-3">
              <img src="../image/user/<?=$row['image'] ?? 'avata.jpg' ?>" width="65px" height="65px" class="rounded-circle border image-css" alt="">
              <strong><?=$row['fname']?> <?=$row['lname']?></strong>
              <p class="mb-1"><?=$row['com_content']?></p>
              <span class="text-muted small"><?=$row['com_date']?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
    
      
      
    </div>
  </div>

</body>

</html>