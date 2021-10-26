<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(Category::where('name', '=', $row['categorie'])->count() > 0)
        {
            // niks doen, categorie is aanwezig
        }else{
            // categorie nog niet aanwezig, dus toevoegen
            $category = Category::create(['name' => $row['categorie']]);
        }
    }
}
