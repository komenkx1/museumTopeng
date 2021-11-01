<?php

namespace App\Http\Livewire\Admin\Packages;

use App\Models\Feauture;
use App\Models\Package;
use Livewire\Component;

class EditForm extends Component
{

    public $name, $price, $feauture_name;
    public $updateMode = true;
    public $package;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields()
    {
        $this->feauture_name = '';
    }

    public function mount()
    {
        
        if($this->package) {
            $this->name   = $this->package->name;
            $this->price  = $this->package->price;
        }
    }
    public function render()
    {
      
        return view('livewire.admin.packages.edit-form');
    }

    public function update()
    {
      $this->validate(
            [
                'name' => 'required',
                'price' => 'required|numeric',
            ],
            [
                'name.required' => 'name field is required',
                'price.required' => 'price field is required',

            ]
        );

        $this->package->update([
            "name" => $this->name,
            "price" => $this->price
        ]);

        // dd($lastPackages->id);
        if ($this->feauture_name) {
            foreach ($this->feauture_name as $key => $value) {
                Feauture::create(['name' => $this->feauture_name[$key], 'id_package' => $this->package->id]);
            }
    
        }
        
        $this->inputs = [];
        $this->dispatchBrowserEvent('refreshTable'); // resfres feauture table

        $this->resetInputFields();

        // return redirect()->route("admin.packages.index");
        $this->alert('info', 'Data updates', [
            'toast' => true,
            'timer' =>  3000,
        ]);
    }
}
