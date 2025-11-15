<?php require_once __DIR__ . '/../../core/Config.php'; require_once __DIR__ . '/../../core/Auth.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($pageTitle ?? 'Green Digital', ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  <style> body{ padding-top:70px; } .banner{ margin:10px 0 20px; } </style>
</head>
<body>
  <?php require __DIR__ . '/navbar.php'; ?>
  <div class="container">
    <?php require __DIR__ . '/header.php'; ?>
    <?php require __DIR__ . '/banner.php'; ?>
    <div class="content">
      <?php require $contentViewPath; ?>
    </div>
    <?php require __DIR__ . '/footer.php'; ?>
  </div>
  <?php require __DIR__ . '/modal.php'; ?>
  <script src="https://code.jquery.com/jquery/3.7.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?= Config::BASE_URL ?>/assets/js/modal.js"></script>
  <script src="<?= Config::BASE_URL ?>/assets/js/auth.js"></script>
  <script src="<?= Config::BASE_URL ?>/assets/js/crud.users.js"></script>
  <script src="<?= Config::BASE_URL ?>/assets/js/crud.contents.js"></script>
  <script src="<?= Config::BASE_URL ?>/assets/js/crud.waste.js"></script>
  <script src="<?= Config::BASE_URL ?>/assets/js/chart.js"></script>
</body>
</html>
