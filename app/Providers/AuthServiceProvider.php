<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\Camp;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Gallery;
use App\Models\HeaderImage;
use App\Models\HeroSlider;
use App\Models\Regulation;
use App\Models\SkiInstructor;
use App\Models\SkiProgram;
use App\Models\Testimonial;
use App\Models\Webcam;
use App\Policies\BlogPostPolicy;
use App\Policies\CampPolicy;
use App\Policies\CategoriesPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CompanyPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\HeaderImagePolicy;
use App\Policies\HeroSliderPolicy;
use App\Policies\RegulationPolicy;
use App\Policies\SkiInstructorPolicy;
use App\Policies\SkiProgramPolicy;
use App\Policies\TestimonialPolicy;
use App\Policies\WebcamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        BlogPost::class => BlogPostPolicy::class,
        Camp::class => CampPolicy::class,
        Categories::class => CategoriesPolicy::class,
        Company::class => CompanyPolicy::class,
        Gallery::class => GalleryPolicy::class,
        HeaderImage::class => HeaderImagePolicy::class,
        HeroSlider::class => HeroSliderPolicy::class,
        Regulation::class => RegulationPolicy::class,
        SkiInstructor::class => SkiInstructorPolicy::class,
        SkiProgram::class => SkiProgramPolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        Webcam::class => WebcamPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
