<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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

            // Kalender & Agenda
            'ViewAny:CalendarEvent', 'View:CalendarEvent',
            'Create:CalendarEvent', 'Update:CalendarEvent',
            'Delete:CalendarEvent', 'DeleteAny:CalendarEvent',

            // Pengumuman
            'ViewAny:Announcement', 'View:Announcement', 'Create:Announcement', 'Update:Announcement',
            'Delete:Announcement', 'DeleteAny:Announcement',

            // Download
            'ViewAny:Download', 'View:Download', 'Create:Download', 'Update:Download',
            'Delete:Download', 'DeleteAny:Download',

            // Galeri
            'ViewAny:Gallery', 'View:Gallery', 'Create:Gallery', 'Update:Gallery',
            'Delete:Gallery', 'DeleteAny:Gallery',

            // Sekolah (read-only)
            'ViewAny:School', 'View:School',
        ];

        $guruPermissions = [
            'ViewAny:Rpp', 'View:Rpp', 'Create:Rpp', 'Update:Rpp', 'Delete:Rpp',
        ];

        $schoolManagementPermissions = [
            'Create:School', 'Update:School', 'Delete:School', 'DeleteAny:School',
            'Restore:School', 'RestoreAny:School', 'ForceDelete:School', 'ForceDeleteAny:School',
            'Replicate:School', 'Reorder:School',
        ];

        // Create semua permissions dulu
        $allPermissions = array_merge($operatorPermissions, $guruPermissions, $schoolManagementPermissions);
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        Role::findByName('operator_sdit')->syncPermissions($operatorPermissions);
        Role::findByName('operator_tkit')->syncPermissions($operatorPermissions);
        Role::findByName('guru')->syncPermissions($guruPermissions);

        // admin: semua permission kecuali manajemen Role (Filament Shield)
        $adminPermissions = Permission::where('name', 'not like', '%:Role')->pluck('name');
        Role::findByName('admin')->syncPermissions($adminPermissions);

        // super_admin: define_via_gate di config/filament-shield.php false,
        // jadi Gate::before tidak aktif — semua permission harus di-assign manual
        Role::findByName('super_admin')->syncPermissions(Permission::all());
    }
}
