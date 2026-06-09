<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran</title>
    <style>
        body { margin:0; padding:0; background:#F4F1EA; font-family:'Segoe UI',Arial,sans-serif; color:#2E3A33; }
        .wrap { max-width:580px; margin:32px auto; background:#fff; border-radius:12px; overflow:hidden; border:1px solid #E0D5BF; }
        .header { background:#155742; padding:36px 40px; text-align:center; }
        .header h1 { margin:0; color:#FBF8F1; font-size:22px; font-weight:700; letter-spacing:-0.01em; }
        .header p { margin:8px 0 0; color:#D9AB3D; font-size:13px; letter-spacing:0.06em; text-transform:uppercase; }
        .body { padding:36px 40px; }
        .badge { display:inline-block; background:#ECF3EF; color:#155742; border:1px solid #A9CCBD; border-radius:999px; padding:6px 18px; font-size:13px; font-weight:700; letter-spacing:0.04em; margin-bottom:24px; }
        .nomor { background:#FBF8F1; border:2px dashed #D2C4A6; border-radius:10px; padding:18px 24px; margin:24px 0; text-align:center; }
        .nomor .label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; color:#838C82; margin-bottom:6px; }
        .nomor .value { font-size:26px; font-weight:700; color:#155742; letter-spacing:0.06em; }
        table.info { width:100%; border-collapse:collapse; margin:20px 0; }
        table.info td { padding:9px 0; font-size:14px; vertical-align:top; border-bottom:1px solid #EAE1CE; }
        table.info td:first-child { color:#838C82; font-weight:600; width:42%; }
        .status-box { background:#E7F4ED; border-left:4px solid #1F8A5B; border-radius:6px; padding:14px 18px; margin:24px 0; font-size:14px; color:#155742; }
        .footer { background:#F6F1E6; padding:24px 40px; text-align:center; font-size:12px; color:#838C82; border-top:1px solid #EAE1CE; }
        .footer a { color:#155742; text-decoration:none; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h1>AL MANAR</h1>
        <p>Yayasan · Kota Bekasi</p>
    </div>

    <div class="body">
        <span class="badge">{{ $registration->school?->name ?? 'AL MANAR' }}</span>

        <h2 style="font-size:20px;font-weight:700;margin:0 0 8px;">Pendaftaran Diterima</h2>
        <p style="font-size:15px;line-height:1.65;color:#586259;margin:0 0 4px;">
            Assalamu'alaikum, terima kasih telah mendaftarkan putra-putri Anda ke
            <strong>{{ $registration->school?->name ?? 'AL MANAR' }}</strong>.
        </p>
        <p style="font-size:14px;line-height:1.65;color:#838C82;margin:0;">
            Formulir pendaftaran Anda telah berhasil kami terima dan akan segera diverifikasi oleh tim kami.
        </p>

        <div class="nomor">
            <div class="label">Nomor Pendaftaran</div>
            <div class="value">{{ $registration->registration_number }}</div>
        </div>

        <p style="font-size:13px;color:#838C82;margin:0 0 20px;">
            Simpan nomor pendaftaran ini untuk memantau status pendaftaran Anda.
        </p>

        <table class="info">
            <tr>
                <td>Nama Calon Siswa</td>
                <td><strong>{{ $registration->student_name }}</strong></td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>{{ $registration->birth_place }}, {{ $registration->birth_date?->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>{{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>{{ $registration->father_name }}</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>{{ $registration->mother_name }}</td>
            </tr>
            <tr>
                <td>No. HP / WhatsApp</td>
                <td>{{ $registration->phone }}</td>
            </tr>
            <tr>
                <td>Tanggal Daftar</td>
                <td>{{ $registration->submitted_at?->translatedFormat('d F Y, H:i') }} WIB</td>
            </tr>
        </table>

        <div class="status-box">
            <strong>Status: Menunggu Verifikasi</strong><br>
            Tim kami akan menghubungi Anda melalui nomor WhatsApp yang telah didaftarkan dalam 1–3 hari kerja.
        </div>

        <p style="font-size:13px;color:#838C82;line-height:1.7;margin:0;">
            Jika ada pertanyaan, silakan hubungi kami melalui WhatsApp atau kunjungi langsung kantor kami.<br>
            Jazakumullahu Khairan.
        </p>
    </div>

    <div class="footer">
        <strong style="color:#2E3A33;">Yayasan AL MANAR Kota Bekasi</strong><br>
        {{ $registration->school?->address ?? 'Kota Bekasi' }}<br>
        <a href="https://almanar.sch.id">almanar.sch.id</a>
        &nbsp;·&nbsp;
        <a href="mailto:ppdb@almanar.sch.id">ppdb@almanar.sch.id</a>
    </div>
</div>
</body>
</html>
