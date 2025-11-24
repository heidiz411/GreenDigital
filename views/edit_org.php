<?php
if (empty($_SESSION['user_id'])) {
    header('location: index.php');
}
?>

<section class="py-5 border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-primary">ตารางการจัดการองค์กร</h3>
            </div>
            <div class="col-lg-6 text-end">
                <button data-modal="edit_org" class="btn btn-primary btn-modal">เพื่มข้อมูลองค์กร</button>
            </div>
        </div>
        <hr>

        <table id="edit_user" class="table mb-0">
            <thead>
            <tr>
                <th class="text-center">รูปโปรไฟล์</th>
                <th class="text-center">ชื่อ-นามสกุล</th>
                <th class="text-center">อีเมลล์</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">จัดการ</th>
            </tr>
            </thead>
            <tbody id="results">

            <?php
            require_once '../models/Users.php';
            $model = new users($db);
            $rows = $model->getUsers();
            ?>
            <?php foreach ($rows as $row) : ?>
                <tr class="text-center">
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
