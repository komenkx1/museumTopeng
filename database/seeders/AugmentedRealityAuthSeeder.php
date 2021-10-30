<?php

namespace Database\Seeders;

use App\Models\AugmentedRealityAccount;
use Illuminate\Database\Seeder;

class AugmentedRealityAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for ($i=0; $i < 5; $i++) { 
          AugmentedRealityAccount::create([
              "username"=>"user".$i,
              "password"=>bcrypt("12341234")
          ]);
       }
    }
}
