<div class="donate mt-20">
    <div class="donate-black text-center">
        <h3 class="mb-n5 mt-n3">LOGIN</h3>
    </div>
    <div class="donate-blue">
        <div class="donate-amount-box">

            <?php $session = session();
                if ($session->has('error')) {
            ?>
            <div class="text-center mb-25" id="hideMe">
                <span class="alert"><?= $session->getFlash('error'); ?></span>
            </div>
            <?php } ?>

            <div class="donate-amount">
                <form action="<?= url('auth') ?>" method="post">
                    <?php csrf()->tokenField(); ?>
                    <div class="input-group">
                        <input autocomplete="off" type="email"  name="email" value="" placeholder="Email">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="password"  name="password" value="" placeholder="Password">
                    </div>
                    <div class="donate-submit">
                        <button type="submit" autocomplete="off">LOGIN</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>