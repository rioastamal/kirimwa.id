<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Kirim pesan WhatsApp tanpa menyimpan nomor. Cepat dan mudah, tanpa install aplikasi.">
    <meta name="keywords" content="kirim whatsapp, chat whatsapp, whatsapp">
    <title>Kirim Pesan WhatsApp Tanpa Simpan Nomor - KirimWA.id</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <style>
        html {
            height: 100%;
        }
        body {
            color: #333;
            font-family: "Helvetica Neue", sans-serif;
            position: relative;
            min-height: 100%;
        }
        .header {
            background-color: #1ebea5;
            box-sizing: border-box;
            color: white;
        }
        .header h1, .header h2 {
            font-size: 1.4em;
            font-weight: normal;
            padding: 0 0.5em;
        }
        .header h2 {
            font-size: 1.1em;

        }
        .content {
            width: 100%;
            box-sizing: border-box;
            padding: 1em 0.5em;
        }
        .pure-form button[type="submit"].wa-button {
            background-color: #006256;
            height: 2.8em;
            letter-spacing: 2px;
            margin-top: 0;
        }
        .phone {
            font-size: 1.5em;
        }
        .footer {
            font-size: 0.8em;
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 0.8rem;
            background-color: #efefef;
            text-align: center;
        }
        .footer a {
            text-decoration: none;
            border-bottom: 1px dotted #ccc;
            color: inherit;
        }
        div.or-quick-access {
            margin-top: 1em;
            text-align: center;
        }
        .quick-access {
            font-size: 0.9em;
        }
        .quick-access .example {
            display: block;
            background-color: #f1f1f1;
            padding: 10px 12px;
            font-size: 1.1em;
            text-align: center;
        }
        input[type="text"].error {
            border: 1px solid red;
        }
        a, a:visited {
            text-decoration: none;
            color: #c60000;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="pure-g header">
            <div class="pure-u-1-1">
                <h1>Kirim Pesan WhatsApp Tanpa Simpan Nomor</h1>
            </div>
            <div class="pure-u-1-1">
                <h2>Cepat dan mudah. Tanpa install aplikasi.</h2>
            </div>
        </div>

        <div class="content">
            <form id="frmWhatsApp" class="pure-form pure-form-stacked" method="GET" action="whatsapp://send">
                <div class="pure-g">
                    <div class="pure-u-1">
                        <label class="pure-input-1" for="phone">Nomor WhatsApp Penerima</label>
                        <input class="pure-input-1 phone required" id="phone" name="phone" type="text" placeholder="Contoh: 081234567890" value="<?= htmlentities($phone); ?>">
                    </div>
                </div>

                <div class="pure-g">
                    <div class="pure-u-1">
                        <button id="submit-btn" type="submit" class="pure-button pure-button-primary pure-input-1 wa-button">Kirim</button>
                    </div>
                </div>
            </form>

            <div class="pure-g">
                <div class="pure-u-1">
                    <div class="quick-access">
                    <p>Untuk cara lebih cepat ketik di browser perangkat Android atau iOS anda
                        (Google Chrome / UCBrowser / Safari / lainnya) alamat URL
                        kirimwa.id/<strong>nomor_tujuan</strong>. Lihat contoh di bawah atau <a target="_blank" href="https://github.com/rioastamal/kirimwa.id">dokumentasi</a>.<p>

                    <p class="example"><a id="example-link" href="https://kirimwa.id/081234567890">kirimwa.id/081234567890</a></p>
                </div>
            </div>
        </div>

        <div class="pure-g">
            <div class="pure-u-1">
                <div class="footer">
                    <span>KirimWA.id &copy; 2018 - <?= date('Y'); ?> <a href="https://rioastamal.net/">Rio Astamal</a></span><br>
                </div>
            </div>
        </div>
    </div>
<script>
/**
 * Simple class to wrap functions for opening WhatsApp application
 * in Android/iOS application.
 *
 * @author Rio Astamal <rio@rioastamal.net>
 */
var KirimWA = {};
var $ = function(el) { return document.getElementById(el); }

/**
 * @property string Country code accepted by Whatsapp
 */
KirimWA.countryCode = '<?= $countryCode ?>';

/**
 * @param string phoneNumber Destination phone number defined by user
 * @return string
 */
KirimWA.formatPhoneNumber = function(phoneNumber)
{
    if (phoneNumber.length === 0) {
        return '';
    }
    if (phoneNumber.indexOf('+') >= 0) {
        return phoneNumber.replace(/[^0-9]/g, '');
    }
    return this.countryCode + phoneNumber.replace(/[^0-9]/g, '').replace(/^620|^62|^0/, '');
};

/**
 * @param string phoneNumber Destination phone number
 * @return string URL Scheme protocol accepted by WhatsApp
 */
KirimWA.buildUrl = function(phoneNumber, message)
{
    phoneNumber = this.formatPhoneNumber(phoneNumber);
    if (message === undefined) {
        return 'whatsapp://send?phone=' + phoneNumber;
    }
    return 'whatsapp://send?phone=' + phoneNumber + '&text=' + message;
};

/**
 * Open WhatsApp application by calling the application specific
 * protocol.
 *
 * @param string phoneNumber
 * @param string message
 * @return void
 */
KirimWA.openWhatsApp = function(phoneNumber, message)
{
    window.location.href = this.buildUrl(phoneNumber, message);
}

/**
 * Prevent default behavior of Button Submit.
 *
 * @return boolean
 */
$('submit-btn').onclick = function()
{
    var phoneEl = document.getElementById('phone');
    var phone = phoneEl.value;
    if (phone.length === 0) {
        phoneEl.className = phoneEl.className.replace(/error/, '');
        phoneEl.className = phoneEl.className + ' error';

        return false;
    }

    phoneEl.className = phoneEl.className.replace(/error/, '');
    KirimWA.openWhatsApp(phone);

    return false;
};

/**
 * Update example based on number typed.
 *
 * @return void
 */
$('phone').onkeyup = function(e)
{
    var value = this.value.replace(/[^0-9\-]/g, '');
    if (value == '') {
        value = '081234567890';
    }
    var link = 'kirimwa.id/' + value;
    $('example-link').href = 'https://' + link;
    $('example-link').innerHTML = link;
}

/**
 * @return void
 */
window.onload = function()
{
    if (window.location.hash.length === 0) {
        return false;
    }

    phone = window.location.hash.replace(/\#/g, '');
    $('phone').value = KirimWA.formatPhoneNumber(phone);
}
</script>
</body>
</html>