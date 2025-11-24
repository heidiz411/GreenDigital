<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/users/save_users.php" : "../controllers/users/save_users.php";
?>
<form id="edit_user" method="POST" action="<?= $action ?>" enctype="multipart/form-data" class="form-ajax">
    <input type="hidden" name="user_id">
    <div class="mb-3">
        <label for="regEmail" class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" id="regEmail" class="form-control" placeholder="example@email.com" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" minlength="8" required>
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

    <div class="mb-3">
        <label for="role" class="form-label">ประเภทผู้ใช้</label>
        <select class="form-select" id="role" name="role" required>
            <option value="ประชาชน" selected>ประชาชน</option>
            <option value="รัฐบาล">รัฐบาล</option>
            <option value="แอดมิน">แอดมิน</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-person-plus me-1"></i> บันทึก
    </button>
</form>