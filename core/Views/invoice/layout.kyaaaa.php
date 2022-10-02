<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRIS Payment</title>
    <link href="<?= url('assets/css') ?>/custom.css" rel="stylesheet">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('<?= $settings->pusher_key ?>', {
            cluster: '<?= $settings->pusher_cluster ?>'
        });
        var channel = pusher.subscribe('my_stream');
        channel.bind('donate_event', function(data) {
            var data = JSON.stringify(data);
            let response = JSON.parse(data);
            const currMerchantRef = '<?= $response->data->merchant_ref ?>';
            if (response.merchant_ref == currMerchantRef) {
                document.getElementById('box').innerHTML = '<h3>Thank You, '+response.name+'</h3><p class="text-center">Dukungan kamu sebesar '+response.amount+' berhasil terkirim!</p>';
            }
        });
    </script>
</head>
<body>
<?= $content; ?>
</body>
</html>