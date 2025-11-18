<!-- สำหรับ เข้าสู่ระบบ -->
<div class="modal fade modal-hide" id="login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="bi bi-box-arrow-in-right me-2"></i> เข้าสู่ระบบ
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="message p-2"></div>
            <div class="modal-body p-4">
                <form method="POST" action="controllers/check_users.php" class="form-ajax">

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
                        <a href="#" class="text-decoration-none small">ลืมรหัสผ่าน?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i> เข้าสู่ระบบ
                    </button>

                </form>
            </div>
            <div class="modal-footer text-center">
                <p class="w-100 mb-0">ยังไม่มีบัญชี?
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">สมัครสมาชิก</a>
                </p>
            </div>
        </div>
    </div>
</div>