<div class="d-flex">
    <?php include_once 'widget/layout_admin.php'; ?>
    <div class="flex-grow-1">
        <div class="container-sm mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="1">
                    <h2 class="text-primary">ตารางการจัดการสมาชิก</h2>
                </div>
                <div class="1">
                    <button data-modal="register" class="btn btn-primary btn-modal rounded-pill fw-bold">เพื่มข้อมูลสมาชิก</button>
                </div>
            </div>
            <hr>

            <!-- form search start -->
            <form action="edit_users.php" class=" mt-3" method="POST" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <select name="column" id="" class="form-select" placehoder="search">
                        <option value="full_name">ชื่อ-นามสกุล</option>
                        <option value="email">อีเมลล์</option>
                    </select>
                    <label class="form-label">ค้นหาตาม</label>

                    <div class="input-group mt-3">
                        <input type="search" name="search" class="form-control" placeholder="ค้นหาข้อมูล">
                        <button type="submit" class="btn btn-primary">ค้นหาข้อมูล</button>
                    </div>
                </div>
            </form>
            <!-- form search end -->

            <table class="table table-bordered table-striped table-hover align-middle mb-0">
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
    </div>
</div>