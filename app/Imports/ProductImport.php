<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::where('name', '=', $row['categorie'])->get();
        if(Product::where('name', '=', $row['product'])->count() > 0)
        {
            // product bestaat al, dus niet toevoegen
        }else{
            $product = Product::create([
                'name' => $row['product'],
                'description' => $row['beschrijving'],
                'category_id' => $category[0]->id
            ]);
        }
    }
}
