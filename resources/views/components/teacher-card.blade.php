@props([
    'name'        => '',
    'position'    => '',
    'photo'       => null,
    'bio'         => null,
    'isPrincipal' => false,
])

<article style="display:flex;flex-direction:column;background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);height:100%;">
    <div style="position:relative;">
        @if($photo)
            <img src="{{ $photo }}" alt="{{ $name }}" style="width:100%;height:240px;object-fit:cover;display:block;">
        @else
            <div style="width:100%;height:240px;background:var(--green-100);display:flex;align-items:center;justify-content:center;">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
        @endif
        @if($isPrincipal)
            <span style="position:absolute;top:16px;left:16px;">
                <x-badge tone="gold" variant="solid" size="md">Kepala Sekolah</x-badge>
            </span>
        @endif
    </div>

    <div style="padding:22px 24px 26px;display:flex;flex-direction:column;gap:6px;flex:1;">
        <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);">
            {{ $position }}
        </span>
        <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-xl);color:var(--ink-900);margin:0;text-wrap:balance;">
            {{ $name }}
        </h3>

        @if($bio)
            <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-500);margin:8px 0 0;">
                {{ $bio }}
            </p>
        @endif
    </div>
</article>
