<?php

namespace App\View\Components\ServiceManagement;

use Illuminate\View\Component;

class ImageUpload extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $service;
    public $referenceId;
    public function __construct($service = null, $referenceId = null)
    {
        $this->service = $service;
        $this->referenceId = $referenceId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.image-upload');
    }
}
