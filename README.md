# BCA Denpasar CiNEMA

[![Build Status](https://github.com/ianriizky/bcadenpasar-cinema/workflows/test/badge.svg)](https://github.com/ianriizky/bcadenpasar-cinema/actions)
[![Quality Score](https://img.shields.io/scrutinizer/g/ianriizky/bcadenpasar-cinema.svg?style=flat)](https://scrutinizer-ci.com/g/ianriizky/bcadenpasar-cinema)
[![Coverage Status](https://coveralls.io/repos/github/ianriizky/bcadenpasar-cinema/badge.svg)](https://coveralls.io/github/ianriizky/bcadenpasar-cinema)
[![Latest Stable Version](https://poser.pugx.org/ianriizky/bcadenpasar-cinema/v/stable.svg)](https://packagist.org/packages/ianriizky/bcadenpasar-cinema)
[![Total Downloads](https://poser.pugx.org/ianriizky/bcadenpasar-cinema/d/total.svg)](https://packagist.org/packages/ianriizky/bcadenpasar-cinema)
[![Software License](https://poser.pugx.org/ianriizky/bcadenpasar-cinema/license.svg)](https://packagist.org/packages/ianriizky/bcadenpasar-cinema)

**BCA Denpasar Chatbot** adalah sistem informasi untuk mengedukasi serta memonitoring pencapaian CIN (Customer Identification Number) baru di BCA KCU Denpasar menggunakan PHP dan Laravel Framework.

Source code ini sudah dilengkapi dengan *unit test* menggunakan [phpunit](https://phpunit.de).

## Prasyarat

- Laravel Framework ^9.0
- PHP ^8.0.15
- Node.js ^16.13.2
- Composer ^2.0
- MySQL ^5.7.36

## Instalasi

Untuk menginstal *repository* ini di lokal anda, jalankan perintah di bawah ini melalui terminal.

```bash
composer create-project ianriizky/bcadenpasar-cinema
```

Packagist: https://packagist.org/packages/ianriizky/bcadenpasar-cinema

## Menyiapkan *Database*
Jalankan perintah di bawah ini untuk melakukan proses migrasi *database*.

```bash
php artisan migrate
```

## Testing

Jalankan perintah di bawah ini untuk menjalankan *test script* melalui [pest](https://pestphp.com/).

```bash
./vendor/bin/pest
```

## *Changelog*

Lihat [`changelog.md`](CHANGELOG.md) untuk informasi lebih lanjut mengenai perubahan yang terjadi pada *repository* ini.

## Licensi

*Repository* ini menggunakan lisensi MIT License (MIT). Lihat [`license.md`](LICENSE.md) untuk informasi selanjutnya.

## Kreator

- [@ianriizky](https://github.com/ianriizky)
