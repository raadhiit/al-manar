<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Registration $registration) {}

    public function envelope(): Envelope
    {
        $schoolName = $this->registration->school?->name ?? 'AL MANAR';

        $subjectByStatus = [
            'diterima'     => 'Pendaftaran Diterima',
            'ditolak'      => 'Pendaftaran Tidak Dapat Dilanjutkan',
            'perlu_revisi' => 'Perlu Revisi Dokumen Pendaftaran',
        ];

        $label = $subjectByStatus[$this->registration->status] ?? 'Update Status Pendaftaran';

        return new Envelope(
            subject: $label . ' - ' . $schoolName . ' - ' . $this->registration->registration_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-status',
        );
    }
}
