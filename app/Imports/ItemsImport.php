<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            return $row;
            $category1=null;
            $category2=null;
            $category3=null;
            if ($row[4] != null || $row[4] != ''){
                $category1 = Category::where('name',$row[4])->first();
                if ($category1){
                    $category1 = $category1->id;
                }
                if (!$category1){
                    $category1 = Category::create([
                        'name'=>'',
                        'image'=>'uploads/images/164197706793default_product.png',
                        'upper_id'=>null
                    ]);
                    $category1 = $category1->id;
                }
            }

            if ($row[3] != null || $row[3] != ''){
                $category2 = Category::where('name',$row[3])->first();
                if ($category2){
                    $category2 = $category2->id;
                }
                if (!$category2){
                    $category2 = Category::create([
                        'name'=>'',
                        'image'=>'uploads/images/164197706793default_product.png',
                        'upper_id'=>$category1
                    ]);
                    $category2 = $category2->id;
                }
            }

            if ($row[2] != null || $row[2] != ''){
                $category3 = Category::where('name',$row[2])->first();
                if ($category3){
                    $category3 = $category3->id;
                }
                if (!$category3){
                    $category3 = Category::create([
                        'name'=>'',
                        'image'=>'uploads/images/164197706793default_product.png',
                        'upper_id'=>$category2
                    ]);
                    $category3 = $category3->id;
                }
            }
            $item = Item::create([
                'name'=>$row[0],
                'barcode'=>'',
                'code'=>'',
                'category_id'=>$category3,
                'brand_id'=>1,
                'price'=>$row[1],
                'buy_price'=>$row[1]
            ]);

            $item->fill([
                    'barcode'=>$item->id,
                    'code'=>$item->id,
                    ])->save();
        }

    }
}
