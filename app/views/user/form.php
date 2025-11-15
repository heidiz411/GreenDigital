<form id="userForm">
  <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
  <input type="hidden" name="user_id" value="">
  <div class="form-group"><label>ชื่อ-นามสกุล</label><input type="text" name="full_name" class="form-control" required></div>
  <div class="form-group"><label>อีเมล</label><input type="email" name="email" class="form-control" required></div>
  <div class="form-group"><label>บทบาท</label>
    <select name="role" class="form-control">
      <option value="ประชาชน">ประชาชน</option>
      <option value="รัฐบาล">รัฐบาล</option>
      <option value="แอดมิน">แอดมิน</option>
    </select>
  </div>
</form>