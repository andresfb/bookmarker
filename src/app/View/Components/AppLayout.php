<?php

namespace App\View\Components;

use App\View\Components\Base\BookComponent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AppLayout extends BookComponent
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Application|Factory|View
    {
        return view('layouts.app')
            ->with(
                'sections',
                $this->sectionsService->getSimpleList(auth()->id())
            );
    }
}
