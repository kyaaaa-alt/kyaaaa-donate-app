<!DOCTYPE html>
<head>
    <title>Running Text</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .container {
            max-width: 1920px;
            /* display:none; */
        }
        .marquee {
            font-family: 'Dosis', sans-serif;
            font-weight: 700;
            font-size:1.4rem;
            color:#fff;
            /* background-color:#379392; */
            padding:0;
            margin:0 auto;
            width:100%;
            letter-spacing: 1.2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?= $content ?>
    </div>
<script src="<?= url('assets/js'); ?>/jquery.min.js"></script>
<script src="<?= url('assets/js'); ?>/jquery.marquee.min.js" type="text/javascript"></script>
<script>
    var mq = $('.marquee').marquee({
        duration: 15000,
        gap: 50,
        delayBeforeStart: 0,
        direction: 'left',
    });
    $('.marquee')
        .bind('finished', function(){
            $('#runtext').hide();
            console.log('reloading...')
            location.reload();
        })
</script>
</body>