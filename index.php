<?php
session_start();
include_once 'config/Database.php';
$database = new Database();
$db = $database->connect();
header('Content-Type: text/html; charset=utf-8');
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Green Digital</title>

    <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/datatables/datatables.min.css" rel="stylesheet">
</head>
<body class="bg-body">

<!-- Navbar -->
<?php
if (!empty($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    header('location: views/index.php');
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="bi bi-lightbulb-fill me-2"></i>
            <span class="fw-bold">Green Digital</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <?php
            if (!empty($_SESSION['role']) && $_SESSION['role'] == 'แอดมิน') {
                include_once 'views/menu/menu_admin.php';
            } elseif (!empty($_SESSION['role']) && $_SESSION['role'] == 'ประชาชน') {
                include_once 'views/menu/menu_peo.php';
            } elseif (!empty($_SESSION['role']) && $_SESSION['role'] == 'รัฐบาล') {
                include_once 'views/menu/menu_org.php';
            } else {
                include_once 'views/widget/navbar.php';
            }
            ?>
        </div>
    </div>
</nav>

<?php
if (!empty($_GET['page'])) {
    switch ($_GET['page']) {
        case 'edit_org':
            include_once 'views/edit_org.php';
            break;
        case 'edit_user':
            include_once 'views/edit_user.php';
            break;
        case 'edit_waste_type':
            include_once 'views/edit_waste_type.php';
            break;
        case 'edit_waste_rec':
            include_once 'views/edit_waste_rec.php';
            break;
        case 'edit_wallet':
            include_once 'views/edit_wallet.php';
            break;
        case 'edit_content':
            include_once 'views/edit_content.php';
            break;
        default:
            include_once 'views/home.php';
    }
} else {
    include_once 'views/home.php';
}
?>

<!-- Footer -->
<footer class="py-4 bg-success border-top">
    <div class="container">
        <small class="text-white">© <span id="year"><?= date('Y') ?></span>. Green Digital PTICEC.</small>
    </div>
</footer>

<!-- Bootstrap JS -->
<?php include_once 'views/modal/modal.php'; ?>
<script src="assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/jquery/jquery-3.7.1.min.js"></script>
<script src="assets/plugins/datatables/datatables.min.js"></script>
<script src="assets/plugins/chartjs/chartjs.min.js"></script>
<script src="assets/js/action.js"></script>

<?php $table_id = $_GET['page'] ?? 'home'; ?>

<script>
    $(document).ready(function () {
        $('table[id="<?= $table_id ?>"]').DataTable({
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "ไม่พบข้อมูล",
                "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "search": "ค้นหา:",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                }
            }
        });
    });
</script>
</body>
</html>
