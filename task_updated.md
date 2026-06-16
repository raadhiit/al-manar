# Update Log — Sesi Perubahan Frontend Publik

## 1. Modal PPDB di Homepage
- `resources/views/home.blade.php` — tambah modal pop-up PPDB yang muncul otomatis setiap halaman `/` dimuat/reload, kondisional `$sdit?->is_ppdb || $tkit?->is_ppdb`.
- Modal di-center pakai `position:fixed;top:50%;left:50%;transform:translate(-50%,-50%)` (independen dari layout flex parent agar selalu center di semua kondisi).
- Bisa ditutup via tombol X, klik backdrop, atau tombol Esc (Alpine.js `x-data`, `x-show`, `@keydown.escape.window`).
- CSS transisi baru di `resources/css/app.css`: `.am-modal-backdrop-*` dan `.am-modal-card-*` (fade + scale, konsisten dengan pola `.hero-fade-*` yang sudah ada).

## 2. Program MDTA (Madrasah Diniyah Takmiliyah Awaliyah)
Diputuskan MDTA **tidak** dibuat sebagai school/jenjang baru di DB (tidak ada PPDB/role/registrasi terpisah), tapi sebagai halaman statis di bawah SDIT — mengikuti pola `portal/kurikulum.blade.php`.

- Route baru: `sdit.mdta` → `/sdit/mdta` (`routes/web.php`).
- Controller: `PublicController::sditMdta()` — return view statis, tanpa query DB.
- View baru: `resources/views/sdit/mdta.blade.php` — isi: tentang MDTA, visi & misi, mata pelajaran pokok, keadaan kelembagaan (SDM, sarana, waktu belajar, koordinasi lembaga), dasar hukum, CTA daftar SDIT. Konten diambil dari `PROFIL MDTA ALMANAR.pdf`.
- Navbar: tambah item "Program MDTA" di dropdown "Sekolah" (`resources/views/components/nav-bar.blade.php`).
- Homepage: tambah banner highlight MDTA di `home.blade.php`, setelah section "Unit Pendidikan" (SDIT/TKIT cards) — short description + CTA "Pelajari Program MDTA" ke `/sdit/mdta`.

## 3. Google Maps — Footer & Halaman Kontak
Pakai **Google Maps Embed iframe** (`?q=lat,lng&output=embed`) — tanpa API key, gratis, langsung jalan di hosting manapun tanpa konfigurasi tambahan.

- Lokasi: TK-SD Islam Terpadu AL MANAR, koordinat `-6.2102725, 107.0270297` (resolve dari https://maps.app.goo.gl/UfLustCrScSDQbp87).
- **Footer** (`resources/views/components/site-footer.blade.php`): peta ditaruh sebagai baris/strip tersendiri full-width di bawah grid kolom (Brand, Sekolah, Informasi, PPDB) — bukan dicrop ke dalam kolom brand, supaya semua kolom tetap sejajar rapi. Bentuk: thumbnail peta kecil (120×80px) + nama lokasi + tombol "Buka di Maps", responsif (`flex-wrap`).
- **Kontak** (`resources/views/kontak.blade.php`): tambah section "Lokasi Kami" — peta lebih besar (`aspect-ratio:16/9`, full width, responsif otomatis), dibungkus card + caption alamat + tombol "Buka di Google Maps".

## 4. Social Media Links di Footer
`resources/views/components/site-footer.blade.php`:
- Instagram → `https://www.instagram.com/sdit_almanar/`
- Facebook **diganti jadi TikTok** (ikon + link) → `https://www.tiktok.com/@sditalmanar_?brid=YWdncwE1YLLaX_hABA0ouncE1ilF`
- YouTube → `https://www.youtube.com/@sdialmanarkotabekasi2383/featured`
- Semua link sosial media dibuka di tab baru (`target="_blank" rel="noopener noreferrer"`).

---

**Belum dicommit** — semua perubahan di atas masih di working tree, menunggu instruksi commit dari developer.
