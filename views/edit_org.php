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
                <h3 class="text-primary">ตารางการจัดการองค์กร</h3>
            </div>
            <div class="col-lg-6 text-end">
                <button data-modal="register" class="btn btn-primary btn-modal">เพื่มข้อมูลองค์กร</button>
            </div>
        </div>
        <hr>

        <table id="edit_org" class="table mb-0">
            <thead>
            <tr>
                <th class="text-center">ชื่อองค์กร</th>
                <th class="text-center">ที่อยู่</th>
                <th class="text-center">ตำบล</th>
                <th class="text-center">เบอร์โทรศัพท์</th>
                <th class="text-center">จัดการ</th>
            </tr>
            </thead>
            <tbody id="results">

            <?php

            $sql = "SELECT * FROM tb_organizations";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <?php foreach ($rows as $row) : ?>
                <tr class="text-center">
                    <td><?= $row['org_name'] ?></td>
                    <td><?= $row['org_address'] ?></td>
                    <td><?= $row['org_sub'] ?></td>
                    <td><?= $row['org_phone'] ?></td>
                    <td>
                        <div class="btn-group">
                            <button data-modal="edit_orgs" data-controllers="../controllers/orgs/get_orgs.php" data-id="<?= $row['org_id'] ?>"
                                    class="btn-modal btn btn-sm btn-warning me-2">แก้ไขข้อมูล
                            </button>
                            <button data-controllers="../controllers/orgs/delete_orgs.php" data-id="<?= $row['org_id'] ?> " class="btn btn-sm btn-danger me-2 btn-delete">ลบข้อมูล</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
