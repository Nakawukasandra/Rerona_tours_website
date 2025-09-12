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
Route::get('/tours', \App\Livewire\Tours\Index::class)->name('tours');

// Booking route - Updated to use Livewire component
Route::get('/booking', \App\Livewire\Booking\Index::class)->name('booking');

// Destinations route
Route::get('/destinations', \App\Livewire\Destinations\Index::class)->name('destinations');


// About route - Using Livewire component
Route::get('/about', \App\Livewire\Pages\About::class)->name('about');

// Contact route
Route::get('/contact', \App\Livewire\Pages\Contact::class)->name('contact');

// FAQs route - Updated to use Livewire component
Route::get('/faqs', \App\Livewire\Pages\Faq::class)->name('faqs');

// Gallery route - Updated to use Livewire component
Route::get('/gallery', \App\Livewire\Pages\Gallery::class)->name('gallery');

// Blog routes
Route::get('/blog', App\Livewire\Blog\Index::class)->name('blog');
Route::get('/blog/{slug}', ArticleShow::class)->name('blog.show');


// Services route
Route::get('/services', App\Livewire\Services\Index::class)->name('services');

// Shop route
Route::get('/shop', App\Livewire\Shop\Index::class)->name('shop');

// Cart route - ADD THIS LINE
Route::get('/cart', \App\Livewire\Cart\Index::class)->name('cart');

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


// Voyager Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
