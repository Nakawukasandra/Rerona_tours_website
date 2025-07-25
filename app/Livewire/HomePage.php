<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class HomePage extends Component
{
    public $searchDestination;
    public $searchMonth;
    public $sortBy = 'date';

    public function render()
    {
        // Featured tours - using correct column names from your tours table
        $featuredTours = DB::table('tours')
            ->where('is_featured', 1)  // Changed from 'featured' to 'is_featured'
            ->where('is_active', 1)    // Changed from 'status' to 'is_active'
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        // Recent posts from articles_tips table
        $recentPosts = DB::table('articles_tips')
            ->where('published', 1)  // Changed from 'status' = 'PUBLISHED' to 'published' = 1
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('livewire.home-page', compact('featuredTours', 'recentPosts'));
    }

    public function search()
    {
        session()->flash('message', 'Search functionality coming soon!');
    }
}
