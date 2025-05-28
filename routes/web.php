<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CompanyController;
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
    Route::get('contact', function () { return view('contact'); })->name('en.contact');
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
    Route::get('contact', function () { return view('contact'); })->name('ro.contact');
    Route::get('tarife', function () { return view('pricing'); })->name('ro.pricing');
    Route::get('politica-confidentialitate', function () { return view('privacy-policy'); })->name('ro.privacy-policy');
});

// Fallback routes (for backwards compatibility and default English)
// Ski Programs routes
Route::get('/programs', [SkiProgramController::class, 'webIndex'])->name('programs.fallback');
Route::get('/programs/{slug}', [SkiProgramController::class, 'webShow'])->name('programs.show.fallback');

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
Route::get('/contact', function () {
    return view('contact');
})->name('contact.fallback');

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
Route::post('contact-store', function (){
    // TODO: Implement contact form handling
})->name('contact.store');

// Language switching
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ro'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);

        // Get the current route and convert it to the target language
        $currentRoute = request()->header('referer') ?: url('/');
        $currentPath = parse_url($currentRoute, PHP_URL_PATH);

        // Helper function to find content by slug and get translated slug
        $findTranslatedSlug = function($modelClass, $currentSlug, $currentLocale, $targetLocale) {
            try {
                // For SQLite, we need to search all items and use getTranslation
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

        // Route mappings between English and Romanian
        $routeMappings = [
            'en' => [
                '/en' => '/',
                '/en/programs' => '/programe',
                '/en/blog' => '/blog',
                '/en/team' => '/echipa',
                '/en/testimonials' => '/testimoniale',
                '/en/gallery' => '/galerie',
                '/en/webcams' => '/webcamuri',
                '/en/about' => '/despre',
                '/en/camps' => '/tabere',
                '/en/regulations' => '/regulamente',
                '/en/contact' => '/contact',
                '/en/pricing' => '/tarife',
                '/en/privacy-policy' => '/politica-confidentialitate',
            ],
            'ro' => [
                '/' => '/en',
                '/programe' => '/en/programs',
                '/blog' => '/en/blog',
                '/echipa' => '/en/team',
                '/testimoniale' => '/en/testimonials',
                '/galerie' => '/en/gallery',
                '/webcamuri' => '/en/webcams',
                '/despre' => '/en/about',
                '/tabere' => '/en/camps',
                '/regulamente' => '/en/regulations',
                '/contact' => '/en/contact',
                '/tarife' => '/en/pricing',
                '/politica-confidentialitate' => '/en/privacy-policy',
            ]
        ];

        // Content type mappings for slug translation
        $contentMappings = [
            'programs' => \App\Models\SkiProgram::class,
            'programe' => \App\Models\SkiProgram::class,
            'blog' => \App\Models\BlogPost::class,
            'camps' => \App\Models\Camp::class,
            'tabere' => \App\Models\Camp::class,
        ];

        // Convert route based on target locale
        if ($locale === 'ro') {
            // Switching to Romanian - remove /en prefix and translate
            foreach ($routeMappings['en'] as $enRoute => $roRoute) {
                if (strpos($currentPath, $enRoute) === 0) {
                    // Handle exact match
                    if ($currentPath === $enRoute) {
                        return redirect($roRoute);
                    } elseif (strpos($currentPath, $enRoute . '/') === 0) {
                        // Handle routes with slugs/parameters
                        $remainingPath = substr($currentPath, strlen($enRoute) + 1); // +1 for the '/'
                        $pathSegments = explode('/', $remainingPath);
                        $slug = $pathSegments[0];

                        // Find the content type and translate slug
                        $routeKey = trim($enRoute, '/');
                        $routeKey = str_replace('en/', '', $routeKey);

                        if (isset($contentMappings[$routeKey])) {
                            $translatedSlug = $findTranslatedSlug($contentMappings[$routeKey], $slug, 'en', 'ro');
                            $pathSegments[0] = $translatedSlug;
                            $newRemainingPath = implode('/', $pathSegments);
                            return redirect($roRoute . '/' . $newRemainingPath);
                        }

                        return redirect($roRoute . '/' . $remainingPath);
                    }
                }
            }
            // If switching from English to Romanian and no mapping found, go to home
            if (strpos($currentPath, '/en/') === 0) {
                return redirect('/');
            }
        } else {
            // Switching to English - add /en prefix and translate
            foreach ($routeMappings['ro'] as $roRoute => $enRoute) {
                if (strpos($currentPath, $roRoute) === 0) {
                    // Handle exact match
                    if ($currentPath === $roRoute) {
                        return redirect($enRoute);
                    } elseif (strpos($currentPath, $roRoute . '/') === 0) {
                        // Handle routes with slugs/parameters
                        $remainingPath = substr($currentPath, strlen($roRoute) + 1); // +1 for the '/'
                        $pathSegments = explode('/', $remainingPath);
                        $slug = $pathSegments[0];

                        // Find the content type and translate slug
                        $routeKey = trim($roRoute, '/');

                        if (isset($contentMappings[$routeKey])) {
                            $translatedSlug = $findTranslatedSlug($contentMappings[$routeKey], $slug, 'ro', 'en');
                            $pathSegments[0] = $translatedSlug;
                            $newRemainingPath = implode('/', $pathSegments);
                            return redirect($enRoute . '/' . $newRemainingPath);
                        }

                        return redirect($enRoute . '/' . $remainingPath);
                    }
                }
            }
            // If switching from Romanian to English and no mapping found, go to /en
            if (strpos($currentPath, '/en/') !== 0) {
                return redirect('/en/programs');
            }
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
            return view('dashboard.admin');
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
