<?php

namespace App\Livewire;

use Livewire\Component;

class ArticleShow extends Component
{
    public $article;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->article = DB::table('articles_tips')
            ->where('slug', $slug)
            ->where('status', 'PUBLISHED')
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
