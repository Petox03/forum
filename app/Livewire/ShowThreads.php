<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Thread;

use Livewire\Component;
use Livewire\WithPagination;

class ShowThreads extends Component
{

    use WithPagination;

    public $search = '';
    public $category = '';

    public function filterByCategory($category){
        //Reinicia la página para que no te pongas en una paginación incorrecta al filtrar categorías
        $this->resetPage();
        $this->category = $category;
    }

    public function searchAll(){
        $this->category = "";
        $this->search = "";
    }

    public function render()
    {
        $categories = Category::get();

        $threads = Thread::query();
        $threads->where('title', 'like', "%$this->search%");

        if($this->category){
            $threads->where('category_id', $this->category);
        }

        $threads->with('user', 'category');
        $threads->withCount('replies');
        $threads->latest();

        return view('livewire.show-threads', [
            'categories' => $categories,
            'threads' => $threads->paginate(5),
        ]);
    }
}
