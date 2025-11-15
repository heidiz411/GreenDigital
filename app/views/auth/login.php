<form id="loginForm" class="form-horizontal" style="max-width:400px;margin:auto;">
  <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
  <div class="form-group"><label>อีเมล</label><input type="email" name="email" class="form-control" required></div>
  <div class="form-group"><label>รหัสผ่าน</label><input type="password" name="password" class="form-control" required></div>
  <button class="btn btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
  <p class="text-center" style="margin-top:10px"><a href="?r=/forgot">ลืมรหัสผ่าน?</a> | <a href="?r=/register">สมัครสมาชิก</a></p>
</form>