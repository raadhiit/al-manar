<x-filament-panels::page>
    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
        <label style="font-size:0.875rem;color:#9ca3af;">Dari</label>
        <input type="date" wire:model.live="from" style="border-radius:0.5rem;border:1px solid rgba(255,255,255,0.1);background:#111827;color:#e5e7eb;padding:0.4rem 0.6rem;font-size:0.875rem;">

        <label style="font-size:0.875rem;color:#9ca3af;">Sampai</label>
        <input type="date" wire:model.live="to" style="border-radius:0.5rem;border:1px solid rgba(255,255,255,0.1);background:#111827;color:#e5e7eb;padding:0.4rem 0.6rem;font-size:0.875rem;">
    </div>

    <div x-data="{ open: null }" style="background:var(--fi-color-gray-900, #111827);border-radius:0.75rem;overflow:hidden;">
        @if(empty($logs))
            <div style="padding:2rem;text-align:center;color:#9ca3af;font-family:ui-monospace,monospace;font-size:0.875rem;">
                Tidak ada error pada log.
            </div>
        @else
            <table style="width:100%;border-collapse:collapse;font-family:ui-monospace,monospace;font-size:0.8rem;">
                <thead>
                    <tr style="background:rgba(255,255,255,0.04);">
                        <th style="text-align:left;padding:0.75rem 1rem;color:#9ca3af;font-weight:600;width:180px;">Waktu</th>
                        <th style="text-align:left;padding:0.75rem 1rem;color:#9ca3af;font-weight:600;">Pesan</th>
                        <th style="width:40px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $i => $log)
                        <tr style="border-top:1px solid rgba(255,255,255,0.06);cursor:pointer;" @click="open = open === {{ $i }} ? null : {{ $i }}">
                            <td style="padding:0.75rem 1rem;color:#9ca3af;white-space:nowrap;vertical-align:top;">{{ $log['timestamp'] }}</td>
                            <td style="padding:0.75rem 1rem;color:#f87171;word-break:break-word;">{{ $log['message'] }}</td>
                            <td style="padding:0.75rem 1rem;color:#6b7280;vertical-align:top;" x-text="open === {{ $i }} ? '▲' : '▼'"></td>
                        </tr>
                        <tr x-show="open === {{ $i }}" x-cloak>
                            <td colspan="3" style="padding:0 1rem 1rem;background:rgba(255,255,255,0.02);">
                                <pre style="margin:0;white-space:pre-wrap;word-break:break-word;color:#fca5a5;font-size:0.75rem;line-height:1.6;padding:0.75rem;background:#0b0f17;border-radius:0.5rem;">{{ $log['detail'] }}</pre>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-filament-panels::page>
