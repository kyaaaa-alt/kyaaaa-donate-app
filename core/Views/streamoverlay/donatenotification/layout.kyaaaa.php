<html lang="id-ID">
<head>
    <title>Donate Notifications</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('<?= $settings->pusher_key ?>', {
            cluster: '<?= $settings->pusher_cluster ?>'
        });
        var channel = pusher.subscribe('my_stream');
        channel.bind('donate_event', function(data) {
            var data = JSON.stringify(data);
            let response = JSON.parse(data);

            var name = document.querySelector('#name');
            var amount = document.querySelector('#amount');
            var msgs = document.querySelector('#msgs');
            var donasi = document.querySelector('#donasi');
            name.innerHTML = response.name;
            amount.innerHTML = response.amount;
            msgs.innerHTML = response.msgs;
            donasi.value = response.jumlah;
            show_container();
        });
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .thankyou {
            font-family: 'Dosis', sans-serif;
            font-weight: 600;
            -webkit-text-stroke: 0.8px #ffa9a9;
            color:#fff;
            width: 272px;
            height: 77px;
            margin-top: -64px;
            margin-left: 44px;
            -ms-transform: rotate(331deg);
            transform: rotate(331deg);
            text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
            0px 8px 13px rgba(0,0,0,0.2),
            0px 18px 23px rgba(0,0,0,0.2),
            -1.5px -1.5px 0 #ffa9a9,
            1.5px -1.5px 0 #ffa9a9,
            -1.5px 1px 0 #ffa9a9,
            1.5px 1.5px 0 #ffa9a9;
        }

        .container {
            max-width: 700px;
            /* display:none; */
        }

        .content {
            margin: 0 auto;
        }

        .textbox {
            font-family: 'Dosis', sans-serif;
            font-weight: 500;
            margin-left: 38px;
            margin-top: -48.3px;
            padding:22px;
            padding-left: 75px;
            background-color: #fff;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            border-radius: 10px;
            border-top-left-radius: 1px;
            font-size:1.6rem;
            text-align: center;
            z-index: 999 !important;
            border:0.8px solid #232323;
            border-top:0px solid #232323;
            border-bottom-left-radius: 85px;
            border-bottom-right-radius: 85px;
            border-top-right-radius: 85px;
        }

        .highlight {
            color:#e33e31;
            font-weight: 700;
        }

        .shake {
            animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both infinite;
            transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            perspective: 1000px;
            display: inline-block;
        }

        @keyframes shake {
            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }
            20%,
            80% {
                transform: translate3d(2px, 0, 0);
            }
            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }
            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }
        }
    </style>

</head>

<body onload="show_container()">
<input type="hidden" id="donasi" value="1000000000"></input>

<div class="container" style="display: none;">
    <?= $content ?>
</div>

<audio id="ping" src="<?= url('assets/notif')?>/ping.mp3" muted></audio>
<audio id="notifsound" src="<?= url('assets/notif')?>/notif.mp3" muted></audio>
<script src="<?= url('assets/js') ?>/anime.min.js"></script>
<script>
    var elContainer = document.querySelector('.container');
    var ping = document.getElementById("ping");
    var notifsound = document.getElementById("notifsound");

    elContainer.style.display = 'none';
    elContainer.style.opacity = 0;

    var start = anime({
        targets: '.container',
        opacity: 1,
        duration: 800,
        easing: "easeInExpo",
        complete: function() {
            var msg = new SpeechSynthesisUtterance();
            msg.text = document.getElementById("amount").innerHTML + ' dari ' + document.getElementById("name").innerHTML + ' katanya ' + document.getElementById("msgs").innerHTML;
            msg.volume = 1;
            msg.rate = 1;
            msg.pitch = 1;
            msg.lang  =  'id-ID';
            window.speechSynthesis.speak(msg);
            msg.onend = function(event) {
                notifsound.muted = true;
                notifsound.pause();
                notifsound.currentTime = 0;
                notifsound.muted = false;
                notifsound.volume = 1;
                notifsound.play();
                var durasi = notifsound.duration;
                anime({
                    targets: '.container',
                    opacity: 0,
                    duration: 1500,
                    easing: "easeOutExpo",
                    delay: (el, i) => (durasi * 1000) - 1500 + (50 * i),
                });
            }
        }
    });

    function show_container() {
        elContainer.style.display = 'inline-block';
        ping.muted = true;
        ping.pause();
        ping.currentTime = 0;
        ping.muted = false;
        ping.volume = 1;
        ping.play();
        start.reset();
        start.play();
        notifsound.pause();
    }
</script>
</body>
</html>