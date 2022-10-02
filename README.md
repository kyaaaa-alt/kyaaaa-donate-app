### Kyaaaa-Donate-APP
#### Personal donation system with Stream Overlay

![mimum_requirements_php](https://img.shields.io/badge/PHP-^7.3|^8.0-green?style=flat-square&logo=PHP)
![last_commit](https://img.shields.io/github/last-commit/naufkia/kyaaaa-php?style=flat-square)

Kyaaaa-Donate-APP adalah sistem donasi pribadi dengan dukungan stream overlay dan dibuat menggunakan framework php buatan sendiri ([Kyaaaa-PHP Framework](https://github.com/naufkia/kyaaaa-php))

#### What inside?

* [Kyaaaa-PHP Framework](https://github.com/naufkia/kyaaaa-php) - Lightweight PHP Framework
* [Sweetalert2](https://sweetalert2.github.io/) - Replacement for javascript popup boxes
* [Pusher WebSocket](https://pusher.com/channels) - Realtime features to your apps.
  1) Pusher WebSocket digunakan untuk menerima data realtime donasi & pembayaran (invoice)
* [Payment Gateway](https://tripay.co.id) - Payment Gateway
* Pure css & vanilla js

#### Fitur

* QRIS Payment (hanya mendukung qris payment)
* Stream Overlay :
  1) Donate Notification : with Text-to-Speech, gif, and custom notification sound.
  2) Running Text Contributors
* Social Media links
* Contributors History

#### Installation
Berhubung ([Kyaaaa-PHP](https://github.com/naufkia/kyaaaa-php)) framework belum support database migration, jadi harus import database secara manual.

1. `composer create-project naufkia/kyaaaa-donate-app:dev-main`
2. create `donateapp_db` database
3. import `donateapp_db.sql`
4. run this php cli (commandline): `php kyaaaa`
5. Open `http://localhost:5555` on your browser.

#### Default Credential
* Login link `http://localhost:5555/login`
* Email : `demo@demo.com`
* Password : `demo`

#### Buy me a coffe
[!["Buy Me A Coffee"](https://nauf.space/orange_img.webp)](https://nauf.space/donate)
