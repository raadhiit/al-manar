<x-layouts.app navActive="guru" title="Tenaga Pendidik" description="Profil guru dan kepala sekolah SDIT dan TKIT AL MANAR Kota Bekasi.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <x-section-header
                eyebrow="Tenaga Pendidik"
                title="Guru & Kepala Sekolah AL MANAR"
                lead="Mengenal lebih dekat para pendidik yang membimbing putra-putri Anda."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filter jenjang --}}
            @php
                $filters = ['' => 'Semua Jenjang', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'KB Raudhatul Jannah'];
            @endphp
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach($filters as $key => $label)
                    @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                    <a
                        href="{{ $key ? route('guru.index', ['jenjang' => $key]) : route('guru.index') }}"
                        class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>

            <div x-data="{ lightbox: null }">
            @if($teachers->isNotEmpty())
                <div class="am-grid-3">
                    @foreach($teachers as $teacher)
                        @php $photo = $teacher->photo_path ? Storage::url($teacher->photo_path) : null; @endphp
                        <div
                            class="am-reveal"
                            style="transition-delay:{{ ($loop->index % 3) * 70 }}ms;{{ $photo ? 'cursor:pointer;' : '' }}"
                            @if($photo) @click="lightbox = { src: '{{ $photo }}', caption: '{{ addslashes($teacher->name) }}' }" @endif
                        >
                            <x-teacher-card
                                :name="$teacher->name"
                                :position="$teacher->position"
                                :photo="$photo"
                                :bio="$teacher->bio"
                                :isPrincipal="$teacher->is_principal"
                            />
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px;">
                    {{ $teachers->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada data tenaga pendidik @if($jenjang) untuk jenjang ini @endif.
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
