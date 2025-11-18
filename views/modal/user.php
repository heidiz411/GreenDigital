<!-- สำหรับ สมัครสมาชิก -->
<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/users/save_users.php" : "../controllers/users/save_users.php";
?>
<div class="modal fade modal-hide" id="user" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="userModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i> <?php isset($user_id) ? 'แก้ไขสมาชิก' : 'สมัครสมาชิก' ?>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="message mt-2 p-2"></div>
            <div class="modal-body p-4">
                <form method="POST" action="<?= $action ?>" enctype="multipart/form-data" class="form-ajax">
                    <input type="hidden" name="user_id">
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="regEmail" class="form-control" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="regPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="regPassword" class="form-control" placeholder="••••••••" minlength="8" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="ชื่อ-นามสกุล" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="ที่อยู่" required>
                    </div>

                    <div class="mb-3">
                        <label for="sub" class="form-label">ตำบล</label>
                        <input type="text" class="form-control" id="sub" name="sub" placeholder="ตำบล" required>
                    </div>

                    <div class="mb-3">
                        <label for="dis" class="form-label">อำเภอ</label>
                        <input type="text" class="form-control" id="dis" name="dis" placeholder="อำเภอ" required>
                    </div>

                    <div class="mb-3">
                        <label for="prov" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="prov" name="prov" placeholder="จังหวัด" required>
                    </div>

                    <div class="mb-3">
                        <label for="zipcode" class="form-label">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="รหัสไปรษณีย์" required>
                    </div>

                    <div class="mb-3">
                        <label for="profileImage" class="form-label">รูปโปรไฟล์</label>
                        <input class="form-control" type="file" id="profileImage" name="image" accept="image/*">
                    </div>

                    <?php if (isset($users)) : ?>
                        <div class="mb-3">
                            <label for="role" class="form-label">ประเภทผู้ใช้</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="ประชาชน" selected>ประชาชน</option>
                                <option value="รัฐบาล">รัฐบาล</option>
                                <option value="แอดมิน">แอดมิน</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-person-plus me-1"></i> บันทึก
                    </button>

                </form>
            </div>
            <div class="modal-footer text-center">
                <p class="w-100 mb-0">มีบัญชีแล้ว?
                    <a href="#">เข้าสู่ระบบ</a>
                </p>
            </div>
        </div>
    </div>
</div>