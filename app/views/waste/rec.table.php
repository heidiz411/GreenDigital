<div class="row" style="margin-bottom:10px;">
    <div class="col-sm-2"><input type="date" id="fltFrom" class="form-control" placeholder="จากวันที่"></div>
    <div class="col-sm-2"><input type="date" id="fltTo" class="form-control" placeholder="ถึงวันที่"></div>
    <div class="col-sm-3">
        <select id="fltOrg" class="form-control">
            <option value="">-- ทุกองค์กร --</option>
            <?php if (isset($orgs)) foreach ($orgs as $o): ?>
                <option value="<?= (int)$o['org_id'] ?>"><?= htmlspecialchars($o['org_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-sm-3"><input type="text" id="fltQ" class="form-control" placeholder="ค้นหาโน้ต"></div>
    <div class="col-sm-2 text-right">
        <button id="btnFilter" class="btn btn-default">กรอง</button>
        <a class="btn btn-default" id="btnExport" target="_blank">Export CSV</a></div>
</div>
<div class="text-right" style="margin-bottom:10px;">
    <button id="btnAddWasteRec" class="btn btn-success">บันทึกขยะ</button>
</div>
<table id="wasteRecTable" class="display table table-striped table-bordered" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>ผู้ใช้</th>
        <th>องค์กร</th>
        <th>ประเภท</th>
        <th>น้ำหนัก</th>
        <th>สถานะ</th>
        <th>สร้างเมื่อ</th>
        <th>จัดการ</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>