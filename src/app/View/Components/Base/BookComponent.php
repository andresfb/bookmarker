<?php

namespace App\View\Components\Base;

use App\Services\SectionsService;
use Illuminate\View\Component;

abstract class BookComponent extends Component
{
    public function __construct(protected readonly SectionsService $sectionsService)
    {
    }
}
