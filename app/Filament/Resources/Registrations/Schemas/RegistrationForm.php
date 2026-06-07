<?php

namespace App\Filament\Resources\Registrations\Schemas;

use App\Models\School;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Status & nomor — field yang bisa diedit admin
                TextInput::make('registration_number')
                    ->label('Nomor Pendaftaran')
                    ->disabled(),

                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->disabled(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'diterima'            => 'Diterima',
                        'ditolak'             => 'Ditolak',
                        'perlu_revisi'        => 'Perlu Revisi',
                    ])
                    ->default('menunggu_verifikasi')
                    ->required(),

                DateTimePicker::make('submitted_at')
                    ->label('Tanggal Daftar')
                    ->disabled(),

                // Data calon siswa — read only
                TextInput::make('student_name')
                    ->label('Nama Calon Siswa')
                    ->disabled(),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                    ->disabled(),

                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->disabled(),

                TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->disabled(),

                TextInput::make('religion')
                    ->label('Agama')
                    ->disabled(),

                TextInput::make('previous_school')
                    ->label('Asal Sekolah')
                    ->disabled(),

                // Data orang tua — read only
                TextInput::make('father_name')
                    ->label('Nama Ayah')
                    ->disabled(),

                TextInput::make('mother_name')
                    ->label('Nama Ibu')
                    ->disabled(),

                TextInput::make('phone')
                    ->label('Nomor HP (WA)')
                    ->disabled(),

                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),

                TextInput::make('parent_job')
                    ->label('Pekerjaan Orang Tua')
                    ->disabled(),

                Textarea::make('address')
                    ->label('Alamat')
                    ->disabled()
                    ->columnSpanFull(),

                // Catatan admin — bisa diedit
                Textarea::make('notes')
                    ->label('Catatan Admin')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
