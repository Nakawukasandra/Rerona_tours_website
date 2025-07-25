<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\ArticleShow;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home route
Route::get('/', HomePage::class)->name('home');

// Tours route
Route::get('/tours', function() {
    $tours = \App\Models\Tour::all(); // or however you want to fetch tours
    return view('tours.index', compact('tours'));
})->name('tours');

// Booking route
Route::get('/booking', function() {
    return view('booking.index');
})->name('booking');

// Destinations route
Route::get('/destinations', function() {
    $destinations = \App\Models\Destination::where('status', 'active')->get();
    return view('destinations.index', compact('destinations'));
})->name('destinations');

// About Us route
Route::get('/about', function() {
    return view('pages.about');
})->name('about');

// Contact route
Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');

// FAQs route
Route::get('/faqs', function() {
    $faqs = \App\Models\Faq::where('status', 'active')->orderBy('order')->get();
    return view('pages.faqs', compact('faqs'));
})->name('faqs');

// Gallery route
Route::get('/gallery', function() {
    $galleries = \App\Models\Gallery::where('status', 'active')->latest()->get();
    return view('pages.gallery', compact('galleries'));
})->name('gallery');

// Blog routes
Route::get('/blog', function() {
    $posts = \App\Models\Post::published()->latest()->get();
    return view('blog.index', compact('posts'));
})->name('blog');

Route::get('/blog/{slug}', ArticleShow::class)->name('blog.show');

// Services route
Route::get('/services', function() {
    $services = \App\Models\Service::where('status', 'active')->get();
    return view('services.index', compact('services'));
})->name('services');

// Shop route
Route::get('/shop', function() {
    $products = \App\Models\Product::where('status', 'active')->get();
    return view('shop.index', compact('products'));
})->name('shop');

// Search route (for the hero section search form)
Route::get('/search', function() {
    $destination = request('destination');
    $month = request('month');
    $sort = request('sort', 'date');

    $query = \App\Models\Tour::query();

    if ($destination) {
        $query->where('destination', 'like', '%' . $destination . '%')
              ->orWhere('title', 'like', '%' . $destination . '%');
    }

    if ($month) {
        $query->whereMonth('start_date', $month);
    }

    switch ($sort) {
        case 'price_low':
            $query->orderBy('price', 'asc');
            break;
        case 'price_high':
            $query->orderBy('price', 'desc');
            break;
        case 'duration':
            $query->orderBy('duration', 'asc');
            break;
        default:
            $query->orderBy('start_date', 'asc');
            break;
    }

    $tours = $query->get();

    return view('search.results', compact('tours', 'destination', 'month', 'sort'));
})->name('search');

// Pages route (general pages handler if needed)
Route::get('/pages', function() {
    return redirect()->route('about');
})->name('pages');

// Voyager Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
