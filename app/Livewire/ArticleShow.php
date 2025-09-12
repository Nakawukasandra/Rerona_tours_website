<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ArticleShow extends Component
{
    public $article;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->article = DB::table('articles_tips')
            ->where('slug', $slug)
            ->where('published', 1) // Changed from 'status' to 'published'
            ->first();

        if (!$this->article) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.article-show');
    }
}
