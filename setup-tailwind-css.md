# Panduan Integrasi Tailwind CSS v4 di CodeIgniter 4

Langkah-langkah berikut merupakan penyesuaian untuk versi terbaru **Tailwind CSS v4**. Pada versi ini, prosesnya jauh lebih simpel karena Tailwind sudah tidak memerlukan file konfigurasi `tailwind.config.js` secara wajib (otomatis mendeteksi file).

### 1. Install via Terminal

Pastikan Anda berada di direktori root project CI4, lalu jalankan perintah berikut:

```bash
npm install tailwindcss @tailwindcss/cli

```

### 2. Buat File CSS Input

Buat folder bernama `src` (sejajar dengan folder `app` dan `public`), kemudian buat file `input.css` di dalamnya.

**Lokasi:** `src/input.css`

Isi file tersebut dengan baris berikut:

```css
@import "tailwindcss";

```

> *Catatan: Di v4, directive ini sudah otomatis mencakup base, components, dan utilities.*

### 3. Jalankan CLI Build (Penyesuaian Path CI4)

Ini bagian paling krusial. Anda harus mengarahkan output build ke folder `public` milik CodeIgniter agar dapat diakses oleh browser.

Jalankan perintah ini di terminal:

```bash
npx @tailwindcss/cli -i ./src/input.css -o ./public/css/style.css --watch

```

### 4. Hubungkan ke Layout CI4

Buka file layout utama Anda (misalnya: `app/Views/layouts/main.php`), lalu panggil file CSS hasil build tersebut di dalam tag `<head>`:

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

```

---

### Perbedaan Penting untuk CI4 (Tailwind v4):

* **Deteksi File Otomatis**: Di Tailwind v4, CLI akan otomatis men-scan folder `app/Views` dan file `.php` Anda tanpa perlu melakukan pengaturan `content` di file JavaScript lagi.
* **Folder Public**: Pastikan parameter output `-o` selalu diarahkan ke `./public/css/...`. Hal ini dikarenakan folder `src` atau `app` tidak bisa diakses langsung oleh browser demi alasan keamanan.
* **Development**: Biarkan terminal yang menjalankan perintah `--watch` tetap terbuka saat Anda sedang melakukan coding. Setiap kali Anda menambahkan class Tailwind di view, file `style.css` akan diperbarui secara otomatis.

### Cara Cepat (Shortcut Script)

Agar tidak perlu mengetik perintah panjang setiap kali ingin memulai development, buka file `package.json` dan tambahkan baris berikut di dalam bagian `"scripts"`:

```json
"scripts": {
  "dev": "npx @tailwindcss/cli -i ./src/input.css -o ./public/css/style.css --watch"
}

```

Setelah ditambahkan, selanjutnya Anda cukup menjalankan perintah:

```bash
npm run dev

```

---