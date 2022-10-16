<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class NewItemsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $category=null;

            if ($row[2] != null || $row[2] != ''){
                $category = Category::where('name',$row[2])->first();
                if ($category){
                    $category = $category->id;
                }
                if (!$category){
                    $category = Category::create([
                        'name'=>$row[2],
                        'image'=>'uploads/images/164197706793default_product.png',
                        'upper_id'=>null
                    ]);
                    $category = $category->id;
                }
            }

            if ($row[0] == 'item') {
                $item = Item::create([
                    'name' => $row[1],
                    'barcode' =>$row[6],
                    'code' => '',
                    'category_id' => $category,
                    'brand_id' => 1,
                    'price' => $row[4] ?? 0,
                    'buy_price' => $row[5] ?? 0,
                    'min_amount'=> $row[7] ?? 1
                ]);

                $item->fill([
                    'code' => $item->id,
                ])->save();

                Unit::create([
                    'item_id'=>$item->id,
                    'ratio'=>1,
                    'name'=>$row[1],
                    'price'=>$row[4]
                ]);
            }else{
                $item = Item::where('barcode',$row[6])->first();

                Unit::create([
                    'item_id'=>$item->id,
                    'ratio'=>$row[8],
                    'name'=>$row[1],
                    'price'=>$row[4]
                ]);
            }
        }

    }
}
