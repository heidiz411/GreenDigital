
<?php
if (isset($contentViewPath) && is_file($contentViewPath)) { require $contentViewPath; }
else { echo '<div class="alert alert-info">ไม่มี contentViewPath ถูกระบุ</div>'; }
