<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $isExist = Category::where('name','Pain')->exists();
        if($isExist) return ;
         $category = new Category();
         $category->name = "Pain";
          $category->description = "Pain";
         $category->save();
    }
}
