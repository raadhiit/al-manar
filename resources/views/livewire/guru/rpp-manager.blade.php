<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold">RPP Saya</h1>
        <button wire:click="openCreate" class="bg-amber-600 text-white px-4 py-2 rounded">
            Upload RPP
        </button>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Mata Pelajaran</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Semester</th>
                    <th class="px-4 py-2">Tahun Ajaran</th>
                    <th class="px-4 py-2">File</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rpps as $rpp)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $rpp->subject }}</td>
                        <td class="px-4 py-2">{{ $rpp->class }}</td>
                        <td class="px-4 py-2">Semester {{ $rpp->semester }}</td>
                        <td class="px-4 py-2">{{ $rpp->academic_year }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('guru-rpp.download', $rpp) }}" class="text-blue-600 underline">
                                {{ $rpp->original_filename }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-right space-x-2">
                            <button wire:click="edit({{ $rpp->id }})" class="text-amber-600">Edit</button>
                            <button wire:click="delete({{ $rpp->id }})" wire:confirm="Hapus RPP ini?" class="text-red-600">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada RPP yang diunggah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
                <h2 class="font-semibold mb-4">{{ $editingId ? 'Edit RPP' : 'Upload RPP' }}</h2>

                <form wire:submit="save" class="space-y-3">
                    <div>
                        <label class="block text-sm mb-1">Mata Pelajaran</label>
                        <input type="text" wire:model="subject" class="w-full border rounded px-3 py-2">
                        @error('subject') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Kelas</label>
                        <input type="text" wire:model="class" placeholder="Contoh: 1A" class="w-full border rounded px-3 py-2">
                        @error('class') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Semester</label>
                        <select wire:model="semester" class="w-full border rounded px-3 py-2">
                            <option value="">-- Pilih --</option>
                            <option value="1">Semester 1 (Ganjil)</option>
                            <option value="2">Semester 2 (Genap)</option>
                        </select>
                        @error('semester') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Tahun Ajaran</label>
                        <input type="text" wire:model="academic_year" placeholder="Contoh: 2025/2026" class="w-full border rounded px-3 py-2">
                        @error('academic_year') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">File RPP (PDF/DOC/DOCX, maks 10MB)</label>
                        <input type="file" wire:model="file" class="w-full">
                        <div wire:loading wire:target="file" class="text-sm text-gray-500">Mengunggah...</div>
                        @error('file') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2">Batal</button>
                        <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
