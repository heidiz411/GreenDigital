<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/check_users.php" : "../controllers/check_users.php";
?>
<form id="edit_user" method="POST" action="<?= $action ?>" enctype="multipart/form-data" class="form-ajax">
    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">อีเมล</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
        </div>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">รหัสผ่าน</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
        </div>
    </div>

    <!-- Remember + Forgot -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember">
                จำฉันไว้
            </label>
        </div>
        <a href="javascript:;" class="text-decoration-none small btn-modal"
         data-title="ลืมรหัสผ่าน" data-view="views/modal/forgot.php">ลืมรหัสผ่าน?</a>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-box-arrow-in-right me-1"></i> เข้าสู่ระบบ
    </button>
</form>
<div class="modal-footer text-center">
    <p class="w-100 mb-0">ยังไม่มีบัญชี?
        <a href="javascript:;" class="btn-modal" data-title="สมัครสมาชิก"
        data-view="views/modal/user.php">สมัครสมาชิก</a>
    </p>
</div>