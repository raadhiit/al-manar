@php
    $firstOfMonth = \Carbon\Carbon::create($year, $month, 1);
    $monthLabel = ucfirst($firstOfMonth->locale('id')->isoFormat('MMMM YYYY'));
    $daysInMonth = $firstOfMonth->daysInMonth;
    $leadingBlanks = $firstOfMonth->dayOfWeekIso - 1;
    $totalCells = $leadingBlanks + $daysInMonth;
    $trailingBlanks = (7 - ($totalCells % 7)) % 7;
    $todayStr = now()->format('Y-m-d');
    $dayLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    $filters = ['' => 'Semua', 'sdit' => 'SDIT', 'tkit' => 'KB-RA'];

    $jsEvents = $this->events->map(fn ($dayEvents) => $dayEvents->map(fn ($e) => [
        'title' => $e->title,
        'dateRange' => $e->date_range_label,
        'description' => $e->description,
        'school' => $e->source === \App\Models\CalendarEvent::SOURCE_NATIONAL_HOLIDAY ? 'Libur Nasional' : ($e->school?->name ?? 'Semua Unit'),
        'tone' => match(true) {
            $e->source === \App\Models\CalendarEvent::SOURCE_NATIONAL_HOLIDAY => 'libur',
            $e->school?->level === 'tkit' => 'tkit',
            (bool) $e->school => 'sdit',
            default => 'ink',
        },
        'attachmentUrl' => $e->attachment_path ? Storage::url($e->attachment_path) : null,
    ])->values())->toArray();
@endphp

<div wire:key="public-calendar" x-data="{ modalDate: null, eventsByDate: {{ Illuminate\Support\Js::from($jsEvents) }} }">

    {{-- Filter jenjang --}}
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px;">
        @foreach($filters as $key => $label)
            @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
            <button
                type="button"
                wire:click="setJenjang('{{ $key }}')"
                class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
            >{{ $label }}</button>
        @endforeach
    </div>

    {{-- Kalender --}}
    <div class="am-card" style="padding:20px 24px 28px;">

        {{-- Navigasi bulan --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;align-items:center;gap:10px;">
                <button type="button" wire:click="previousMonth"
                    style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid var(--sand-200);background:none;color:var(--ink-600);cursor:pointer;font-size:var(--text-lg);"
                    aria-label="Bulan sebelumnya">&lsaquo;</button>
                <div style="font-family:var(--font-display);font-weight:700;font-size:var(--text-lg);color:var(--ink-900);min-width:180px;text-align:center;">{{ $monthLabel }}</div>
                <button type="button" wire:click="nextMonth"
                    style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid var(--sand-200);background:none;color:var(--ink-600);cursor:pointer;font-size:var(--text-lg);"
                    aria-label="Bulan berikutnya">&rsaquo;</button>
            </div>
            <button type="button" wire:click="goToToday" class="am-btn am-btn--outline am-btn--sm">Bulan Ini</button>
        </div>

        {{-- Header hari --}}
        <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:6px;margin-bottom:6px;">
            @foreach($dayLabels as $label)
                <div style="text-align:center;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;color:var(--ink-500);">{{ $label }}</div>
            @endforeach
        </div>

        {{-- Grid tanggal --}}
        <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:6px;">
            @for($i = 0; $i < $leadingBlanks; $i++)
                <div></div>
            @endfor

            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $dayEvents = $this->events->get($dateStr, collect());
                    $isToday = $dateStr === $todayStr;
                @endphp
                <button
                    type="button"
                    @if($dayEvents->isNotEmpty()) @click="modalDate = '{{ $dateStr }}'" @endif
                    style="min-height:76px;border-radius:10px;padding:6px;text-align:left;background:var(--surface-card);border:1px solid {{ $isToday ? 'var(--green-500)' : 'var(--sand-200)' }};{{ $isToday ? 'box-shadow:0 0 0 1px var(--green-500);' : '' }}{{ $dayEvents->isNotEmpty() ? 'cursor:pointer;' : 'cursor:default;' }}"
                >
                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;color:{{ $isToday ? 'var(--green-600)' : 'var(--ink-700)' }};">{{ $day }}</div>
                    <div style="margin-top:4px;display:flex;flex-direction:column;gap:2px;">
                        @foreach($dayEvents->take(2) as $event)
                            @php
                                $tone = match(true) {
                                    $event->source === \App\Models\CalendarEvent::SOURCE_NATIONAL_HOLIDAY => 'var(--danger-500)',
                                    $event->school?->level === 'tkit' => 'var(--gold-500)',
                                    (bool) $event->school => 'var(--green-600)',
                                    default => 'var(--ink-500)',
                                };
                            @endphp
                            <div style="background:{{ $tone }};color:#fff;font-family:var(--font-sans);font-size:9px;font-weight:600;padding:2px 5px;border-radius:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $event->title }}</div>
                        @endforeach
                        @if($dayEvents->count() > 2)
                            <div style="font-family:var(--font-sans);font-size:9px;color:var(--ink-400);">+{{ $dayEvents->count() - 2 }} lainnya</div>
                        @endif
                    </div>
                </button>
            @endfor

            @for($i = 0; $i < $trailingBlanks; $i++)
                <div></div>
            @endfor
        </div>
    </div>

    {{-- Modal detail agenda --}}
    <div x-show="modalDate" x-cloak style="position:fixed;inset:0;z-index:60;">
        <div style="position:absolute;inset:0;background:rgba(13,56,41,.55);" @click="modalDate = null"></div>
        <div style="position:relative;height:100%;display:flex;align-items:center;justify-content:center;padding:20px;pointer-events:none;">
            <div style="pointer-events:auto;background:var(--surface-card);border-radius:var(--radius-xl);max-width:440px;width:100%;max-height:80vh;overflow-y:auto;padding:28px;box-shadow:var(--shadow-lg,0 20px 40px rgba(0,0,0,.2));">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div style="font-family:var(--font-display);font-weight:700;font-size:var(--text-lg);color:var(--ink-900);" x-text="modalDate"></div>
                    <button type="button" @click="modalDate = null" style="background:none;border:none;cursor:pointer;color:var(--ink-400);font-size:var(--text-xl);line-height:1;">&times;</button>
                </div>
                <template x-for="(item, idx) in (eventsByDate[modalDate] || [])" :key="idx">
                    <div style="padding:14px 0;border-top:1px solid var(--sand-200);">
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:6px;">
                            <span :style="'background:' + ({ tkit: 'var(--gold-50)', sdit: 'var(--green-50)', libur: 'var(--danger-50)' }[item.tone] || 'var(--cream-100)') + ';color:' + ({ tkit: 'var(--gold-700)', sdit: 'var(--green-700)', libur: 'var(--danger-500)' }[item.tone] || 'var(--ink-600)') + ';'"
                                style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;padding:3px 10px;border-radius:20px;" x-text="item.school"></span>
                        </div>
                        <div style="font-family:var(--font-sans);font-weight:700;font-size:var(--text-sm);color:var(--ink-900);margin-bottom:2px;" x-text="item.title"></div>
                        <div style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-500);margin-bottom:4px;" x-text="item.dateRange"></div>
                        <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-600);line-height:1.6;" x-show="item.description" x-text="item.description"></div>
                        <a x-show="item.attachmentUrl" :href="item.attachmentUrl" target="_blank"
                            class="am-btn am-btn--outline am-btn--sm" style="margin-top:10px;display:inline-flex;">Lihat Lampiran</a>
                    </div>
                </template>
            </div>
        </div>
    </div>

</div>
