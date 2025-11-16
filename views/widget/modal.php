<!-- สำหรับ เข้าสู่ระบบ -->
<div class="modal fade modal-hide" id="login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="bi bi-box-arrow-in-right me-2"></i> เข้าสู่ระบบ
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="message p-2"></div>
            <div class="modal-body p-4">
                <form method="POST" action="controllers/check_users.php" class="form-ajax">

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">รหัสผ่าน</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                จำฉันไว้
                            </label>
                        </div>
                        <a href="#" class="text-decoration-none small">ลืมรหัสผ่าน?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i> เข้าสู่ระบบ
                    </button>

                </form>
            </div>
            <div class="modal-footer text-center">
                <p class="w-100 mb-0">ยังไม่มีบัญชี?
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">สมัครสมาชิก</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- สำหรับ สมัครสมาชิก -->
<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/users/save_users.php" : "../controllers/users/save_users.php";
?>
<div class="modal fade modal-hide" id="register" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="registerModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i> สมัครสมาชิก
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="message mt-2 p-2"></div>
            <div class="modal-body p-4">
                <form method="POST" action="<?= $action ?>" enctype="multipart/form-data" class="form-ajax">
                    <input type="hidden" name="user_id">
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="regEmail" class="form-control" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="regPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="regPassword" class="form-control" placeholder="••••••••" minlength="8" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="ชื่อ-นามสกุล" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="ที่อยู่" required>
                    </div>

                    <div class="mb-3">
                        <label for="sub" class="form-label">ตำบล</label>
                        <input type="text" class="form-control" id="sub" name="sub" placeholder="ตำบล" required>
                    </div>

                    <div class="mb-3">
                        <label for="dis" class="form-label">อำเภอ</label>
                        <input type="text" class="form-control" id="dis" name="dis" placeholder="อำเภอ" required>
                    </div>

                    <div class="mb-3">
                        <label for="prov" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="prov" name="prov" placeholder="จังหวัด" required>
                    </div>

                    <div class="mb-3">
                        <label for="zipcode" class="form-label">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="รหัสไปรษณีย์" required>
                    </div>

                    <div class="mb-3">
                        <label for="profileImage" class="form-label">รูปโปรไฟล์</label>
                        <input class="form-control" type="file" id="profileImage" name="image" accept="image/*">
                    </div>

                    <?php if (isset($users)) : ?>
                        <div class="mb-3">
                            <label for="role" class="form-label">ประเภทผู้ใช้</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="ประชาชน" selected>ประชาชน</option>
                                <option value="รัฐบาล">รัฐบาล</option>
                                <option value="แอดมิน">แอดมิน</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-person-plus me-1"></i> บันทึก
                    </button>

                </form>
            </div>
            <div class="modal-footer text-center">
                <p class="w-100 mb-0">มีบัญชีแล้ว?
                    <a href="#">เข้าสู่ระบบ</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- สำหรับ แก้ไไข -->
<?php
$action = basename($_SERVER['PHP_SELF']) == "index.php" ? "controllers/users/save_users.php" : "../controllers/users/save_users.php";
?>
<div class="modal fade modal-hide" id="edit_users" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="registerModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i> แก้ไขสมาชิก
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="message mt-2 p-2"></div>
            <div class="modal-body p-4">
                <form method="POST" action="<?= $action ?>" enctype="multipart/form-data" class="form-ajax">
                    <input type="hidden" name="user_id">
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="regEmail" class="form-control" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="regPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="regPassword" class="form-control" placeholder="••••••••" minlength="8">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fname" class="form-label">ชื่อจริง</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="ชื่อ" required>
                    </div>

                    <div class="mb-3">
                        <label for="lname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="นามสกุล" required>
                    </div>

                    <div class="mb-3">
                        <label for="profileImage" class="form-label">รูปโปรไฟล์</label>
                        <input class="form-control" type="file" id="profileImage" name="image" accept="image/*">
                    </div>

                    <?php if (isset($users)) : ?>
                        <div class="mb-3">
                            <label for="role" class="form-label">ประเภทผู้ใช้</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="ประชาชน" selected>ประชาชน</option>
                                <option value="รัฐบาล">รัฐบาล</option>
                                <option value="แอดมิน">แอดมิน</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-person-plus me-1"></i> บันทึก
                    </button>

                </form>
            </div>
            <div class="modal-footer text-center">
                <p class="w-100 mb-0">มีบัญชีแล้ว?
                    <a href="#">เข้าสู่ระบบ</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- สำหรับ lists -->
