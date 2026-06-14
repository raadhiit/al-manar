<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\AcademicCalendar;
use App\Models\Announcement;
use App\Models\Download;
use App\Models\Gallery;
use App\Models\News;
use App\Models\School;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $sdit         = School::where('slug', 'sdit')->first();
        $tkit         = School::where('slug', 'tk')->first();
        $yayasan      = School::where('slug', 'yayasan')->first();
        $latestNews   = News::with('school')->published()->latest('published_at')->take(3)->get();
        $achievements = Achievement::with('school')->latest()->take(4)->get();
        $heroSlides   = collect(array_merge(
            array_map(fn($p) => ['path' => $p, 'school' => 'SDIT'], $sdit?->hero_photos ?? []),
            array_map(fn($p) => ['path' => $p, 'school' => 'TKIT'], $tkit?->hero_photos ?? []),
        ))->shuffle()->take(6);

        return view('home', compact('sdit', 'tkit', 'yayasan', 'latestNews', 'achievements', 'heroSlides'));
    }

    public function beritaIndex(): View
    {
        $jenjang = request('jenjang') ?: null;
        $query   = News::with('school')->published()->latest('published_at');

        if ($jenjang) {
            $slug     = $jenjang === 'tkit' ? 'tk' : $jenjang;
            $schoolId = School::where('slug', $slug)->value('id');
            if ($schoolId) {
                $query->where('school_id', $schoolId);
            }
        }

        $beritaList = $query->paginate(9)->withQueryString();

        return view('berita.index', compact('beritaList', 'jenjang'));
    }

    public function beritaShow(string $slug): View
    {
        $berita = News::with('school')->published()->where('slug', $slug)->firstOrFail();

        $related = News::with('school')
            ->published()
            ->where('id', '!=', $berita->id)
            ->where('school_id', $berita->school_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'related'));
    }

    public function prestasiIndex(): View
    {
        $jenjang = request('jenjang') ?: null;
        $query   = Achievement::with('school')->latest();

        if ($jenjang) {
            $slug     = $jenjang === 'tkit' ? 'tk' : $jenjang;
            $schoolId = School::where('slug', $slug)->value('id');
            if ($schoolId) {
                $query->where('school_id', $schoolId);
            }
        }

        $achievements = $query->paginate(12)->withQueryString();

        return view('prestasi.index', compact('achievements', 'jenjang'));
    }

    public function galeriIndex(): View
    {
        $jenjang = request('jenjang') ?: null;
        $query   = Gallery::with(['items', 'school'])->latest();

        if ($jenjang) {
            $slug     = $jenjang === 'tkit' ? 'tk' : $jenjang;
            $schoolId = School::where('slug', $slug)->value('id');
            if ($schoolId) {
                $query->where('school_id', $schoolId);
            }
        }

        $galleries = $query->paginate(9)->withQueryString();

        return view('galeri.index', compact('galleries', 'jenjang'));
    }

    public function kontak(): View
    {
        $sdit = School::where('slug', 'sdit')->first();
        $tkit = School::where('slug', 'tk')->first();

        return view('kontak', compact('sdit', 'tkit'));
    }

    /* ── SDIT ──────────────────────────────────────────────────────── */

    public function sditIndex(): View
    {
        $school            = School::where('slug', 'sdit')->firstOrFail();
        $latestNews        = News::with('school')->forSchool($school->id)->published()->latest('published_at')->take(3)->get();
        $latestActivities  = Activity::forSchool($school->id)->latestFirst()->take(3)->get();

        return view('sdit.index', compact('school', 'latestNews', 'latestActivities'));
    }

    public function sditKegiatan(): View
    {
        $school     = School::where('slug', 'sdit')->firstOrFail();
        $activities = Activity::with('photos')->forSchool($school->id)->latestFirst()->paginate(9);

        return view('sdit.kegiatan', compact('school', 'activities'));
    }

    public function sditPendaftaran(): View
    {
        $school = School::where('slug', 'sdit')->firstOrFail();

        return view('sdit.pendaftaran', compact('school'));
    }

    /* ── TKIT ──────────────────────────────────────────────────────── */

    public function tkitIndex(): View
    {
        $school           = School::where('slug', 'tk')->firstOrFail();
        $latestNews       = News::with('school')->forSchool($school->id)->published()->latest('published_at')->take(3)->get();
        $latestActivities = Activity::forSchool($school->id)->latestFirst()->take(3)->get();

        return view('tkit.index', compact('school', 'latestNews', 'latestActivities'));
    }

    public function tkitKegiatan(): View
    {
        $school     = School::where('slug', 'tk')->firstOrFail();
        $activities = Activity::with('photos')->forSchool($school->id)->latestFirst()->paginate(9);

        return view('tkit.kegiatan', compact('school', 'activities'));
    }

    public function tkitPendaftaran(): View
    {
        $school = School::where('slug', 'tk')->firstOrFail();

        return view('tkit.pendaftaran', compact('school'));
    }

    /* ── Portal Akademik ───────────────────────────────────────────── */

    public function portalKalender(): View
    {
        $jenjang = request('jenjang') ?: null;
        $query   = AcademicCalendar::with('school')->active()->latest();

        if ($jenjang) {
            $slug     = $jenjang === 'tkit' ? 'tk' : $jenjang;
            $schoolId = School::where('slug', $slug)->value('id');
            if ($schoolId) {
                $query->where('school_id', $schoolId);
            }
        }

        $calendars = $query->get();

        return view('portal.kalender', compact('calendars', 'jenjang'));
    }

    public function portalKurikulum(): View
    {
        return view('portal.kurikulum');
    }

    public function portalPengumuman(): View
    {
        $announcements = Announcement::with('school')->published()->latest('published_at')->get();

        return view('portal.pengumuman', compact('announcements'));
    }

    public function portalDownload(): View
    {
        $jenjang  = request('jenjang') ?: null;
        $category = request('category') ?: null;
        $query    = Download::with('school')->active()->latest();

        if ($jenjang) {
            $slug     = $jenjang === 'tkit' ? 'tk' : $jenjang;
            $schoolId = School::where('slug', $slug)->value('id');
            if ($schoolId) {
                $query->where('school_id', $schoolId);
            }
        }

        if ($category) {
            $query->where('category', $category);
        }

        $downloads  = $query->paginate(15)->withQueryString();
        $categories = Download::active()->select('category')->distinct()->orderBy('category')->pluck('category')->filter()->values();

        return view('portal.download', compact('downloads', 'jenjang', 'category', 'categories'));
    }
}
