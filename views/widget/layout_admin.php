<?php

session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../index.php');
} else {
    include '../config/Database.php';
    $data = new Database();
    $db = $data->connect();
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tb_users WHERE user_id=:user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($users['role'] == 'ประชาชน') {
        header('location: logout.php?logout=logout');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/plugins/bootstrap/bootstrap.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

<section style="height: 100vh;" class="sticky-top bg-dark shadow">
    <div class="container py-5 mt-5">
        <div class="text-center">
            <img src="../image/user/<?= $users['image'] ?? '' ?>" width="110px" height="110px" class="rounded-circle image-css border border" alt=""><br>
            <div class="mt-3 pop-up">
                <span class="badge bg-primary rounded-pill shadow"> แอดมิน <?= $users['full_name'] ?? '' ?></span>
            </div>
        </div>
        <div class="text-center mt-3">
            <div class="mb-3">
                <a href="edit_users.php" class="px-4 btn btn-outline-light w-100 rounded-pill fw-bold shadow">จัดการสมาชิก</a>
            </div>
            <div class="mb-3">
                <a href="edit_playlists.php" class="px-4 btn btn-outline-light w-100 rounded-pill fw-bold shadow">จัดการเพลลิส</a>
            </div>
            <div class="mb-3">
                <a href="edit_videos.php" class="px-4 btn btn-outline-light w-100 rounded-pill fw-bold shadow">จัดการคลิปวิดีโอ</a>
            </div>
            <div class="mb-3">
                <a href="edit_comments.php" class="px-4 btn btn-outline-light w-100 rounded-pill fw-bold shadow">จัดการคอมเมนต์</a>
            </div>
            <div class="mb-3">
                <a href="edit_reports.php" class="px-4 btn btn-outline-light w-100 rounded-pill fw-bold shadow">รายงานปัญหา</a>
            </div>
            <div class="mb-3">
                <a href="logout.php?logout=logout" class="px-4 btn btn-outline-light w-100 rounded-pill fw-bold shadow">ออกจากระบบ</a>
            </div>
        </div>
    </div>

</section>

<script src="../assets/plugins/jquery/jquery-3.7.1.min.js"></script>
<script src="../assets/js/action.js"></script>
<script src="../assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>

<?php include_once 'widget/modal.php'; ?>

</body>

</html>