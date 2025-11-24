<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_waste_rec' ? 'active' : '' ?>" href="?page=edit_waste_rec">จัดการการแยกขยะ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_wallet' ? 'active' : '' ?>" href="?page=edit_wallet">จัดการวอลเล็ท</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $_GET['page'] == 'edit_content' ? 'active' : '' ?>" href="?page=edit_content">โพสต์</a>
    </li>
</ul>

<div class="d-flex ms-lg-3">
    <a href="views/logout.php?logout=logout" class="btn btn-outline-light me-2">ออกจากระบบ</a>
</div>