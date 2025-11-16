<div class="d-flex">
    <?php include_once 'widget/navbar_admin.php'; ?>
    <div class="flex-grow-1">
            <div class="container-sm py-5 mt-5">
                
                    
                    
                        <small style=" font-size:30px;" class="text-center fw-bold text-primary">ตารางการจัดการเพลลิสย์</small>
                <hr>

                <!-- form search start -->
                <form action="edit_playlists.php" class=" mt-3" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <select name="column" id="" class="form-select" placehoder="search">
                            <option value="list_title">ชื่อเพลลิส</option>
                            <option value="list_id">เพลลิส ID</option>
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
                            <th>ปกเพลลิสย์</th>
                            <th>ชื่อเพลลิสย์</th>
                            <th>วันที่สร้าง</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="results">
                        <?php
                        if(!empty($_POST['search'])){
                            $search='%'.$_POST['search'].'%' ?? null;
                            $column=$_POST['column'] ?? null;
                            $sql="SELECT * FROM tb_lists WHERE $column LIKE '$search' ";                          
                        }else{
                            $sql="SELECT * FROM tb_lists";
                        }
                        $stmt=$db->prepare($sql);
                        $stmt->execute();
                        $lists=$stmt->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <?php foreach($lists as $row) : ?>
                        <tr class="pop-up-table">
                            <td><?=$row['list_id']?></td>
                            <td><img src="../image/list/<?=$row['list_image']?>" width="65px" height="65px" class=" border image-css" alt=""></td>
                            <td><?=$row['list_title']?></td>
                            <td><?=$row['list_date']?></td>
                            <td>
                                <div class="btn-group">
                                    <button data-controllers="../controllers/lists/delete_lists.php" data-id="<?=$row['list_id']?> " class="btn btn-sm btn-danger pop-up me-2 btn-delete">ลบข้อมูล</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>