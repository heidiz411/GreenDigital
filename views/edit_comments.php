<div class="d-flex">
    <?php include_once 'widget/navbar_admin.php'; ?>
    <div class="flex-grow-1">
            <div class="container-sm py-5 mt-5">
                
                    
                    
                        <small style=" font-size:30px;" class="text-center fw-bold text-primary">ตารางการจัดการคอมเมนต์</small>
                <hr>

                <!-- form search start -->
                <form action="edit_comments.php" class=" mt-3" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <select name="column" id="" class="form-select" placehoder="search">
                            <option value="com_content">ข้อความ</option>
                            <option value="com_id">คอมเมนต์ ID</option>
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
                            <th>เนื้อหาคอมเมนท์</th>
                            <th>วันที่คอมเมนต์</th>
                            <th>วิดีโอที่คอมเมนต์</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="results">
                        <?php
                        if(!empty($_POST['search'])){
                            $search='%'.$_POST['search'].'%' ?? null;
                            $column=$_POST['column'] ?? null;
                            $sql="SELECT * FROM tb_comments WHERE $column LIKE '$search' ";                          
                        }else{
                            $sql="SELECT * FROM tb_comments";
                        }
                        $stmt=$db->prepare($sql);
                        $stmt->execute();
                        $comments=$stmt->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <?php foreach($comments as $row) : ?>
                        <tr class="pop-up-table">
                            <td><?=$row['com_id']?></td>
                            <td><?=$row['com_content']?></td>
                            <td><?=$row['com_date']?></td>
                            <td><a href="show_video.php?vie_id=<?=$row['vie_id']?>">คลิกเพื่อดูเนื้อหา</a></td>
                            <td>
                                <div class="btn-group">
                                    <button data-controllers="../controllers/comments/delete_comments.php" data-id="<?=$row['com_id']?> " class="btn btn-sm btn-danger pop-up me-2 btn-delete">ลบข้อมูล</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>