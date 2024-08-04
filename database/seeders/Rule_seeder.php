<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rule; 
class Rule_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rule::create($this->rules_data());
    }

    public function rules_data(){
        return [
            'title'=>'first rule',
          'description'=>'Full Access of All Data'
        ];
        }
}
