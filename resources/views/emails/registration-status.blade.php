<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Status Pendaftaran</title>
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
        .status-box { border-radius:6px; padding:14px 18px; margin:24px 0; font-size:14px; border-left:4px solid; }
        .status-box.diterima { background:#E7F4ED; border-color:#1F8A5B; color:#155742; }
        .status-box.ditolak { background:#FBEAEA; border-color:#C0392B; color:#8C2A22; }
        .status-box.perlu_revisi { background:#FBF3DE; border-color:#C8962A; color:#8A6515; }
        .notes-box { background:#FBF8F1; border:1px solid #EAE1CE; border-radius:8px; padding:16px 20px; margin:20px 0; font-size:14px; line-height:1.65; color:#2E3A33; }
        .notes-box .label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#838C82; margin-bottom:8px; }
        .footer { background:#F6F1E6; padding:24px 40px; text-align:center; font-size:12px; color:#838C82; border-top:1px solid #EAE1CE; }
        .footer a { color:#155742; text-decoration:none; }
    </style>
</head>
<body>
@php
    $statusText = [
        'diterima'     => 'Diterima',
        'ditolak'      => 'Ditolak',
        'perlu_revisi' => 'Perlu Revisi',
    ][$registration->status] ?? $registration->status;

    $statusMessage = [
        'diterima'     => 'Alhamdulillah, pendaftaran putra-putri Anda telah diterima. Tim kami akan menghubungi Anda melalui WhatsApp untuk informasi langkah selanjutnya.',
        'ditolak'      => 'Mohon maaf, untuk saat ini pendaftaran putra-putri Anda belum dapat kami lanjutkan. Silakan hubungi kami melalui WhatsApp jika ada pertanyaan.',
        'perlu_revisi' => 'Ada beberapa dokumen/data yang perlu Anda perbaiki sebelum pendaftaran dapat diproses lebih lanjut. Silakan lihat catatan dari tim kami di bawah ini.',
    ][$registration->status] ?? 'Status pendaftaran Anda telah diperbarui.';
@endphp
<div class="wrap">
    <div class="header">
        <h1>AL MANAR</h1>
        <p>Yayasan · Kota Bekasi</p>
    </div>

    <div class="body">
        <span class="badge">{{ $registration->school?->name ?? 'AL MANAR' }}</span>

        <h2 style="font-size:20px;font-weight:700;margin:0 0 8px;">Update Status Pendaftaran</h2>
        <p style="font-size:15px;line-height:1.65;color:#586259;margin:0 0 4px;">
            Assalamu'alaikum, kami informasikan perkembangan pendaftaran putra-putri Anda di
            <strong>{{ $registration->school?->name ?? 'AL MANAR' }}</strong>.
        </p>

        <div class="nomor">
            <div class="label">Nomor Pendaftaran</div>
            <div class="value">{{ $registration->registration_number }}</div>
        </div>

        <p style="font-size:14px;color:#586259;margin:0 0 4px;"><strong>Nama Calon Siswa:</strong> {{ $registration->student_name }}</p>

        <div class="status-box {{ $registration->status }}">
            <strong>Status: {{ $statusText }}</strong><br>
            {{ $statusMessage }}
        </div>

        @if($registration->notes)
        <div class="notes-box">
            <div class="label">Catatan dari Tim Kami</div>
            {{ $registration->notes }}
        </div>
        @endif

        <p style="font-size:13px;color:#838C82;line-height:1.7;margin:20px 0 0;">
            Jika ada pertanyaan, silakan hubungi kami melalui WhatsApp atau kunjungi langsung kantor kami.<br>
            Jazakumullahu Khairan.
        </p>
    </div>

    <div class="footer">
        <strong style="color:#2E3A33;">Yayasan AL MANAR Kota Bekasi</strong><br>
        {{ $registration->school?->address ?? 'Kota Bekasi' }}<br>
        <a href="https://almanarkotabks.sch.id">almanarkotabks.sch.id</a>
        &nbsp;·&nbsp;
        <a href="mailto:ppdb@almanarkotabks.sch.id">ppdb@almanarkotabks.sch.id</a>
    </div>
</div>
</body>
</html>
