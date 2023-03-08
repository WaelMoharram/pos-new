<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class UnitsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){

            $unit = Unit::find($row[1]);

            if ($unit){
                if ($unit->ratio == 1){
                    Item::find($unit->item_id)->fill(['price'=>$row[4]])->save();
                }
                $unit->fill([
                    'price'=>$row[4]
                ])->save();


            }

        }

    }
}
