<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="<?= url('assets/home/css') ?>/custom.css" rel="stylesheet">
    <link href="<?= url('assets/home/css') ?>/sweetalert2.dark.css" rel="stylesheet">
</head>
<body>
    <?= $content; ?>
<script src="<?= url('assets/home/js') ?>/custom.js"></script>
<script src="<?= url('assets/home/js') ?>/sweetalert2.all.min.js"></script>
</body>
</html>