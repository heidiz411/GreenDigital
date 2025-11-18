<!-- สำหรับ waste record -->
<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/recs/save_recs.php" : "../controllers/recs/save_recs.php";
?>
<div class="modal fade modal-hide" id="recs" tabindex="-1" aria-labelledby="recsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="recsModalLabel">รายงานข้อมูลขยะ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" class="form-ajax" action="<?= $action ?>>" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- ชื่อเพลลิส -->
                    <div class="mb-3">
                        <label for="rep_content" class="form-label">ปัญหาที่พบ</label>
                        <input type="text" class="form-control" id="rep_content" name="rep_content" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">รูปโปรไฟล์</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>