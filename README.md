# Tentang KirimWA.id

KirimWA.id adalah sebuah layanan gratis untuk mengirimkan pesan WhatsApp tanpa
perlu menyimpan nomor kontak terlebih dahulu. Istilah yang digunakan oleh WhatsApp adalah _Click to Chat_. Anda tidak perlu menginstall aplikasi untuk mulai menggunakan KirimWA.id. Cukup buka browser lalu kunjungi alamat https://kirimwa.id pada perangkat mobile anda dan sudah dapat mulai mengirim pesan.

## Cara Menggunakan KirimWA.id

Terdapat dua cara dalam menggunakan KirimWA.id yaitu cara normal dan cara
cepat.

### 1. Cara Normal

Pada cara normal adalah dengan mengunjungi website https://kirimwa.id pada browser anda,
kemudian isi nomor tujuan kemudian klik tombil Kirim. Maka aplikasi WhatsApp
akan terbuka dan anda siap mengirim pesan.

### 2. Cara Cepat

Pada cara cepat anda cukup mengunjungi https://kirimwa.id/NOMOR_HANDPHONE pada
browser anda. Maka aplikasi WhatsApp akan terbuka dan anda siap untuk mengirim
pesan.

```
https://kirimwa.id/081234567890
```

Untuk menambahkan pesan teks secara otomatis maka setelah nomor anda perlu mengetikkan tanda `:` titik dua kemudian diikuti pesan yang ingin anda kirim.

```
https://kirimwa.id/081234567890:Halo_TokoX--Saya_ingin_melakukan_order
```

Keterangan karaker khusus.

- Tanda `_` (underscore) menggantikan spasi.
- Tanda `--` (double dash/minus) menggantikan baris baru.

## Perbedaan dengan Official WhatsApp Click to Chat

Saya membuat layanan ini sebelum munculnya domain baru yang dibuat WhatsApp yaitu https://wa.me dimana layanan ini memudahkan dalam membuat link to chat daripada sebelumnya.

Terlepas dari layanan wa.me baru tersebut berikut ini adalah perbedaannya.

1. **Lebih Cepat** - KirimWA.id tidak akan memuat halaman jika anda mengirimkan nomor pada URL. Hal ini berbeda dengan official Click to Chat dimana layanan tersebut akan tetap membuka sebuah halaman yang terdapat tombol "Chat". Impilkasinya waktu respon KirimWA.id secara teori lebih cepat.
2. **Nomor Variatif** - KirimWA.id menerima format nomor lokal atau internasional dan membolehkan adanya karakter spesial seperti "-", "+", atau spasi. Berikut URL yang dapat anda gunakan pada KirimWa.id
    - `https://kirimwa.id/081234567890`
    - `https://kirimwa.id/0812-2345-7890`
    - `https://kirimwa.id/0812 2345 7890`
    - `https://kirimwa.id/6281234567890`
    - `https://kirimwa.id/+6281234567890`
    - dan kombinasi lainnya
3. **Belum Mendukung WhatsApp Web** - KirimWA.id saat ini belum mendukung _Click to Chat_ yang terhubung ke WhatsApp web. KirimWA.id akan hanya berusaha membuka aplikasi WhatsApp yang ada pada perangkat anda.
4. **Pesan Teks Lebih Mudah** - KirimWA.id memakai karakter khusus yaitu `_` (underscore) untuk spasi dan `--` (double minus/dash) untuk baris baru sehingga lebih mudah dibaca. Contoh penggunaan.

    ```
    https://kirimwa.id/081234567890:Halo_TokoX--Saya_ingin_melakukan_order
    ```
    
    Bandingkan dengan official wa.me.
    
    ```
    https://wa.me/6281234567890?text=Halo%20TokoX%0ASaya%20%ingin%20melakukan%20order
    ```
    
    Kedua link tersebut sama-sama akan menghasilkan pesan berikut pada WhatsApp.
    
    ```
    Halo TokoX
    Saya ingin melakukan order
    ```
    
    Terlihat link dari KirimWA.id lebih mudah untuk diketik dan dibaca.

## Pembuat

KirimWA.id dibuat oleh Rio Astamal <rio@rioastamal.net>.