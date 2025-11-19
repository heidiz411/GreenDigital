<?php
if (empty($_SESSION['user_id'])) {
    header('location: index.php');
} else {
    include 'config/Database.php';
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
<section class="py-5 border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-primary">ตารางการจัดการสมาชิก</h3>
            </div>
            <div class="col-lg-6 text-end">
                <button data-modal="register" class="btn btn-primary btn-modal">เพื่มข้อมูลสมาชิก</button>
            </div>
        </div>
        <hr>

        <table id="edit_user" class="table table-bordered mb-0">
            <thead class="text-center pop-up-table">
            <tr>
                <th>รูปโปรไฟล์</th>
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมลล์</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
            </thead>
            <tbody class="text-center" id="results">

            <?php

            if (!empty($_POST['search'])) {
                $search = '%' . $_POST['search'] . '%' ?? null;
                $column = $_POST['column'] ?? null;
                $sql = "SELECT * FROM tb_users WHERE $column LIKE '$search' ";
            } else {
                $sql = "SELECT * FROM tb_users";
            }
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <?php foreach ($users as $row) : ?>
                <tr class="pop-up-table">
                    <td><img src="../image/user/<?= $row['image'] ?? '' ?>" width="65px" height="65px" class="rounded-circle border image-css" alt=""></td>
                    <td><?= $row['full_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
                        <div class="btn-group">
                            <button data-modal="edit_users" data-controllers="../controllers/users/get_users.php" data-id="<?= $row['user_id'] ?>"
                                    class="btn-modal btn btn-sm btn-warning pop-up me-2">แก้ไขข้อมูล
                            </button>
                            <button data-controllers="../controllers/users/delete_users.php" data-id="<?= $row['user_id'] ?> " class="btn btn-sm btn-danger pop-up me-2 btn-delete">ลบข้อมูล
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
