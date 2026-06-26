<x-layouts.app navActive="galeri" title="Galeri" description="Galeri foto dan video kegiatan SDIT dan TKIT AL MANAR Kota Bekasi.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <x-section-header
                eyebrow="Dokumentasi"
                title="Galeri AL MANAR"
                lead="Foto dan video dari berbagai kegiatan, momen, dan pencapaian sekolah."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filter jenjang --}}
            @php
                $filters = ['' => 'Semua', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'TKIT AL MANAR'];
            @endphp
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach($filters as $key => $label)
                    @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                    <a
                        href="{{ $key ? route('galeri.index', ['jenjang' => $key]) : route('galeri.index') }}"
                        class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>

            <div x-data="{ lightbox: null }">
            @if($galleries->isNotEmpty())
                <div style="display:flex;flex-direction:column;gap:4px;">
                    @foreach($galleries as $album)
                        <div
                            x-data="{ open: false }"
                            class="am-reveal"
                            style="background:#fff;border:1px solid var(--border-default);border-radius:var(--radius-xl);overflow:hidden;"
                        >
                            {{-- Album header (toggle) --}}
                            <button
                                @click="open = !open"
                                style="width:100%;display:flex;align-items:center;gap:18px;padding:20px 24px;background:none;border:none;cursor:pointer;text-align:left;"
                            >
                                {{-- Cover --}}
                                <div style="width:72px;height:72px;border-radius:var(--radius-lg);overflow:hidden;flex-shrink:0;background:var(--green-100);">
                                    @if($album->cover_path)
                                        <img src="{{ Storage::url($album->cover_path) }}" alt="{{ $album->title }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Info --}}
                                <div style="flex:1;min-width:0;">
                                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:5px;">
                                        <span style="font-family:var(--font-display);font-weight:600;font-size:var(--text-lg);color:var(--ink-900);">{{ $album->title }}</span>
                                        @if($album->school)
                                            <x-badge
                                                :tone="$album->school->level === 'sdit' ? 'sdit' : 'tkit'"
                                                variant="soft"
                                                size="sm"
                                            >{{ $album->school->level === 'sdit' ? 'SDIT' : 'TKIT' }}</x-badge>
                                        @endif
                                        @if($album->type)
                                            <x-badge tone="cream" variant="soft" size="sm">{{ Str::title($album->type) }}</x-badge>
                                        @endif
                                    </div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-400);display:flex;gap:14px;flex-wrap:wrap;">
                                        <span>{{ $album->items->count() }} item</span>
                                        @if($album->description)
                                            <span style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:400px;">{{ $album->description }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Chevron --}}
                                <svg
                                    width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="var(--ink-400)" stroke-width="2"
                                    style="flex-shrink:0;transition:transform .2s;"
                                    :style="open ? 'transform:rotate(180deg)' : ''"
                                >
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </button>

                            {{-- Items grid (collapsible) --}}
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                style="padding:0 24px 24px;border-top:1px solid var(--border-subtle);"
                                x-cloak
                            >
                                @if($album->items->isNotEmpty())
                                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px;margin-top:20px;">
                                        @foreach($album->items as $item)
                                            @if($item->type === 'video' && $item->youtube_url)
                                                @php
                                                    preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{11})/', $item->youtube_url, $m);
                                                    $ytId = $m[1] ?? null;
                                                @endphp
                                                <a
                                                    href="{{ $item->youtube_url }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    style="position:relative;display:block;border-radius:var(--radius-md);overflow:hidden;aspect-ratio:16/9;background:#000;text-decoration:none;"
                                                >
                                                    @if($ytId)
                                                        <img
                                                            src="https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg"
                                                            alt="{{ $item->caption }}"
                                                            style="width:100%;height:100%;object-fit:cover;opacity:.8;"
                                                            loading="lazy"
                                                        >
                                                    @endif
                                                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                                        <div style="background:rgba(0,0,0,.55);border-radius:50%;width:46px;height:46px;display:flex;align-items:center;justify-content:center;">
                                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                                        </div>
                                                    </div>
                                                    @if($item->caption)
                                                        <div style="position:absolute;bottom:0;left:0;right:0;padding:8px 10px;background:linear-gradient(transparent,rgba(0,0,0,.7));font-family:var(--font-sans);font-size:var(--text-xs);color:#fff;">{{ $item->caption }}</div>
                                                    @endif
                                                </a>
                                            @elseif($item->path)
                                                <div
                                                    @click="lightbox = { src: '{{ Storage::url($item->path) }}', caption: '{{ addslashes($item->caption ?? $album->title) }}' }"
                                                    style="border-radius:var(--radius-md);overflow:hidden;aspect-ratio:4/3;background:var(--cream-200);cursor:pointer;"
                                                >
                                                    <img
                                                        src="{{ Storage::url($item->path) }}"
                                                        alt="{{ $item->caption ?? $album->title }}"
                                                        style="width:100%;height:100%;object-fit:cover;"
                                                        loading="lazy"
                                                    >
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p style="margin-top:20px;font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-400);font-style:italic;">
                                        Album ini belum memiliki foto atau video.
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px;">
                    {{ $galleries->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada album galeri @if($jenjang) untuk jenjang ini @endif.
                    </p>
                </div>
            @endif

            {{-- Lightbox modal --}}
            <div x-show="lightbox" x-cloak @keydown.escape.window="lightbox = null" style="position:fixed;inset:0;z-index:999;">
                {{-- Backdrop --}}
                <div
                    x-show="lightbox"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="lightbox = null"
                    style="position:fixed;inset:0;background:rgba(0,0,0,.9);"
                ></div>

                {{-- Centered content --}}
                <div
                    x-show="lightbox"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    style="position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);max-width:90vw;max-height:85vh;display:flex;flex-direction:column;align-items:center;gap:14px;"
                >
                    <button
                        @click="lightbox = null"
                        aria-label="Tutup"
                        style="position:absolute;top:-44px;right:0;background:none;border:none;cursor:pointer;color:#fff;padding:8px;"
                    >
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                    <img :src="lightbox?.src" :alt="lightbox?.caption" style="max-width:90vw;max-height:75vh;object-fit:contain;border-radius:var(--radius-md);display:block;">
                    <p x-show="lightbox?.caption" x-text="lightbox?.caption" style="color:#fff;font-family:var(--font-sans);font-size:var(--text-sm);text-align:center;margin:0;"></p>
                </div>
            </div>

            </div>

        </div>
    </section>

</x-layouts.app>
