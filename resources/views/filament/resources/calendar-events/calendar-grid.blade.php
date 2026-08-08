@php
    $firstOfMonth = \Carbon\Carbon::create($year, $month, 1);
    $monthLabel = ucfirst($firstOfMonth->locale('id')->isoFormat('MMMM YYYY'));
    $daysInMonth = $firstOfMonth->daysInMonth;
    $leadingBlanks = $firstOfMonth->dayOfWeekIso - 1;
    $totalCells = $leadingBlanks + $daysInMonth;
    $trailingBlanks = (7 - ($totalCells % 7)) % 7;
    $todayStr = now()->format('Y-m-d');
    $dayLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
@endphp

<style>
    .cal-grid-wrap { background:#fff; border:1px solid rgba(0,0,0,.08); border-radius:12px; padding:16px 18px 18px; margin-bottom:24px; }
    .dark .cal-grid-wrap { background:#18181b; border-color:rgba(255,255,255,.08); }
    .cal-grid-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
    .cal-grid-nav { display:flex; align-items:center; gap:8px; }
    .cal-nav-btn { width:28px; height:28px; display:flex; align-items:center; justify-content:center; border-radius:8px; color:#6b7280; cursor:pointer; background:transparent; border:none; font-size:16px; line-height:1; }
    .cal-nav-btn:hover { background:#f3f4f6; }
    .dark .cal-nav-btn { color:#9ca3af; }
    .dark .cal-nav-btn:hover { background:rgba(255,255,255,.06); }
    .cal-month-label { font-weight:600; font-size:15px; color:#111827; min-width:160px; text-align:center; }
    .dark .cal-month-label { color:#f4f4f5; }
    .cal-today-btn { font-size:12px; font-weight:600; color:#d97706; background:none; border:none; cursor:pointer; padding:0; }
    .cal-today-btn:hover { text-decoration:underline; }
    .cal-weekdays { display:grid; grid-template-columns:repeat(7, minmax(0, 1fr)); gap:4px; margin-bottom:4px; }
    .cal-weekday { text-align:center; font-size:11px; font-weight:600; color:#6b7280; }
    .dark .cal-weekday { color:#a1a1aa; }
    .cal-days { display:grid; grid-template-columns:repeat(7, minmax(0, 1fr)); gap:4px; }
    .cal-day { min-height:66px; border-radius:8px; padding:4px; text-align:left; cursor:pointer; border:1px solid #e5e7eb; background:transparent; transition:border-color .15s, background .15s; display:block; width:100%; }
    .cal-day:hover { border-color:#d97706; background:rgba(217,119,6,.06); }
    .dark .cal-day { border-color:rgba(255,255,255,.1); }
    .dark .cal-day:hover { background:rgba(217,119,6,.12); }
    .cal-day.is-today { border-color:#16a34a; box-shadow:0 0 0 1px #16a34a; }
    .cal-day-num { font-size:12px; font-weight:600; color:#374151; }
    .dark .cal-day-num { color:#d4d4d8; }
    .cal-day.is-today .cal-day-num { color:#16a34a; }
    .cal-chips { margin-top:4px; display:flex; flex-direction:column; gap:2px; }
    .cal-chip { padding:2px 6px; border-radius:5px; font-size:10px; font-weight:600; color:#fff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .cal-chip-more { font-size:10px; color:#9ca3af; }
</style>

<div class="cal-grid-wrap">
    <div class="cal-grid-head">
        <div class="cal-grid-nav">
            <button type="button" wire:click="previousMonth" aria-label="Bulan sebelumnya" class="cal-nav-btn">&lsaquo;</button>
            <div class="cal-month-label">{{ $monthLabel }}</div>
            <button type="button" wire:click="nextMonth" aria-label="Bulan berikutnya" class="cal-nav-btn">&rsaquo;</button>
        </div>
        <button type="button" wire:click="goToToday" class="cal-today-btn">Hari ini</button>
    </div>

    <div class="cal-weekdays">
        @foreach($dayLabels as $label)
            <div class="cal-weekday">{{ $label }}</div>
        @endforeach
    </div>

    <div class="cal-days">
        @for($i = 0; $i < $leadingBlanks; $i++)
            <div></div>
        @endfor

        @for($day = 1; $day <= $daysInMonth; $day++)
            @php
                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $dayEvents = $events->get($dateStr, collect());
                $isToday = $dateStr === $todayStr;
            @endphp
            <button
                type="button"
                wire:click="mountAction('create', { event_date: '{{ $dateStr }}' })"
                title="Klik untuk tambah agenda tanggal ini"
                class="cal-day {{ $isToday ? 'is-today' : '' }}"
            >
                <div class="cal-day-num">{{ $day }}</div>
                <div class="cal-chips">
                    @foreach($dayEvents->take(2) as $event)
                        @php
                            $chipColor = match(true) {
                                $event->source === \App\Models\CalendarEvent::SOURCE_NATIONAL_HOLIDAY => '#dc2626',
                                (bool) $event->school => $event->school->level === 'sdit' ? '#16a34a' : '#d97706',
                                default => '#6b7280',
                            };
                        @endphp
                        <div
                            wire:click.stop="mountTableAction('edit', {{ $event->id }})"
                            title="{{ $event->title }} ({{ $event->date_range_label }})"
                            class="cal-chip"
                            style="background:{{ $chipColor }};"
                        >{{ $event->title }}</div>
                    @endforeach
                    @if($dayEvents->count() > 2)
                        <div class="cal-chip-more">+{{ $dayEvents->count() - 2 }} lainnya</div>
                    @endif
                </div>
            </button>
        @endfor

        @for($i = 0; $i < $trailingBlanks; $i++)
            <div></div>
        @endfor
    </div>
</div>
