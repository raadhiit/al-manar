<div class="max-w-sm mx-auto mt-16 bg-white p-8 rounded-lg shadow">
    <h1 class="text-xl font-semibold mb-6 text-center">Login Guru</h1>

    <form wire:submit="login" class="space-y-4">
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded px-3 py-2">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm mb-1">Password</label>
            <input type="password" wire:model="password" class="w-full border rounded px-3 py-2">
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" wire:model="remember">
            Ingat saya
        </label>

        <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded">
            Masuk
        </button>
    </form>
</div>
