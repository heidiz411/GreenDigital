<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
<li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_waste_type' ? 'active' : '' ?>" href="?page=edit_waste_type">จัดการหมวดหมู่ขยะ</a>
    </li>    
<li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_user' ? 'active' : '' ?>" href="?page=edit_waste_rec">จัดการการแยกขยะ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_org' ? 'active' : '' ?>" href="?page=edit_wallet">จัดการข้อมูลวอลเล็ท</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_content' ? 'active' : '' ?>" href="?page=edit_content">จัดการโพสต์</a>
    </li>
</ul>

<div class="d-flex ms-lg-3">
    <a href="views/logout.php?logout=logout" class="btn btn-outline-light me-2">ออกจากระบบ</a>
</div>