<div class="modal fade modal-hide" id="lists" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addListModalLabel">เพิ่มลิสต์วิดีโอใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" class="form-ajax" action="../controllers/lists/save_lists.php" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- ชื่อเพลลิส -->
                    <div class="mb-3">
                        <label for="list_title" class="form-label">ชื่อเพลลิส</label>
                        <input type="text" class="form-control" id="list_title" name="list_title" required>
                    </div>

                    <!-- รูปภาพเพลลิส -->
                    <div class="mb-3">
                        <label for="list_image" class="form-label">รูปภาพเพลลิส</label>
                        <input type="file" class="form-control" id="list_image" name="list_image" required>
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

<!-- สำหรับ แก้ไข lists -->
<div class="modal fade modal-hide" id="edit_lists" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addListModalLabel">แก้ไขลิสต์วิดีโอใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" class="form-ajax" action="../controllers/lists/save_lists.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="list_id">
                    <!-- ชื่อเพลลิส -->
                    <div class="mb-3">
                        <label for="list_title" class="form-label">ชื่อเพลลิส</label>
                        <input type="text" class="form-control" id="list_title" name="list_title" required>
                    </div>

                    <!-- รูปภาพเพลลิส -->
                    <div class="mb-3">
                        <label for="list_image" class="form-label">รูปภาพเพลลิส</label>
                        <input type="file" class="form-control" id="list_image" name="list_image">
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

<!-- สำหรับ reports -->
<div class="modal fade modal-hide" id="reports" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addListModalLabel">รายงานปัญหา</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" class="form-ajax" action="../controllers/reports/save_reports.php" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- ชื่อเพลลิส -->
                    <div class="mb-3">
                        <label for="rep_content" class="form-label">ปัญหาที่พบ</label>
                        <input type="text" class="form-control" id="rep_content" name="rep_content" required>
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

<!-- สำหรับ videos -->
<div class="modal fade modal-hide" id="videos" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addListModalLabel">เพิ่มลิสต์วิดีโอใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="form-ajax" method="post" action="../controllers/videos/save_videos.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="message p-2"></div>
                    <input type="hidden" name="vie_id">
                    <input type="hidden" name="list_id" value="<?= $list_id ?>">

                    <div class="mb-3">
                        <label for="list_title" class="form-label">หัวข้อคลิป</label>
                        <input type="text" class="form-control" id="vie_title" name="vie_title" required>
                    </div>

                    <div class="mb-3">
                        <label for="list_title" class="form-label">คำอธิบายคลิป</label>
                        <input type="text" class="form-control" id="vie_detail" name="vie_detail" required>
                    </div>

                    <div class="mb-3">
                        <label for="vie_file" class="form-label">ปกคลิป</label>
                        <input type="file" class="form-control" id="vie_poster" name="vie_poster" required>
                    </div>

                    <div class="mb-3">
                        <label for="vie_file" class="form-label">ไฟล์วิดีโอ</label>
                        <input type="file" class="form-control" id="vie_file" name="vie_file" accept="video/mp4, video/webm, video/ogg" required>
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

<!-- สำหรับแก้ไข videos -->
<div class="modal fade modal-hide" id="edit_videos" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addListModalLabel">แก้ไขลิสต์วิดีโอใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="form-ajax" method="post" action="../controllers/videos/save_videos.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="message p-2"></div>
                    <input type="hidden" name="vie_id">
                    <input type="hidden" name="list_id" value="<?= $list_id ?>">

                    <div class="mb-3">
                        <label for="list_title" class="form-label">หัวข้อคลิป</label>
                        <input type="text" class="form-control" id="vie_title" name="vie_title" required>
                    </div>

                    <div class="mb-3">
                        <label for="list_title" class="form-label">คำอธิบายคลิป</label>
                        <input type="text" class="form-control" id="vie_detail" name="vie_detail" required>
                    </div>

                    <div class="mb-3">
                        <label for="vie_file" class="form-label">ปกคลิป</label>
                        <input type="file" class="form-control" id="vie_poster" name="vie_poster">
                    </div>

                    <div class="mb-3">
                        <label for="vie_file" class="form-label">ไฟล์วิดีโอ</label>
                        <input type="file" class="form-control" id="vie_file" name="vie_file" accept="video/mp4, video/webm, video/ogg">
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