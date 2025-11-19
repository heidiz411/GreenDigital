<?php
$list_id = $_GET['list_id'] ?? null;
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

    <!-- Video Player Page -->

    <div class="container py-5">
        <div class="row">
            <?php
            $sql = "SELECT SUM(v.vie_view) AS vie_views,
                        COUNT(DISTINCT v.vie_id) AS vie_file,
                        COUNT(c.com_id) AS comments,
                        v.user_id
                        FROM tb_videos AS v
                        LEFT JOIN tb_comments AS c ON v.vie_id = c.vie_id
                        WHERE v.list_id =:list_id ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":list_id", $list_id);
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <?php
            $sql="SELECT * FROM tb_lists WHERE list_id=:list_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":list_id", $list_id);
            $stmt->execute();
            $list = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <!-- Main Video -->
            <?php if ($list['user_id'] == $user_id) : ?>
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">สถิติช่องของฉัน</h5>
                            <div class="row text-center">
                                <div class="col-6">
                                    <h4 class="fw-bold"><?= $info['vie_file'] ?? 0 ?></h4>
                                    <p class="text-muted small">วิดีโอทั้งหมด</p>
                                </div>
                                <div class="col-6">
                                    <h4 class="fw-bold"><?= $info['comments'] ?? 0 ?></h4>
                                    <p class="text-muted small">คอมเมนท์ทั้งหมด</p>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary btn-modal mt-2 mb-2" data-modal="videos">เพิ่มวิดีโอ</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Sidebar Playlist -->

        </div>
        <div class="row">

            <div class="col-lg-12">
                <h6 class="fw-bold mb-3">วิดีโอในเพลย์ลิสต์นี้ </h6>
                <?php
                $sql = "SELECT * FROM tb_videos WHERE list_id=:list_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":list_id", $list_id);
                $stmt->execute();
                $vie = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($vie as $row) :
                ?>
                    <div class="col-lg-12 mb-3 pop-up">
                        <div class="card card-css shadow-sm rounded-0">
                            <div class="box1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="show_video.php?vie_id=<?= $row['vie_id'] ?>" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <img src="../image/poster/<?= $row['vie_poster'] ?>" width="140px" class="image-css" height="95px" alt="">
                                            <small class="fw-bold ms-2" style="font-size:18px;"><?= $row['vie_title'] ?><br>
                                                <small class="text-success">ยอดเข้าชม <?= $row['vie_view'] ?? 0 ?> ครั้ง <br>
                                                    <small class="text-secondary"><?= $row['vie_date'] ?></small><br>

                                                </small>
                                            </small>
                                    
                                </div>
                                </a>
                                <div class="2">
                                    <div class="btn-group p-2">
                                        <?php if ($info['user_id'] == $user_id) : ?>
                                            <button class="text-center btn btn-warning btn-modal ms-auto" data-modal="edit_videos" data-id="<?= $row['vie_id'] ?>" data-controllers="../controllers/videos/get_videos.php">แก้ไขวิดีโอ</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>

    </div>

</body>

</html>