<div class="donate">
    <div class="donate-black text-center">
        <a href="<?= url('logout') ?>">
            <img width="30" class="text-left mt-n10" src="<?= url('assets/img') ?>/logout.svg">
        </a>
        <h3 class="mb-n5 mt-n3 mr-25">DASHBOARD</h3>

        <a href="<?= url('dashboard/settings') ?>">
            <img width="30" class="text-right mt-n20" src="<?= url('assets/img') ?>/edit.svg">
        </a>
    </div>
    <div class="donate-blue text-center">
        <h4 class="mt-n5">Hi, <?= session()->get('name') ?></h4>
        <div class="card mt-n15">
            <div class="header mb-8">Profit</div>
            <span class="profit mt-25 mb-10">Rp 500.000</span>
            <div class="footer mt-10">5/2 Donation</div>
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
                $amount = Rp . ' ' . number_format($row->amount,0,',','.');
                $display = '';
            }
            $contributor = $row->customer_name;
            $date = $row->created_at;
            $msgs = $row->msgs;
            $status = $row->status;
            if ($status != 'PAID') {
                $status_color = 'unpaid';
            } else {
                $status_color = 'paid';
            }
        ?>
            <div class="contributors mb-8">
                <div class="contributors-header mb-8">
                    <div class="mb-5"><?= $contributor ?>   <span class="delete text-right inline">Hapus</span></div>
                    <span class="<?= $status_color ?> mt-5 mr-3">  <?= $status ?> </span> <span class="donation mt-5">  <?= $amount ?> </span>
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
        <nav class="pagination-container">
            <button class="pagination-button" id="prev-button" title="Previous page">&lt;</button>

            <button class="pagination-button" id="next-button" title="Next page">&gt;</button>
        </nav>
    </div>

</div>