<div class="donate mt-20">
    <div class="donate-black text-center">
        <a href="<?= url('dashboard') ?>">
            <img width="30" class="text-left mt-n10" src="<?= url('assets/img') ?>/back.svg">
        </a>
        <h3 class="mb-n5 mt-n3 mr-30">SETTINGS</h3>

        <a href="<?= url('logout') ?>">
            <img width="30" class="text-right mt-n20" src="<?= url('assets/img') ?>/exit.svg">
        </a>
    </div>
    <div class="donate-blue">
        <div class="donate-amount-box">

            <?php $session = session();
                if ($session->has('notif')) {
            ?>
            <div class="text-center mb-25" id="hideMe">
                <span class="alert"><?= $session->getFlash('notif'); ?></span>
            </div>
            <?php } ?>

            <div class="donate-amount">
                <p class="mt-n10">Stream Overlay</p>
                <p class="f12 mt-n10">Notification : <a href="" class="link"><?= url('notification') ?></a></p>
                <p class="f12 mt-n15">Running Text : <a href="" class="link" ><?= url('running_text') ?></a></p>


                <form action="<?= url('update_settings') ?>" method="post" enctype="multipart/form-data">
                    <?php csrf()->tokenField(); ?>

                    <div class="file-upload mb-5 mr-15">
                        <div class="file-upload-select">
                            <div class="file-select-button" >Notification</div>
                            <div class="file-select-name">File (mp3)</div>
                            <input type="file" name="notif" id="notif">
                        </div>
                    </div>

                    <div class="file-upload mb-5 mr-15">
                        <div class="file-upload-select">
                            <div class="file-select-button" >Choose avatar</div>
                            <div class="file-select-name">File (png;jpg)</div>
                            <input type="file" name="avatar" id="file-upload-input">
                        </div>
                    </div>

                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="name" value="<?= esc(session()->get('name')) ?>" placeholder="full name">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="username" value="<?= esc(session()->get('username')) ?>" placeholder="username">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="email"  name="email" value="<?= esc(session()->get('email')) ?>" placeholder="email">
                    </div>
                    <div class="input-group mb-10">
                        <input autocomplete="off" type="password"  name="password" value="" placeholder="password">
                    </div>

                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="merchantcode" placeholder="Tripay Merchant Code">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="apikey" placeholder="Tripay API Key">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="privatekey" placeholder="Tripay Private Key">
                    </div>
                    <div class="input-group">
                        <select name="endpoint" id="endpoint">
                            <option disabled selected>Mode</option>
                            <option value="api">Development</option>
                            <option value="api-sandbox">Production</option>
                        </select>
                    </div>
                    <div class="donate-submit">
                        <button type="submit" autocomplete="off">UPDATE</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>