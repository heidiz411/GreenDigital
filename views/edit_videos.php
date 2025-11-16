<div class="d-flex">
    <?php include_once 'widget/navbar_admin.php'; ?>
    <div class="flex-grow-1">
            <div class="container-sm py-5 mt-5">
                
                    
                    
                        <small style=" font-size:30px;" class="text-center fw-bold text-primary">ตารางการจัดการคลิปวิดีโอ</small>
                <hr>

                <!-- form search start -->
                <form action="edit_videos.php" class=" mt-3" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <select name="column" id="" class="form-select" placehoder="search">
                            <option value="vie_title">ชื่อคลิป</option>
                            <option value="vie_id">คลิป ID</option>
                        </select>
                        <label class="form-label">ค้นหาตาม</label>
                        
                        <div class="input-group mt-3">
                            <input type="search" name="search" class="form-control" placeholder="ค้นหาข้อมูล">
                            <button type="submit" class="btn btn-primary">ค้นหาข้อมูล</button>
                        </div>
                    </div>
                </form>
                <!-- form search end -->

                <table class="table table-bordered table-scriped table-hover align-middle mb-0">
                    <thead class="text-center pop-up-table">
                        <tr>
                            <th>ID</th>
                            <th>ปกคลิป</th>
                            <th>ชื่อคลิป</th>
                            <th>วันที่อัปโหลด</th>
                            <th>ยอดเข้าชม</th>
                            <th>ไฟล์วิดีโอ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="results">
                        <?php
                        if(!empty($_POST['search'])){
                            $search='%'.$_POST['search'].'%' ?? null;
                            $column=$_POST['column'] ?? null;
                            $sql="SELECT * FROM tb_videos WHERE $column LIKE '$search' ";                          
                        }else{
                            $sql="SELECT * FROM tb_videos";
                        }
                        $stmt=$db->prepare($sql);
                        $stmt->execute();
                        $videos=$stmt->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <?php foreach($videos as $row) : ?>
                        <tr class="pop-up-table">
                            <td><?=$row['vie_id']?></td>
                            <td><img src="../image/poster/<?=$row['vie_poster']?>" width="65px" height="65px" class=" border image-css" alt=""></td>
                            <td><?=$row['vie_title']?></td>
                            <td><?=$row['vie_date']?></td>
                            <td><?=$row['vie_view'] ?? 0 ?></td>
                            <td><a href="show_video.php?vie_id=<?=$row['vie_id']?>">คลิกเพื่อดูเนื้อหา</a></td>
                            <td>
                                <div class="btn-group">
                                    <button data-controllers="../controllers/videos/delete_videos.php" data-id="<?=$row['vie_id']?> " class="btn btn-sm btn-danger pop-up me-2 btn-delete">ลบข้อมูล</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>