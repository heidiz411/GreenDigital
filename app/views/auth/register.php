<form id="registerForm" style="max-width:500px;margin:auto;">
    <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
    <div class="form-group"><label>ชื่อ-นามสกุล</label><input type="text" name="full_name" class="form-control" required></div>
    <div class="form-group"><label>อีเมล</label><input type="email" name="email" class="form-control" required></div>
    <div class="form-group"><label>รหัสผ่าน</label><input type="password" name="password" class="form-control" required></div>
    <div class="form-group"><label>ยืนยันรหัสผ่าน</label><input type="password" name="password_confirm" class="form-control" required></div>
    <button class="btn btn-success">สมัครสมาชิก</button>
</form>