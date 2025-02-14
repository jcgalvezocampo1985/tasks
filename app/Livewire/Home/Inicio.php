<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Gestor de Tareas')]
class Inicio extends Component
{
    public $menu = 'Inicio';

    public function render()
    {
        return view('livewire.home.inicio');
    }
}
