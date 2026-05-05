<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampusProfileController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\PmbController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\StudentAffairsController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

// ─── FRONTEND ────────────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil Kampus
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/sejarah',        [CampusProfileController::class, 'history'])->name('sejarah');
    Route::get('/visi-misi',      [CampusProfileController::class, 'visionMission'])->name('visi-misi');
    Route::get('/struktur',       [CampusProfileController::class, 'structure'])->name('struktur');
    Route::get('/pimpinan',       [CampusProfileController::class, 'leadership'])->name('pimpinan');
    Route::get('/dosen-staff',    [CampusProfileController::class, 'lecturers'])->name('dosen-staff');
    Route::get('/fasilitas',      [CampusProfileController::class, 'facilities'])->name('fasilitas');
    Route::get('/akreditasi',     [CampusProfileController::class, 'accreditation'])->name('akreditasi');
    Route::get('/lokasi',         [CampusProfileController::class, 'location'])->name('lokasi');
});

// Akademik
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/program-studi',            [AcademicController::class, 'programs'])->name('program-studi');
    Route::get('/program-studi/{program}',  [AcademicController::class, 'programDetail'])->name('program-detail');
    Route::get('/kalender',                 [AcademicController::class, 'calendar'])->name('kalender');
    Route::get('/kurikulum',                [AcademicController::class, 'curriculum'])->name('kurikulum');
    Route::get('/e-learning',               [AcademicController::class, 'elearning'])->name('elearning');
    Route::get('/perpustakaan',             [AcademicController::class, 'library'])->name('perpustakaan');
});

// PMB
Route::prefix('pmb')->name('pmb.')->group(function () {
    Route::get('/',                 [PmbController::class, 'index'])->name('index');
    Route::get('/syarat',           [PmbController::class, 'requirements'])->name('syarat');
    Route::get('/biaya',            [PmbController::class, 'fees'])->name('biaya');
    Route::get('/beasiswa',         [PmbController::class, 'scholarships'])->name('beasiswa');
    Route::get('/jadwal',           [PmbController::class, 'schedule'])->name('jadwal');
    Route::get('/daftar',           [PmbController::class, 'register'])->name('daftar');
    Route::post('/daftar',          [PmbController::class, 'store'])->name('store');
    Route::get('/sukses/{number}',  [PmbController::class, 'success'])->name('success');
});

// Penelitian & Pengabdian
Route::prefix('penelitian')->name('penelitian.')->group(function () {
    Route::get('/',           [ResearchController::class, 'index'])->name('index');
    Route::get('/{research}', [ResearchController::class, 'show'])->name('show');
});

// Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/',       [NewsController::class, 'index'])->name('index');
    Route::get('/{news}', [NewsController::class, 'show'])->name('show');
});

// Media
Route::prefix('media')->name('media.')->group(function () {
    Route::get('/agenda',         [MediaController::class, 'events'])->name('agenda');
    Route::get('/agenda/{event}', [MediaController::class, 'eventDetail'])->name('agenda.show');
    Route::get('/galeri',         [MediaController::class, 'gallery'])->name('galeri');
    Route::get('/video',          [MediaController::class, 'videos'])->name('video');
});

// Kemahasiswaan
Route::prefix('kemahasiswaan')->name('kemahasiswaan.')->group(function () {
    Route::get('/organisasi', [StudentAffairsController::class, 'organizations'])->name('organisasi');
    Route::get('/prestasi',   [StudentAffairsController::class, 'achievements'])->name('prestasi');
    Route::get('/alumni',     [StudentAffairsController::class, 'alumni'])->name('alumni');
    Route::get('/layanan',    [StudentAffairsController::class, 'services'])->name('layanan');
    Route::get('/karir',      [StudentAffairsController::class, 'career'])->name('karir');
});

// Kerjasama
Route::get('/kerjasama', [PartnershipController::class, 'index'])->name('kerjasama.index');

// Kontak
Route::get('/kontak',  [ContactController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Halaman Statis (dari database)
Route::get('/halaman/{slug}', function (string $slug) {
    $page = \App\Models\Page::where('slug', $slug)->firstOrFail();
    return view('frontend.page', compact('page'));
})->name('halaman.show');

// ─── ADMIN PANEL ─────────────────────────────────────────────────────────────

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\PmbController as AdminPmbController;
use App\Http\Controllers\Admin\ResearchController as AdminResearchController;
use App\Http\Controllers\Admin\PartnershipController as AdminPartnershipController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\AcademicCalendarController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\StudentOrganizationController;
use App\Http\Controllers\Admin\StudentAchievementController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MenuController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero-banners',   HeroBannerController::class)->except(['show']);
    Route::resource('news',           AdminNewsController::class)->except(['show']);
    Route::resource('events',         EventController::class)->except(['show']);
    Route::resource('gallery',        GalleryController::class)->except(['show']);
    Route::post('/gallery/{gallery}/toggle', [GalleryController::class, 'toggle'])->name('gallery.toggle');
    Route::post('/gallery/bulk-upload',      [GalleryController::class, 'bulkStore'])->name('gallery.bulk-store');
    Route::resource('videos',         VideoController::class)->except(['show']);
    Route::resource('staff',          StaffController::class)->except(['show']);
    Route::resource('facilities',     FacilityController::class)->except(['show']);
    Route::resource('study-programs', StudyProgramController::class)->except(['show']);
    Route::resource('academic-calendars', AcademicCalendarController::class)->except(['show']);
    Route::resource('scholarships',   ScholarshipController::class)->except(['show']);
    Route::resource('research',       AdminResearchController::class)->except(['show']);
    Route::resource('student-organizations', StudentOrganizationController::class)->except(['show'])
        ->parameters(['student-organizations' => 'organization']);
    Route::resource('student-achievements',  StudentAchievementController::class)->except(['show'])
        ->parameters(['student-achievements' => 'achievement']);
    Route::resource('alumni',         AlumniController::class)->except(['show']);
    Route::resource('partnerships',   AdminPartnershipController::class)->except(['show']);

    // PMB (tidak pakai resource karena ada updateStatus)
    Route::prefix('pmb')->name('pmb.')->group(function () {
        Route::get('/',                 [AdminPmbController::class, 'index'])->name('index');
        Route::get('/{pmb}',            [AdminPmbController::class, 'show'])->name('show');
        Route::post('/{pmb}/status',    [AdminPmbController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{pmb}',         [AdminPmbController::class, 'destroy'])->name('destroy');
    });

    // Pesan/Kontak
    Route::get('/contacts',             [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}',   [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}',[AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Halaman Statis
    Route::resource('pages', PageController::class)->except(['show']);

    // Menu Dinamis
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::post('/menus/{menu}/toggle',  [MenuController::class, 'toggle'])->name('menus.toggle');
    Route::post('/menus/reorder',        [MenuController::class, 'reorder'])->name('menus.reorder');

    // Pengaturan
    Route::get('/settings',  [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// ─── USER AUTH (Breeze - hanya untuk admin login) ────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
