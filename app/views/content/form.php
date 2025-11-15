
<form id="contentForm" enctype="multipart/form-data">
  <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
  <input type="hidden" name="content_id" value="">
  <div class="form-group"><label>หัวข้อ</label><input type="text" name="title" class="form-control" required></div>
  <div class="form-group"><label>รายละเอียด</label><textarea name="body" class="form-control" rows="4"></textarea></div>
  <div class="form-group"><label>รูปภาพ</label><input type="file" name="image" accept="image/*" class="form-control"></div>
  <div class="form-group"><label>วันเผยแพร่</label><input type="datetime-local" name="publish_at" class="form-control"></div>
  <div class="form-group"><label>วันหมดอายุ</label><input type="datetime-local" name="expire_at" class="form-control"></div>
  <div class="checkbox"><label><input type="checkbox" name="is_active" value="1" checked> เปิดใช้งาน</label></div>
</form>
