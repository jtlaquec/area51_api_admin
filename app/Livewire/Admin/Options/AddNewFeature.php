<?php

namespace App\Livewire\Admin\Options;

use Livewire\Component;

class AddNewFeature extends Component
{
    public $option;

    public $newFeature = [
        'value' => '',
        'description' => '',

    ];

    public function addFeature()
    {
        $this->validate([
            'newFeature.value' => 'required',
            'newFeature.description' => 'required',
        ]);

        $this->option->features()->create($this->newFeature);

        $this->dispatch('featureAdded');

        $this->reset('newFeature');
    }



    public function render()
    {
        return view('livewire.admin.options.add-new-feature');
    }
}
