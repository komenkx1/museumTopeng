<?php

namespace App\Http\Livewire\Admin\Packages;

use App\Models\Feauture;
use App\Models\Package;
use Livewire\Component;

class AddForm extends Component
{
    public $name, $price, $feauture_name;
    public $updateMode = false;
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
        $this->name = '';
        $this->email = '';
    }

    public function render()
    {

        return view('livewire.admin.packages.add-form');
    }

    public function store()
    {
        $this->validate(
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'feauture_name.0' => 'required_without:feauture_name.*',
            ],
            [
                'name.required' => 'name field is required',
                'price.required' => 'price field is required',
                'feauture_name.0.required_without' => 'first feature field is requireds',

            ]
        );

        // dd($this->name);
        $lastPackages = Package::create([
            "name" => $this->name,
            "price" => $this->price
        ]);

        // dd($lastPackages->id);
        foreach ($this->feauture_name as $key => $value) {
            Feauture::create(['name' => $this->feauture_name[$key], 'id_package' =>  $lastPackages->id]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        return redirect()->route("admin.packages.index")->with("success","Package Created");
        
    }
}
