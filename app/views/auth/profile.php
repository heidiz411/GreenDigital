<div class="row">
    <div class="col-sm-6">
        <form id="profileForm">
            <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
            <div class="form-group"><label>ชื่อ-นามสกุล</label><input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars(Auth::user()['full_name']) ?>"></div>
            <div class="form-group"><label>โทรศัพท์</label><input type="text" name="phone" class="form-control"></div>
            <div class="form-group"><label>ที่อยู่</label><textarea name="address" class="form-control"></textarea></div>
            <button class="btn btn-primary">บันทึก</button>
        </form>
    </div>
    <div class="col-sm-6">
        <form id="changePassForm">
            <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
            <div class="form-group"><label>รหัสผ่านเดิม</label><input type="password" name="old_password" class="form-control" required></div>
            <div class="form-group"><label>รหัสผ่านใหม่</label><input type="password" name="new_password" class="form-control" required></div>
            <button class="btn btn-warning">เปลี่ยนรหัสผ่าน</button>
        </form>
    </div>
</div>