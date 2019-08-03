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
        textarea.input-text {
            height: 100px;
            display: none;
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
        .custom-url-item {
            display: none;
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
            <form id="frmWhatsApp" class="pure-form pure-form-stacked" method="GET">
                <div class="pure-g">
                    <div class="pure-u-1">
                        <label class="pure-input-1" for="phone">Nomor WhatsApp Penerima</label>
                        <input required class="pure-input-1 phone required" id="phone" name="phone" type="text" placeholder="Contoh: 081234567890" value="<?= htmlentities($phone); ?>">
                    </div>
                </div>

                <div class="pure-g">
                    <div class="pure-u-1">
                        <label class="pure-checkbox" for="message-checkbox">
                            <input type="checkbox" id="message-checkbox">
                            Saya ingin menambahkan pesan teks
                        </label>
                        <textarea class="pure-input-1 input-text" placeholder="Masukkan teks anda" id="text"></textarea>
                    </div>
                </div>

                <div class="pure-g">
                    <div class="pure-u-1">
                        <button id="submit-btn" type="submit" class="pure-button pure-button-primary pure-input-1 wa-button">Kirim</button>
                    </div>
                </div>

                <div class="pure-g">
                    <div class="pure-u-1">
                        <div class="quick-access">
                        <p>Untuk cara lebih cepat ketik di browser perangkat Android atau iOS anda
                            (Google Chrome / UCBrowser / Safari / lainnya) alamat URL
                            kirimwa.id/<strong>nomor_tujuan</strong>. Lihat contoh di bawah atau <a target="_blank" href="https://github.com/rioastamal/kirimwa.id">dokumentasi</a>.</p>

                        <p class="example"><a id="example-link" href="https://kirimwa.id/081234567890">kirimwa.id/081234567890</a></p>
                        </div>
                    </div>
                </div>

                <!--
                <div class="pure-g">
                    <div class="pure-u-1">
                        <label class="pure-checkbox" for="custom-url-checkbox">
                            <input type="checkbox" id="custom-url-checkbox">
                            Saya ingin URL pendek
                        </label>
                        <div class="custom-url-item">
                            <input class="pure-input-1 custom-url required phone" id="custom-url" name="custom-url" type="text" placeholder="Contoh: toko-saya">
                        </div>
                    </div>
                </div>

                <div class="pure-g custom-url-item">
                    <div class="pure-u-1">
                        <button id="custom-url-btn" type="submit" class="pure-button pure-button-primary pure-input-1 wa-button">Buat Custom URL</button>
                    </div>
                </div>

                <div class="pure-g custom-url-item">
                    <div class="pure-u-1">
                        <div class="quick-access">
                            <p class="example">Custom URL: <a id="custom-link" href="https://kirimwa.id/081234567890">kirimwa.id/toko-saya</a></p>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="no-redirect" value="true">
                -->
            </form>
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
 * @param string message Text message defined by user
 * @return string
 */
KirimWA.formatMessage = function(message)
{
    return encodeURIComponent(message);
}

/**
 * @param string phoneNumber Destination phone number
 * @return string URL Scheme protocol accepted by WhatsApp
 */
KirimWA.buildUrl = function(phoneNumber, message)
{
    phoneNumber = this.formatPhoneNumber(phoneNumber);
    if (message === undefined || message.length === 0) {
        return 'whatsapp://send?phone=' + phoneNumber;
    }
    message = this.formatMessage(message);
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
    var phoneEl = $('phone');
    if (phoneEl.value.length === 0) {
        phoneEl.className = phoneEl.className.replace(/error/, '');
        phoneEl.className = phoneEl.className + ' error';

        return false;
    }

    phoneEl.className = phoneEl.className.replace(/error/, '');
    KirimWA.openWhatsApp(phoneEl.value, $('text').value);

    return false;
};

/**
 * Update example link based on value of input phone and message.
 *
 * @return void
 */
function updateExampleLink()
{
    var phone = $('phone').value.replace(/[^0-9\-]/g, '');
    var message = $('text').value.replace(/ /g, '_').replace(/\r/g, "\n").replace(/\n/g, '--');

    if (phone == '') {
        phone = '081234567890';
    }

    var displayLink = 'kirimwa.id/' + phone;
    if (message == '') {
        $('example-link').href = 'https://' + displayLink;
        $('example-link').innerHTML = displayLink;
        return;
    }

    displayLink += ':' + message;

    $('example-link').href = 'https://' + displayLink;
    $('example-link').innerHTML = displayLink;
}

/**
 * Update example based on number typed.
 *
 * @return void
 */
$('phone').onkeyup = function()
{
    updateExampleLink();
}

/**
 * Update example based on message typed.
 *
 * @return void
 */
$('text').onkeyup = function()
{
    updateExampleLink();
}

/**
 * Toggle hide or show message input
 *
 * @return void
 */
$('message-checkbox').onclick = function()
{
    $('text').style.display = this.checked ? 'block' : 'none';
}

/**
 * Toggle hide or show custom URL input
 *
 * @return void
 *
$('custom-url-checkbox').onclick = function()
{
    var cssDisplay = this.checked ? 'block' : 'none';
    var elements = document.querySelectorAll('.custom-url-item');
    for (var i=0; i<elements.length; i++) {
        elements[i].style.display = cssDisplay;
    }
}
*/

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