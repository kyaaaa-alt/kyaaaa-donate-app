<div class="donate">
    <div class="donate-black">
        <div class="text-center">
            <a href="<?= url() ?>" class="circle">
                <img height="50" width="50" src="http://www.gravatar.com/avatar/9017a5f22556ae0eb7fb0710711ec125?s=128">
            </a>
        </div>
        <h3>@<?= $username ?></h3>
        <div class="text-center">
            <img width="25" height="25" src="<?= url('assets/img') ?>/instagram.svg" />
            <img width="25" height="25" src="<?= url('assets/img') ?>/youtube.svg" />
            <img width="25" height="25" src="<?= url('assets/img') ?>/facebook.svg" />
            <img width="25" height="25" src="<?= url('assets/img') ?>/in.svg" />
            <img width="25" height="25" src="<?= url('assets/img') ?>/twitch.svg" />
            <img width="25" height="25" src="<?= url('assets/img') ?>/twitter.svg" />
            <img width="25" height="25" src="<?= url('assets/img') ?>/github.svg" />
        </div>
    </div>
    <div class="donate-blue">
        <div class="donate-amount-box">
            <div class="donate-amount">
                <form id="donate_form">
                    <?php csrf()->tokenField(); ?>
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="name" name="name" value="" placeholder="Nama" required>
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="email" id="email" name="email" value="" placeholder="Email" required>
                    </div>
                    <div class="input-group mb-15">
                        <input autocomplete="off" type="text" id="msgs" name="msgs" value="" placeholder="Pesan" required>
                    </div>
                    <div class="denomination selected">
                        <input autocomplete="off" type="radio" value="10.000" checked="">
                        <label for="amount5">10K</label>
                    </div>
                    <div class="denomination">
                        <input autocomplete="off" type="radio" value="25.000">
                        <label for="amount10">25K</label>
                    </div>
                    <div class="denomination">
                        <input autocomplete="off" type="radio"value="50.000">
                        <label for="amount15">50K</label>
                    </div>
                    <div class="denomination">
                        <input autocomplete="off" type="radio" value="100.000">
                        <label for="amount25">100K</label>
                    </div>
                    <div class="denomination">
                        <input autocomplete="off" type="radio" value="200.000">
                        <label for="amount50">200K</label>
                    </div>
                    <div class="denomination">
                        <input autocomplete="off" type="radio" value="300.000">
                        <label for="amount100">300K</label>
                    </div>
                    <input autocomplete="off" type="hidden" id="amount" name="amount" value="10000">
                </form>
                <div class="denomination-other">
                    <input autocomplete="off" type="text" id="custom_amount" name="custom_amount" value="" placeholder="Ketik Manual Jumlah Dukungan">
                </div>
                <div class="donate-submit">
                    <button onclick="doDonate('<?= url("do_donate") ?>');" autocomplete="off">Donate Rp 10.000</button>
                </div>

            </div>

        </div>
    </div>
    <div class="donate-black container data">
        <h3 class="mt-n5">Contributors</h3>
        <div id="paginated-list" class="page">
        <?php foreach ($donations as $row) {
            if ($row->private == yes) {
                $amount = 'Privacy';
                $display = 'style="display:none;"';
            } else {
                $amount = Rp . ' ' . number_format(esc($row->amount),0,',','.');
                $display = '';
            }
            $contributor = esc($row->customer_name);
            $date = esc($row->created_at);
            $msgs = esc($row->msgs);

        ?>
            <div class="contributors mb-8">
                <div class="contributors-header mb-8">
                    <?= $contributor ?> <span class="donation">  <?= $amount ?> </span>
<!--                    <span class="delete text-right">Hapus</span>-->
                </div>
                <div class="contributors-body mb-10" <?= $display ?>>
                    <?= $msgs ?>
                </div>
                <div class="contributors-footer text-muted">
                    <?= $date ?>
                </div>
            </div>
        <?php } ?>
        </div>
            <nav class="pagination-container mb-n8">
                <button class="pagination-button" id="prev-button" title="Previous page">&lt;</button>
                <button class="pagination-button" id="next-button" title="Next page">&gt;</button>
            </nav>
    </div>

</div>