<div class="d-flex">
    <?php include_once 'widget/navbar_admin.php'; ?>
    <div class="flex-grow-1">
            <div class="container-sm py-5 mt-5">
                
                    
                    
                        <small style=" font-size:30px;" class="text-center fw-bold text-primary">รายงานปัญหา</small>
                <hr>

               

                <table class="table table-bordered table-scriped table-hover align-middle mb-0">
                    <thead class="text-center pop-up-table">
                        <tr>
                            <th>ID</th>
                            <th>เนื้อหารายงาน</th>
                            <th>วันที่รายงาน</th>
                            <th>ชื่อผู้ใ่ช้</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="results">
                        <?php
                        $sql="SELECT * FROM tb_reports as r LEFT JOIN tb_users as u on r.user_id=u.user_id ORDER BY r.rep_date DESC";
                        $stmt=$db->prepare($sql);
                        $stmt->execute();
                        $comments=$stmt->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <?php foreach($comments as $row) : ?>
                        <tr class="pop-up-table">
                            <td><?=$row['rep_id']?></td>
                            <td><?=$row['rep_content']?></td>
                            <td><?=$row['rep_date']?></td>
                            <td><?=$row['fname']?> <?=$row['lname']?></td>
                            <td>
                                <div class="btn-group">
                                    <button data-controllers="../controllers/reports/delete_reports.php" data-id="<?=$row['rep_id']?> " class="btn btn-sm btn-danger pop-up me-2 btn-delete">ลบข้อมูล</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>