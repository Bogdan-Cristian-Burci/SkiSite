<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HeroSliderController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\SkiInstructorController;
use App\Http\Controllers\SkiProgramController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WebcamController;
use Illuminate\Support\Facades\Route;

// Home page (Romanian default)
Route::get('/', [IndexController::class, 'index'])->middleware('setlocale')->name('home');

// English home page
Route::get('/en', [IndexController::class, 'index'])->middleware('setlocale')->name('en.home');

// English routes
Route::group(['prefix' => 'en', 'middleware' => 'setlocale'], function () {
    Route::get('programs', [SkiProgramController::class, 'webIndex'])->name('en.programs');
    Route::get('programs/{slug}', [SkiProgramController::class, 'webShow'])->name('en.programs.show');
    Route::get('blog', [BlogPostController::class, 'webIndex'])->name('en.blog');
    Route::get('blog/{slug}', [BlogPostController::class, 'webShow'])->name('en.blog.show');
    Route::get('team', [SkiInstructorController::class, 'webIndex'])->name('en.team');
    Route::get('team/{skiInstructor}', [SkiInstructorController::class, 'webShow'])->name('en.team.show');
    Route::get('testimonials', [TestimonialController::class, 'webIndex'])->name('en.testimonials');
    Route::get('gallery', [GalleryController::class, 'webIndex'])->name('en.gallery');
    Route::get('webcams', [WebcamController::class, 'webIndex'])->name('en.webcams');
    Route::get('about', [CompanyController::class, 'webIndex'])->name('en.about');
    Route::get('camps', [CampController::class, 'webIndex'])->name('en.camps');
    Route::get('camps/{slug}', [CampController::class, 'webShow'])->name('en.camps.show');
    Route::get('regulations', [RegulationController::class, 'webIndex'])->name('en.regulations');
    Route::get('regulations/{slug}', [RegulationController::class, 'webShow'])->name('en.regulations.show');
    Route::get('contact', [ContactController::class,'webIndex'])->name('en.contact');
    Route::get('pricing', function () { return view('pricing'); })->name('en.pricing');
    Route::get('privacy-policy', function () { return view('privacy-policy'); })->name('en.privacy-policy');
});

// Romanian routes (default language, no prefix)
Route::group(['middleware' => 'setlocale'], function () {
    Route::get('programe', [SkiProgramController::class, 'webIndex'])->name('ro.programs');
    Route::get('programe/{slug}', [SkiProgramController::class, 'webShow'])->name('ro.programs.show');
    Route::get('blog', [BlogPostController::class, 'webIndex'])->name('ro.blog');
    Route::get('blog/{slug}', [BlogPostController::class, 'webShow'])->name('ro.blog.show');
    Route::get('echipa', [SkiInstructorController::class, 'webIndex'])->name('ro.team');
    Route::get('echipa/{skiInstructor}', [SkiInstructorController::class, 'webShow'])->name('ro.team.show');
    Route::get('testimoniale', [TestimonialController::class, 'webIndex'])->name('ro.testimonials');
    Route::get('galerie', [GalleryController::class, 'webIndex'])->name('ro.gallery');
    Route::get('webcamuri', [WebcamController::class, 'webIndex'])->name('ro.webcams');
    Route::get('despre', [CompanyController::class, 'webIndex'])->name('ro.about');
    Route::get('tabere', [CampController::class, 'webIndex'])->name('ro.camps');
    Route::get('tabere/{slug}', [CampController::class, 'webShow'])->name('ro.camps.show');
    Route::get('regulamente', [RegulationController::class, 'webIndex'])->name('ro.regulations');
    Route::get('regulamente/{slug}', [RegulationController::class, 'webShow'])->name('ro.regulations.show');
    Route::get('contact', [ContactController::class,'webIndex'])->name('ro.contact');
    Route::get('tarife', function () { return view('pricing'); })->name('ro.pricing');
    Route::get('politica-confidentialitate', function () { return view('privacy-policy'); })->name('ro.privacy-policy');
});

// Fallback routes (for backwards compatibility and default English)
// Ski Programs routes - removed to avoid conflicts with language switching

// Blog Posts routes
Route::get('/blog', [BlogPostController::class, 'webIndex'])->name('blog.fallback');
Route::get('/blog/{slug}', [BlogPostController::class, 'webShow'])->name('blog.show.fallback');

// Ski Instructors/Team routes
Route::get('/team', [SkiInstructorController::class, 'webIndex'])->name('team.fallback');
Route::get('/team/{skiInstructor}', [SkiInstructorController::class, 'webShow'])->name('team.show.fallback');

// Testimonials routes
Route::get('/testimonials', [TestimonialController::class, 'webIndex'])->name('testimonials.fallback');

// Gallery routes
Route::get('/gallery', [GalleryController::class, 'webIndex'])->name('gallery.fallback');

// Webcams routes
Route::get('/webcams', [WebcamController::class, 'webIndex'])->name('webcams.fallback');

