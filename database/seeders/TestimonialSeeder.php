<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Seed contoh testimoni yang realistis (bukan "Lorem ipsum" / "Test User").
     * Sengaja dibuat is_published => false — admin wajib meninjau dan
     * mempublikasikan manual satu-satu lewat Filament sebelum tampil ke publik.
     */
    public function run(): void
    {
        $sdit = School::where('slug', 'sdit')->first();
        $tkit = School::where('slug', 'kelompok-bermain-raudhatul-athfal')->first();

        $testimonials = [
            [
                'school_id' => $sdit?->id,
                'parent_name' => 'Siti Nurhasanah',
                'quote' => 'Anak saya kelas 2, alhamdulillah udah hafal juz 30 setengahnya. Yang bikin saya seneng itu gurunya sabar banget ngajarinnya, gak dipaksa harus cepet, tapi anaknya jadi suka sendiri sama Al-Quran. Adab makan sama salim ke orang tua juga jadi lebih rajin sejak sekolah di sini.',
                'display_order' => 1,
            ],
            [
                'school_id' => $tkit?->id,
                'parent_name' => 'Ahmad Fauzi',
                'quote' => 'Awalnya anak saya susah banget lepas dari saya pas anter sekolah, nangis terus. Tapi bu gurunya telaten banget ngadepinnya, sekarang malah semangat kalo mau berangkat. Fasilitas mainnya juga lumayan lengkap buat ukuran KB.',
                'display_order' => 2,
            ],
            [
                'school_id' => $sdit?->id,
                'parent_name' => 'Ratna Dewi Kusuma',
                'quote' => 'Yang paling saya suka dari SDIT Al Manar itu laporan perkembangan anak jelas, tiap semester ada rapor tahfizh sama akademik terpisah jadi keliatan progresnya di mana. Anak saya juga jadi lebih pede ngomong di depan kelas, dulu pemalu banget.',
                'display_order' => 3,
            ],
            [
                'school_id' => $tkit?->id,
                'parent_name' => 'Bambang Wijaya',
                'quote' => 'Dua anak saya sekolah di sini, yang gede udah lanjut ke SDIT-nya. Enaknya satu yayasan jadi gak ribet urus pindah-pindah sekolah. Gurunya kenal betul karakter tiap anak, bukan cuma ngajar doang.',
                'display_order' => 4,
            ],
            [
                'school_id' => $sdit?->id,
                'parent_name' => 'Yuni Kartika',
                'quote' => 'Sempat mikir-mikir mau daftarin ke sini karena lokasinya agak jauh dari rumah, tapi setelah setahun gak nyesel sama sekali. Ekskul pramukanya aktif, anak saya ikut lomba tahfizh kecamatan kemarin walau belum menang tapi pengalamannya dapet.',
                'display_order' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create([
                ...$testimonial,
                'is_published' => false,
            ]);
        }
    }
}
