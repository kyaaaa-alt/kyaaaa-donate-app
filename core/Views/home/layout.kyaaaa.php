<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="<?= url('assets/css') ?>/custom.css" rel="stylesheet">

</head>
<body>
    <?= $content; ?>
<script src="<?= url('assets/js') ?>/custom.js"></script>
<script src="<?= url('assets/js') ?>/sweetalert2.all.min.js"></script>
</body>
</html>