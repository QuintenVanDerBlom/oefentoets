<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Price;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PriceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::where('name', '=', $row['product'])->get();

        // er kunnen meerdere prijzen zijn per product. Maakt dus niet uit of er 1 is.
        $price = Price::create([
            'price' => $row['prijs'],
            'effdate' => Carbon::now(),
            'product_id' => $product[0]->id
        ]);
    }
}
