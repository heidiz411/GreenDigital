<form id="typeForm">
    <input type="hidden" name="_csrf" value="<?= Auth::csrfToken() ?>">
    <input type="hidden" name="type_id" value="">
    <div class="form-group"><label>ชื่อประเภท</label><input type="text" name="type_name" class="form-control" required></div>
    <div class="form-group"><label>หน่วย</label><input type="text" name="type_unit" class="form-control" placeholder="เช่น kg, ชิ้น" required></div>
    <div class="form-group"><label>ราคาประเมิน</label><input type="number" step="0.01" name="type_cash" class="form-control" value="0.00"></div>
</form>