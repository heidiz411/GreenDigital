
<form id="recForm" enctype="multipart/form-data">
  <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
  <input type="hidden" name="rec_id" value="">
  <div class="form-group"><label>องค์กร</label><input type="number" name="org_id" class="form-control" placeholder="org_id"></div>
  <div class="form-group"><label>ประเภทขยะ (type_id)</label><input type="number" name="type_id" class="form-control" placeholder="type_id" required></div>
  <div class="form-group"><label>น้ำหนัก</label><input type="number" step="0.001" name="weight" class="form-control" value="0.000"></div>
  <div class="form-group"><label>รูปภาพ</label><input type="file" name="was_image" accept="image/*" class="form-control"></div>
  <div class="form-group"><label>โน้ต</label><textarea name="note" class="form-control"></textarea></div>
  <div class="form-group"><label>สถานะ</label>
    <select name="status" class="form-control">
      <option value="ใช้งานอยู่">ใช้งานอยู่</option><option value="ระงับ">ระงับ</option><option value="ลบ">ลบ</option>
    </select>
  </div>
</form>
