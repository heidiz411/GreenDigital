<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/users/forgot_password.php" : "../controllers/users/forgot_password.php";
?>
<form id="edit_user" method="POST" action="<?= $action ?>" enctype="multipart/form-data" class="form-ajax">
    <div class="mb-3">
        <label for="email" class="form-label">อีเมล</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="question" class="form-label">คำถาม</label>
        <select class="form-select" id="question" name="question" required>
            <option value="สัตว์เลี้ยงที่ชื่นชอบ" selected>สัตว์เลี้ยงที่ชื่นชอบ</option>
            <option value="อาหารที่ชื่นชอบ">อาหารที่ชื่นชอบ</option>
            <option value="สีที่ชื่นชอบ">สีที่ชื่นชอบ</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="answer" class="form-label">คำตอบ</label>
        <input type="text" name="answer" id="answer" class="form-control" placeholder="" required>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-box-arrow-in-right me-1"></i> ส่งคำตอบ
    </button>
</form>