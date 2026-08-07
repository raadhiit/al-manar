<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated dari nama. Jangan diubah manual kecuali perlu.'),

                Select::make('level')
                    ->options([
                        'sdit' => 'SDIT (Sekolah Dasar Islam Terpadu)',
                        'tkit' => 'TKIT (Taman Kanak-kanak Islam Terpadu)',
                    ])
                    ->required(),

                TextInput::make('principal_name')
                    ->label('Nama Kepala Sekolah'),

                TextInput::make('accreditation')
                    ->label('Akreditasi')
                    ->placeholder('Contoh: A'),

                Toggle::make('is_ppdb')
                    ->label('Buka Pendaftaran (PPDB)')
                    ->helperText('Aktifkan untuk membuka form pendaftaran online.')
                    ->required(),

                Section::make('Periode Gelombang PPDB')
                    ->description('Tampil otomatis di halaman pendaftaran. Kosongkan jika unit ini tidak memakai sistem gelombang.')
                    ->schema([
                        TextInput::make('tahun_ajaran_mulai')
                            ->label('Tahun Ajaran (tahun mulai)')
                            ->helperText('Contoh: isi 2027 untuk PPDB tahun ajaran 2027/2028. Dipakai di judul halaman, jadwal daftar ulang, dan syarat usia — jangan hanya ubah tanggal gelombang tanpa mengubah ini juga.')
                            ->numeric()
                            ->minValue(2020)
                            ->maxValue(2100)
                            ->columnSpanFull(),
                        DatePicker::make('gelombang_1_start')
                            ->label('Gelombang I — Mulai')
                            ->native(false),
                        DatePicker::make('gelombang_1_end')
                            ->label('Gelombang I — Selesai')
                            ->native(false)
                            ->afterOrEqual('gelombang_1_start'),
                        Select::make('gelombang_1_status')
                            ->label('Gelombang I — Status')
                            ->helperText('Otomatis = dihitung dari tanggal di atas (Akan Dibuka/Dibuka/Ditutup). Pilih manual untuk "Hampir Penuh" atau menutup lebih awal.')
                            ->options([
                                'hampir_penuh' => 'Hampir Penuh',
                                'ditutup' => 'Ditutup (paksa, sebelum tanggal selesai)',
                            ])
                            ->native(false)
                            ->placeholder('Otomatis dari tanggal')
                            ->columnSpanFull(),
                        DatePicker::make('gelombang_2_start')
                            ->label('Gelombang II — Mulai')
                            ->native(false),
                        DatePicker::make('gelombang_2_end')
                            ->label('Gelombang II — Selesai')
                            ->native(false)
                            ->afterOrEqual('gelombang_2_start'),
                        Select::make('gelombang_2_status')
                            ->label('Gelombang II — Status')
                            ->helperText('Otomatis = dihitung dari tanggal di atas (Akan Dibuka/Dibuka/Ditutup). Pilih manual untuk "Hampir Penuh" atau menutup lebih awal.')
                            ->options([
                                'hampir_penuh' => 'Hampir Penuh',
                                'ditutup' => 'Ditutup (paksa, sebelum tanggal selesai)',
                            ])
                            ->native(false)
                            ->placeholder('Otomatis dari tanggal')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                DatePicker::make('biaya_updated_at')
                    ->label('Biaya PPDB Terakhir Diperbarui')
                    ->helperText('Update tanggal ini setiap kali komponen/nominal biaya PPDB di halaman pendaftaran berubah, supaya calon orang tua tahu data masih berlaku.')
                    ->native(false),

                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->columnSpanFull(),

                RichEditor::make('vision')
                    ->label('Visi')
                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                    ->columnSpanFull(),

                RichEditor::make('mission')
                    ->label('Misi')
                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                    ->columnSpanFull(),

                TextInput::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel(),

                TextInput::make('email')
                    ->label('Email Sekolah')
                    ->email(),

                FileUpload::make('logo_path')
                    ->label('Logo Sekolah')
                    ->image()
                    ->disk('public')
                    ->directory('schools/logos')
                    ->imageEditor()
                    ->columnSpanFull(),

                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail Kartu Sekolah')
                    ->helperText('Foto yang muncul di kartu sekolah pada halaman beranda (bukan slider hero).')
                    ->image()
                    ->disk('public')
                    ->directory('schools/thumbnails')
                    ->imageEditor()
                    ->columnSpanFull(),

                FileUpload::make('hero_photos')
                    ->label('Foto Hero (Slider Beranda)')
                    ->helperText('Upload 3–5 foto landscape. Ditampilkan sebagai slider di halaman beranda.')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->disk('public')
                    ->directory('schools/hero')
                    ->imageEditor()
                    ->maxFiles(8)
                    ->columnSpanFull(),

                Repeater::make('fasilitas')
                    ->label('Fasilitas Sekolah')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->placeholder('Contoh: Lab Komputer')
                            ->columnSpan(2),
                        FileUpload::make('foto')
                            ->label('Foto Fasilitas')
                            ->image()
                            ->disk('public')
                            ->directory('schools/fasilitas')
                            ->imageEditor()
                            ->columnSpan(2),
                        TextInput::make('icon')
                            ->label('Emoji (opsional, muncul jika tidak ada foto)')
                            ->placeholder('Contoh: 🖥️')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Fasilitas')
                    ->collapsible()
                    ->columnSpanFull(),

                Repeater::make('eskul')
                    ->label('Ekstrakurikuler')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Eskul')
                            ->required()
                            ->placeholder('Contoh: Pramuka')
                            ->columnSpan(2),
                        FileUpload::make('foto')
                            ->label('Foto Eskul')
                            ->image()
                            ->disk('public')
                            ->directory('schools/eskul')
                            ->imageEditor()
                            ->columnSpan(2),
                        TextInput::make('kategori')
                            ->label('Kategori')
                            ->placeholder('Contoh: Kepanduan, Olahraga, Seni, Akademik')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Eskul')
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
