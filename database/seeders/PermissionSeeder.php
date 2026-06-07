<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $operatorPermissions = [
            // Berita
            'ViewAny:News', 'View:News', 'Create:News', 'Update:News',
            'Delete:News', 'DeleteAny:News',

            // Kegiatan
            'ViewAny:Activity', 'View:Activity', 'Create:Activity', 'Update:Activity',
            'Delete:Activity', 'DeleteAny:Activity',

            // Prestasi
            'ViewAny:Achievement', 'View:Achievement', 'Create:Achievement', 'Update:Achievement',
            'Delete:Achievement', 'DeleteAny:Achievement',

            // Pendaftaran (tidak bisa create/force-delete — datang dari form publik)
            'ViewAny:Registration', 'View:Registration', 'Update:Registration',

            // Kalender Pendidikan
            'ViewAny:AcademicCalendar', 'View:AcademicCalendar',
            'Create:AcademicCalendar', 'Update:AcademicCalendar',
            'Delete:AcademicCalendar', 'DeleteAny:AcademicCalendar',

            // Pengumuman
            'ViewAny:Announcement', 'View:Announcement', 'Create:Announcement', 'Update:Announcement',
            'Delete:Announcement', 'DeleteAny:Announcement',

            // Download
            'ViewAny:Download', 'View:Download', 'Create:Download', 'Update:Download',
            'Delete:Download', 'DeleteAny:Download',

            // Sekolah (read-only)
            'ViewAny:School', 'View:School',
        ];

        $guruPermissions = [
            'ViewAny:Rpp', 'View:Rpp', 'Create:Rpp', 'Update:Rpp', 'Delete:Rpp',
        ];

        Role::findByName('operator_sdit')->syncPermissions($operatorPermissions);
        Role::findByName('operator_tkit')->syncPermissions($operatorPermissions);
        Role::findByName('guru')->syncPermissions($guruPermissions);

        // super_admin: Shield handle via Gate bypass, tidak perlu assign manual
    }
}
