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

<!-- All Videos Page -->
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">เพลย์ลิสต์ทั้งหมดของฉัน</h3>
      <button class="btn btn-outline-primary btn-modal" data-modal="lists" type="submit">เพิ่มเพลลิสย์</button>
  </div>

  <!-- Videos Grid -->
  <div class="row g-4">
    <!-- Video Card -->
     <?php
     $sql="SELECT * FROM tb_users as u RIGHT JOIN tb_lists as l on u.user_id = l.user_id WHERE u.user_id=:user_id";
     $stmt=$db->prepare($sql);
     $stmt->bindParam(":user_id",$users['user_id']);
     $stmt->execute();
     $list=$stmt->fetchAll(PDO::FETCH_ASSOC);
     if($list):
        foreach($list as $row):
     ?>
     
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <a href="list_video.php?list_id=<?=$row['list_id']?>"  class="text-decoration-none">
        <div class="ratio ratio-16x9">
          <img src="../image/list/<?=$row['list_image']?>" alt="" class="img-fluid">
        </div>
        <div class="card-body">
          <h6 class="card-title"><?=$row['list_title']?></h6>
          <p class="text-muted small mb-1"><?=$row['list_date']?></p>
          <p class="text-muted small">โดย: <?=$row['fname']?> <?=$row['lname']?> </p>
          </a>
          <button class="text-center btn btn-warning btn-modal" data-modal="edit_lists" data-id="<?=$row['list_id']?>" data-controllers="../controllers/lists/get_lists.php">แก้ไขลิสย์</button>
        </div>
      </div>
    </div>
    
    <?php endforeach; ?>
    <?php else: ?>
        <hr>
        <h1 class="text-center text-danger mt-2"><b>ไม่มีลิสย์</b></h1>
        <?php endif; ?>
    

    <!-- สามารถเพิ่ม card เพิ่มเติมตามจำนวนวิดีโอ -->
  </div>
  <!-- <nav aria-label="Video pagination" class="mt-4">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled"><a class="page-link" href="#">ก่อนหน้า</a></li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">ถัดไป</a></li>
    </ul>
  </nav> -->
</div>


</body>
</html>