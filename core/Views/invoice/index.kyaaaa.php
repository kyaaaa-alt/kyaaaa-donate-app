<div class="donate">
    <div class="donate-black">
        <div class="text-center inv-header mt-3">
            <a href="<?= url() ?>">
                <img width="35" class="text-left" src="<?= url('assets/img') ?>/back.svg">
            </a>
            <img width="100" class="logo mt-1" src="<?= url('assets/img') ?>/qris.svg">
        </div>
    </div>
    <div class="donate-blue">
        <div class="donate-amount-box text-center">
            <img class="qr" id="qr" src="<?= $response->data->qr_url ?>">
            <div class="donatur">
                <h3>Rp <?= number_format($response->data->amount,0,',','.') ?> from <?= $response->data->customer_name ?></h3>
            </div>

            <h5 class="mt-n3">Batas Pembayaran</h5>
            <span class="expdate mt-n8"><?= date("d/m/y H:i",$response->data->expired_time) ?></span>
        </div>
    </div>
    <div class="donate-black">
        <p class="text-center">Secure Payment by TriPay</p>
    </div>
</div>