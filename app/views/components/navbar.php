<?php $me = Auth::user(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header"><a class="navbar-brand" href="?r=/">Green Digital</a></div>
    <ul class="nav navbar-nav">
      <?php if ($me): ?>
        <li><a href="?r=/waste/records">บันทึกขยะ</a></li>
        <li><a href="?r=/report">แจ้งเหตุ</a></li>
        <?php if ($me['role']==='แอดมิน' || $me['role']==='รัฐบาล'): ?>
          <li><a href="?r=/admin/users">สมาชิก</a></li>
          <li><a href="?r=/admin/contents">เนื้อหา</a></li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if (!$me): ?>
        <li><a href="?r=/login">เข้าสู่ระบบ</a></li>
        <li><a href="?r=/register">สมัครสมาชิก</a></li>
      <?php else: ?>
        <li><a href="?r=/profile"><?= htmlspecialchars($me['full_name']) ?></a></li>
        <li><a href="?r=/logout">ออกจากระบบ</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
