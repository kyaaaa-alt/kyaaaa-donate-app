<div class="donate">
    <div class="donate-black">
        <div class="text-center">
            <a href="https://twitter.com/twcloudchen" class="circle">
                <img height="50" width="50" src="http://www.gravatar.com/avatar/9017a5f22556ae0eb7fb0710711ec125?s=128" alt="Cloud Chen">
            </a>
        </div>
        <h3>@<?= $username ?></h3>
        <div class="text-center">
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/instagram.svg" />
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/youtube.svg" />
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/facebook.svg" />
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/in.svg" />
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/twitch.svg" />
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/twitter.svg" />
            <img width="25" height="25" src="<?= url('assets/home/img') ?>/github.svg" />
        </div>
    </div>
    <div class="donate-blue">
        <div class="donate-amount-box">
            <div class="donate-amount">
                <div class="input-group">
                    <input autocomplete="off" type="text"  name="nama" value="" placeholder="Nama Pengirim">
                </div>
                <div class="input-group">
                    <input autocomplete="off" type="email"  name="email" value="" placeholder="Email Pengirim">
                </div>
                <div class="input-group mb-15">
                    <input autocomplete="off" type="text"  name="pesan" value="" placeholder="Pesan Pengirim">
                </div>
                <div class="denomination selected">
                    <input autocomplete="off" type="radio" id="amount5" value="10.000" checked="">
                    <label for="amount5">10K</label>
                </div>
                <div class="denomination">
                    <input autocomplete="off" type="radio" id="amount10" value="25.000">
                    <label for="amount10">25K</label>
                </div>
                <div class="denomination">
                    <input autocomplete="off" type="radio" id="amount15" value="50.000">
                    <label for="amount15">50K</label>
                </div>
                <div class="denomination">
                    <input autocomplete="off" type="radio" id="amount25" value="100.000">
                    <label for="amount25">100K</label>
                </div>
                <div class="denomination">
                    <input autocomplete="off" type="radio" id="amount50" value="200.000">
                    <label for="amount50">200K</label>
                </div>
                <div class="denomination">
                    <input autocomplete="off" type="radio" id="amount100" value="300.000">
                    <label for="amount100">300K</label>
                </div>
                <div class="denomination-other">
                    <input autocomplete="off" type="text" id="custom_amount" name="custom_amount" value="" placeholder="Ketik Manual Jumlah Donasi">
                </div>
                <input autocomplete="off" type="hidden" id="amount" name="amount">
                <div class="donate-submit">
                    <button id="donateBtn" autocomplete="off">Donate Rp 10.000</button>
                </div>
            </div>

        </div>
    </div>
    <div class="donate-black">
        <h3 class="mt-n5">Contributors</h3>

        <div class="contributors mb-8">
            <div class="contributors-header mb-8">
                Raisa Andriana <span class="donation"> Rp 50.000 </span>
                <span class="delete text-right">
              Hapus
            </span>
            </div>
            <div class="contributors-body mb-10">
                Selamat Kak
            </div>
            <div class="contributors-footer text-muted">
                1 Hari yang lalu
            </div>
        </div>
    </div>
</div>