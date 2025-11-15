
<div class="panel panel-default"><div class="panel-heading">ลืมรหัสผ่าน</div><div class="panel-body">
  <form id="forgotForm">
    <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
    <div class="form-group"><label>อีเมล</label><input type="email" name="email" class="form-control" required></div>
    <div class="form-group"><label>คำตอบ (คำถามความปลอดภัย)</label><input type="text" name="answer" class="form-control" required></div>
    <button class="btn btn-info">ยืนยัน</button>
  </form>
  <hr>
  <div id="resetSection" style="display:none;">
    <form id="resetForm">
      <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
      <input type="hidden" id="resetUserId" name="user_id">
      <div class="form-group"><label>รหัสผ่านใหม่</label><input type="password" name="new_password" class="form-control" required></div>
      <button class="btn btn-success">ตั้งรหัสผ่านใหม่</button>
    </form>
  </div>
</div></div>
