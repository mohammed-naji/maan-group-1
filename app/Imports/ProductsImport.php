<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[1],
            'price' => $row[2],
            'image' => $row[3],
            'category_id' => $row[4],
            'user_id' => $row[5]
        ]);
    }
}