// Company info routes
Route::get('/about', [CompanyController::class, 'webIndex'])->name('about.fallback');

// Camps routes
Route::get('/camps', [CampController::class, 'webIndex'])->name('camps.fallback');
Route::get('/camps/{slug}', [CampController::class, 'webShow'])->name('camps.show.fallback');

// Regulations routes
Route::get('/regulations', [RegulationController::class, 'webIndex'])->name('regulations.fallback');
Route::get('/regulations/{slug}', [RegulationController::class, 'webShow'])->name('regulations.show.fallback');

// Appointments routes
Route::get('/appointments/create', [AppointmentController::class, 'webCreate'])->name('appointments.create.fallback');
Route::post('/appointments', [AppointmentController::class, 'webStore'])->name('appointments.store.fallback');

// Contact route
Route::get('/contact', [ContactController::class, 'webIndex'])->name('contact.fallback');

// Pricing route
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing.fallback');

// Privacy Policy route
Route::get('/privacy-policy
', function () {
    return view('privacy-policy');
})->name('privacy-policy.fallback');

// Contact form submission
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

// Comment submission (requires authentication)
Route::post('blog/{blogPost}/comments', [\App\Http\Controllers\CommentController::class, 'webStore'])
    ->middleware('auth')
    ->name('comments.store');

// Camp booking (requires authentication)
Route::post('camps/{camp}/book', [CampController::class, 'book'])
    ->middleware('auth')
    ->name('camps.book');

// Camp registration management (requires authentication)
Route::post('camps/{camp}/update-registration', [CampController::class, 'updateRegistration'])
    ->middleware('auth')
    ->name('camps.updateRegistration');

Route::post('camps/{camp}/cancel-registration', [CampController::class, 'cancelRegistration'])
    ->middleware('auth')
    ->name('camps.cancelRegistration');

