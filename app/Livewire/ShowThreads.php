<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Thread;

use Livewire\Component;
use Livewire\WithPagination;

class ShowThreads extends Component
{

    //Pagina correctamente
    use WithPagination;

    //Variables para el filtrado
    public $search = '';
    public $category = '';

    //filtrar por categoría
    public function filterByCategory($category){
        //Reinicia la página para que no te pongas en una paginación incorrecta al filtrar categorías
        $this->resetPage();
        //Obtiene la categoría que es seleccionada en el listado
        $this->category = $category;
    }

    //Reinicia la búsqueda
    public function searchAll(){
        $this->category = "";
        $this->search = "";
    }

    public function render()
    {
        //Obtiene todas las categorías
        $categories = Category::get();

        //Inicia un query para filtrar las preguntas
        $threads = Thread::query();
        //Obtiene las categirías por coinsidencia de nombre
        $threads->where('title', 'like', "%$this->search%");

        //Si se es pulsada una categoría se anida la búsqueda de la pregunta
        if($this->category){
            $threads->where('category_id', $this->category);
        }

        //Se cargan las relaciones de user y de category
        $threads->with('user', 'category');
        //Cuenta las respuestas
        $threads->withCount('replies');
        //Se ordena por fecha más reciente
        $threads->latest();

        //Retorna la vista de livewire
        return view('livewire.show-threads', [
            //Manda las categorías
            'categories' => $categories,
            //Manda las preguntas obtenidas, filtradas y las pagina cada 5 preguntas
            'threads' => $threads->paginate(5),
        ]);
    }
}
