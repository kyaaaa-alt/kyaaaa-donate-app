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
                if ($session->has('error')) {
            ?>
            <div class="text-center mb-25" id="hideMe">
                <span class="alert"><?= $session->getFlash('error'); ?></span>
            </div>
            <?php }
            if ($session->has('success')) {?>
            <div class="text-center mb-25" id="hideMe">
                <span class="success"><?= $session->getFlash('success'); ?></span>
            </div>
            <?php } ?>

            <div class="text-center">
                <a class="btn btn-swipe no-bg angle" href="#/" onclick="showProfile()">
                    Profile
                </a>
                <a class="btn btn-swipe no-bg angle" href="#/" onclick="showStream()">
                    Stream
                </a>
                <a class="btn btn-swipe no-bg angle" href="#/" onclick="showTripay()">
                    TriPay
                </a>
                <a class="btn btn-swipe no-bg angle" href="#/" onclick="showPusher()">
                    Pusher
                </a>
            </div>

            <div class="donate-amount">

                <form id="profile" action="<?= url('update_profile') ?>" method="post" enctype="multipart/form-data">
                    <?php csrf()->tokenField(); ?>
                    <div class="file-upload2 mb-5 mr-15 mt-20">
                        <div class="file-upload-select2">
                            <div class="file-select-button2" >Choose avatar</div>
                            <div class="file-select-name2">File (png;jpg)</div>
                            <input type="file" name="avatar" id="file-upload-input2" accept="image/png, image/jpeg">
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
                        <input autocomplete="off" type="password"  name="password" placeholder="password">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="fb" placeholder="fb" value="<?= esc($users->fb) ?>">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="ig" value="<?= esc($users->ig) ?>" placeholder="ig">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="linkedin" value="<?= esc($users->linkedin) ?>" placeholder="linkedin">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="twitch" value="<?= esc($users->twitch) ?>" placeholder="twitch">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="yt" value="<?= esc($users->yt) ?>" placeholder="yt">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="twitter" value="<?= esc($users->twitter) ?>" placeholder="twitter">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="github" value="<?= esc($users->github) ?>" placeholder="github">
                    </div>
                    <div class="donate-submit">
                        <button type="submit" autocomplete="off">UPDATE</button>
                    </div>
                </form>

                <form id="stream" style="display: none;" action="<?= url('update_stream') ?>" method="post" enctype="multipart/form-data">
                    <?php csrf()->tokenField(); ?>
                    <p class="">Stream Overlay</p>
                    <p class="f12 mt-n10">Notification : <a href="<?= url('donate_notification') ?>" target="_blank" class="link"><?= url('donate_notification') ?></a></p>
                    <p class="f12 mt-n15">Running Text : <a href="<?= url('running_text') ?>" target="_blank" class="link" ><?= url('running_text') ?></a></p>
                    <a class="testbtn mb-10" href="<?= url('test_notification') ?>" onclick="showPusher()">
                        Test Send Donate Overlay
                    </a>
                    <div class="file-upload mb-5 mr-15">
                        <div class="file-upload-select">
                            <div class="file-select-button" >Notification</div>
                            <div class="file-select-name">File (mp3)</div>
                            <input type="file" name="notif" id="file-upload-input" accept=".mp3">
                        </div>
                    </div>
                    <div class="donate-submit">
                        <button type="submit" autocomplete="off">UPDATE</button>
                    </div>
                </form>

                <form id="tripay" style="display: none;" action="<?= url('update_tripay') ?>" method="post">
                    <?php csrf()->tokenField(); ?>
                    <p class="f12 mt-20 mb-n8">Get your key here : <a href="https://tripay.co.id" class="link">https://tripay.co.id</a></p>
                    <p class="f12">Put this callback link to your tripay merchant : <a href="<?= url('callback') ?>" class="link"><?= url('callback') ?></a></p>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="merchant_code" placeholder="Tripay Merchant Code" value="<?= esc($settings->merchant_code) ?>" required>
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="merchant_api_key" placeholder="Tripay API Key" value="<?= esc($settings->merchant_api_key) ?>" required>
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="merchant_private_key" placeholder="Tripay Private Key" value="<?= esc($settings->merchant_private_key) ?>" required>
                    </div>
                    <div class="input-group">
                        <select name="endpoint" id="endpoint" required>
                            <option disabled selected><?php if ($settings->endpoint == 'api') { echo 'Production'; } else {echo 'Development';} ?></option>
                            <option value="api">Development</option>
                            <option value="api-sandbox">Production</option>
                        </select>
                    </div>
                    <div class="donate-submit">
                        <button type="submit" autocomplete="off">UPDATE</button>
                    </div>
                </form>

                <form id="pusher" style="display: none;" action="<?= url('update_pusher') ?>" method="post" enctype="multipart/form-data">
                    <?php csrf()->tokenField(); ?>
                    <p class="f12 mt-20">Get your key here : <a href="https://pusher.com/channels" class="link">https://pusher.com/channels</a></p>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="pusher_app_id" placeholder="pusher app id" value="<?= esc($settings->pusher_app_id) ?>" required>
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="pusher_key" placeholder="pusher key" value="<?= esc($settings->pusher_key) ?>" required>
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="pusher_secret" placeholder="pusher secret" value="<?= esc($settings->pusher_secret) ?>" required>
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" type="text"  name="pusher_cluster" placeholder="pusher cluster" value="<?= esc($settings->pusher_cluster) ?>" required>
                    </div>
                    <div class="donate-submit">
                        <button type="submit" autocomplete="off">UPDATE</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>