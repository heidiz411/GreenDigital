<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Green Digital - หน้าแรก</title>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-body">

<!-- Navbar -->
<?php

session_start();
if (!empty($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    header('location: views/home.php');
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="bi bi-lightbulb-fill me-2"></i>
            <span class="fw-bold">Green Digital</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#features">คุณสมบัติ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">เกี่ยวกับ</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="#">ติดต่อ</a>
                </li>
            </ul>

            <div class="d-flex ms-lg-3">
                <button class="btn btn-outline-light me-2 btn-modal" data-modal="login">เข้าสู่ระบบ</button>
                <button class="btn btn-light text-primary btn-modal" data-modal="register">สมัครสมาชิก</button>
            </div>
        </div>


    </div>
</nav>

<!-- Hero -->
<header class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="display-5 fw-bold">เพิ่มความรู้ด้วย Green Digital</h1>
                <p class="lead text-muted">infomation technology major</p>

                <div class="mt-4">
                    <a class="btn btn-primary btn-lg me-2" href="#features">เริ่มต้นใช้งาน</a>
                    <button class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#registerModal">ลงทะเบียนฟรี</button>
                </div>

                <div class="mt-4 small text-muted">ใช้งานได้บนมือถือ แท็บเล็ต และเดสก์ท็อป</div>
            </div>

            <div class="col-md-5 d-none d-md-block">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">ฟีเจอร์เด่นของเรา</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> ระบบล็อกอิน</li>
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> โพสวิดีโอ</li>
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> สร้างเพลลิสย์</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- Features -->
<section id="features" class="py-5">
    <div class="container">
        <h2 class="h3 fw-bold mb-4 text-center"> Green Digital</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-laptop fs-2 text-primary me-3"></i>
                            <h5 class="card-title mb-0">เรียนรู้ได้ในชุดเดียว</h5>
                        </div>
                        <p class="card-text text-muted">จัดทำโดย วิทยาลัยการอาชีพโพนทอง</p>
                        <a href="#" class="stretched-link">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-journal-bookmark fs-2 text-primary me-3"></i>
                            <h5 class="card-title mb-0">แลกเปลี่ยนความคิดเห็น</h5>
                        </div>
                        <p class="card-text text-muted">จัดทำโดย วิทยาลัยการอาชีพโพนทอง</p>
                        <a href="#" class="stretched-link">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-people fs-2 text-primary me-3"></i>
                            <h5 class="card-title mb-0">เพิ่มความรู้ตามที่ต้องการ</h5>
                        </div>
                        <p class="card-text text-muted">จัดทำโดย วิทยาลัยการอาชีพโพนทอง</p>
                        <a href="#" class="stretched-link">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section id="about" class="py-5 bg-white border-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="fw-bold">เป้าหมายในการสร้างเว็บไซต์</h3>
                <p class="text-muted">เพื่อให้ได้เรียนรู้อย่างต่อเนื่องและตรงประเด็น</p>
                <ul>
                    <li>เรียนอย่างเป็นระบบ</li>
                    <li>มีแอดมินจัดการหลังบ้าน</li>
                    <li>คุยกันอย่างเป็นมิตร</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <?php
                include_once 'config/Database.php';
                $data = new Database();
                $db = $data->connect();
                $sql = "SELECT * FROM tb_videos ORDER BY vie_view DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $vie = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="ratio ratio-16x9">
                    <img src="image/poster/<?= $vie['vie_poster'] ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h4 class="fw-bold mb-3">สร้างขึ้นโดย</h4>
        <p class="mb-4">วิทยาลัยการอาชีพโพนทอง</p>
        <div>
            <button class="btn btn-light btn-lg text-primary me-2">สมัครสมาชิก</button>
            <button class="btn btn-outline-light btn-lg">เข้าสู่ระบบ</button>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-4 bg-light border-top">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="text-muted small">© <span id="year"></span> Green Digital</div>
        <div>
            <a href="#" class="text-decoration-none me-3">นโยบายความเป็นส่วนตัว</a>
            <a href="#" class="text-decoration-none">ติดต่อเรา</a>
        </div>
    </div>
</footer>


<!-- Register Modal -->


<!-- Bootstrap JS -->
<?php include_once 'views/widget/modal.php'; ?>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/action.js"></script>

</body>
</html>