// Language switching
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ro'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);

        // Get the current route name from referer
        $referer = request()->header('referer');
        if (!$referer) {
            return redirect($locale === 'en' ? route('en.home') : route('home'));
        }

        $currentPath = parse_url($referer, PHP_URL_PATH);

        // Helper function to find content by slug and get translated slug
        $findTranslatedSlug = function($modelClass, $currentSlug, $currentLocale, $targetLocale) {
            try {
                $items = $modelClass::all();
                foreach ($items as $item) {
                    if ($item->getTranslation('slug', $currentLocale) === $currentSlug) {
                        return $item->getTranslation('slug', $targetLocale);
                    }
                }
            } catch (\Exception $e) {
                // If error, return original slug
            }
            return $currentSlug;
        };

        // Map current path to target language route
        try {
            if ($locale === 'ro') {
                // Switching to Romanian
                if ($currentPath === '/en') {
                    return redirect(route('home'));
                } elseif ($currentPath === '/en/programs') {
                    return redirect(route('ro.programs'));
                } elseif (str_starts_with($currentPath, '/en/programs/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\SkiProgram::class, $slug, 'en', 'ro');
                    return redirect(route('ro.programs.show', $translatedSlug));
                } elseif ($currentPath === '/en/blog') {
                    return redirect(route('ro.blog'));
                } elseif (str_starts_with($currentPath, '/en/blog/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\BlogPost::class, $slug, 'en', 'ro');
                    return redirect(route('ro.blog.show', $translatedSlug));
                } elseif ($currentPath === '/en/team') {
                    return redirect(route('ro.team'));
                } elseif (str_starts_with($currentPath, '/en/team/')) {
                    $slug = basename($currentPath);
                    return redirect(route('ro.team.show', $slug));
                } elseif ($currentPath === '/en/camps') {
                    return redirect(route('ro.camps'));
                } elseif (str_starts_with($currentPath, '/en/camps/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\Camp::class, $slug, 'en', 'ro');
                    return redirect(route('ro.camps.show', $translatedSlug));
                } elseif ($currentPath === '/en/regulations') {
                    return redirect(route('ro.regulations'));
                } elseif (str_starts_with($currentPath, '/en/regulations/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\Regulation::class, $slug, 'en', 'ro');
                    return redirect(route('ro.regulations.show', $translatedSlug));
                } elseif ($currentPath === '/en/testimonials') {
                    return redirect(route('ro.testimonials'));
                } elseif ($currentPath === '/en/gallery') {
                    return redirect(route('ro.gallery'));
                } elseif ($currentPath === '/en/webcams') {
                    return redirect(route('ro.webcams'));
                } elseif ($currentPath === '/en/about') {
                    return redirect(route('ro.about'));
                } elseif ($currentPath === '/en/contact') {
                    return redirect(route('ro.contact'));
                } elseif ($currentPath === '/en/pricing') {
                    return redirect(route('ro.pricing'));
                } elseif ($currentPath === '/en/privacy-policy') {
                    return redirect(route('ro.privacy-policy'));
                } else {
                    return redirect(route('home'));
                }
            } else {
                // Switching to English
                if ($currentPath === '/') {
                    return redirect(route('en.home'));
                } elseif ($currentPath === '/programe') {
                    return redirect(route('en.programs'));
                } elseif (str_starts_with($currentPath, '/programe/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\SkiProgram::class, $slug, 'ro', 'en');
                    return redirect(route('en.programs.show', $translatedSlug));
                } elseif ($currentPath === '/blog') {
                    return redirect(route('en.blog'));
                } elseif (str_starts_with($currentPath, '/blog/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\BlogPost::class, $slug, 'ro', 'en');
                    return redirect(route('en.blog.show', $translatedSlug));
                } elseif ($currentPath === '/echipa') {
                    return redirect(route('en.team'));
                } elseif (str_starts_with($currentPath, '/echipa/')) {
                    $slug = basename($currentPath);
                    return redirect(route('en.team.show', $slug));
                } elseif ($currentPath === '/tabere') {
                    return redirect(route('en.camps'));
                } elseif (str_starts_with($currentPath, '/tabere/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\Camp::class, $slug, 'ro', 'en');
                    return redirect(route('en.camps.show', $translatedSlug));
                } elseif ($currentPath === '/regulamente') {
                    return redirect(route('en.regulations'));
                } elseif (str_starts_with($currentPath, '/regulamente/')) {
                    $slug = basename($currentPath);
                    $translatedSlug = $findTranslatedSlug(\App\Models\Regulation::class, $slug, 'ro', 'en');
                    return redirect(route('en.regulations.show', $translatedSlug));
                } elseif ($currentPath === '/testimoniale') {
                    return redirect(route('en.testimonials'));
                } elseif ($currentPath === '/galerie') {
                    return redirect(route('en.gallery'));
                } elseif ($currentPath === '/webcamuri') {
                    return redirect(route('en.webcams'));
                } elseif ($currentPath === '/despre') {
                    return redirect(route('en.about'));
                } elseif ($currentPath === '/contact') {
                    return redirect(route('en.contact'));
                } elseif ($currentPath === '/tarife') {
                    return redirect(route('en.pricing'));
                } elseif ($currentPath === '/politica-confidentialitate') {
                    return redirect(route('en.privacy-policy'));
                } else {
                    return redirect(route('en.home'));
                }
            }
        } catch (\Exception $e) {
            // If route generation fails, go to home
            return redirect($locale === 'en' ? route('en.home') : route('home'));
        }
    }
    return redirect()->back();
})->name('lang.switch');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password change routes
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [PasswordChangeController::class, 'show'])->name('password.change');
    Route::post('/change-password', [PasswordChangeController::class, 'update'])->name('password.change.update');
});

// Dashboard routes
Route::middleware('instructor')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            // Get all appointments with relationships
            $appointments = \App\Models\Appointment::with(['user', 'skiInstructor'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Calculate statistics
            $thisMonthAppointments = \App\Models\Appointment::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            $upcomingAppointments = \App\Models\Appointment::where('start_date', '>=', now()->format('Y-m-d'))
                ->count();

            // Get all camp bookings - get users who have camp bookings
            $campBookings = \App\Models\User::whereHas('camps')->with(['camps' => function($query) {
                $query->withPivot(['number_of_adults', 'number_of_children', 'created_at']);
            }])->get()
            ->flatMap(function($user) {
                return $user->camps->map(function($camp) use ($user) {
                    $camp->user = $user;
                    return $camp;
                });
            })
            ->sortByDesc('pivot.created_at');

            return view('dashboard.admin', compact('appointments', 'campBookings', 'thisMonthAppointments', 'upcomingAppointments'));
        } elseif ($user->hasRole('instructor')) {
            return view('dashboard.instructor');
        }
        return redirect('/');
    })->name('dashboard');
});

// API Routes for CRUD operations (Admin only)
Route::prefix('api')->middleware('admin')->group(function () {
    Route::resource('ski-programs', SkiProgramController::class);
    Route::resource('blog-posts', BlogPostController::class);
    Route::resource('ski-instructors', SkiInstructorController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('webcams', WebcamController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('camps', CampController::class);
    Route::resource('regulations', RegulationController::class);
    Route::resource('hero-sliders', HeroSliderController::class);
});

// Appointments API routes (accessible by instructors and admins)
Route::prefix('api')->middleware('instructor')->group(function () {
    Route::resource('appointments', AppointmentController::class)->only(['index', 'show', 'update']);
});

// Categories API routes (Admin only)
Route::prefix('api')->middleware('admin')->group(function () {
    Route::resource('categories', CategoriesController::class);
});

// API Authentication routes for Sanctum
Route::prefix('api')->group(function () {
    Route::post('/login', [AuthController::class, 'loginApi']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logoutApi']);
        Route::get('/user', [AuthController::class, 'user']);
    });
});

// Storage file serving route (workaround for Herd nginx config)
Route::get('storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    $mimeType = mime_content_type($filePath);
    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*')->name('storage.serve');
