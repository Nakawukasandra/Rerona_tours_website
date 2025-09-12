<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $featuredOnly = false;
    public $sortBy = 'latest';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'featuredOnly' => ['except' => false],
        'sortBy' => ['except' => 'latest'],
    ];

    public function mount()
    {
        // Initialize any default values if needed
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingFeaturedOnly()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->categoryFilter = '';
        $this->featuredOnly = false;
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    public function getPostsProperty()
    {
        $query = Post::query()
            ->with(['author', 'category'])
            ->published();

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                  ->orWhere('body', 'like', '%' . $this->search . '%')
                  ->orWhereJsonContains('tags', $this->search);
            });
        }

        // Apply category filter
        if ($this->categoryFilter) {
            $query->byCategory($this->categoryFilter);
        }

        // Apply featured filter
        if ($this->featuredOnly) {
            $query->featured();
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'popular':
                // You might want to add a views column to track popularity
                $query->orderBy('created_at', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        return $query->paginate($this->perPage);
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get();
    }

    public function getFeaturedPostsProperty()
    {
        return Post::published()
            ->featured()
            ->with(['author', 'category'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.blog.index', [
            'posts' => $this->posts,
            'categories' => $this->categories,
            'featuredPosts' => $this->featuredPosts,
        ])->layout('layouts.blog');
    }
}
