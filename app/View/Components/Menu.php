<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    public $menu; // добавляем
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->menu = config('menu'); // указывается название файла из папки config
        $this->menu = collect(config('menu'))->map(function ($item) {
            // $item['active'] = request()->routeIs($item['route']);
            $item['active'] = request()->routeIs($item['routeIs'] ?? $item['route']);

            return $item;
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu');
    }
}
