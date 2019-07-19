<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function itemPriceReport(Request $request)
    {
        $inputPrice = $request->input('price');
        if (!is_numeric($inputPrice)) {
            return [];
        }
        return $this->json($this->getData($inputPrice));
    }

    public function getData($price = 0.00)
    {
        $data = DB::table('items')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->join('locations', 'items.location_id', '=', 'locations.id')
            ->select([
                'items.category_id',
                'items.location_id',
                'categories.name as categoryName',
                'categories.parent_id as parentID',
                'locations.name as locationName',
            ])->selectRaw("count(*) as itemCount, (SELECT name FROM categories WHERE id = parentID) as categoryParent")
            ->where('items.price', '>=', $price)
            ->groupBy("items.location_id")
            ->groupBy("items.category_id");
        return $data->get();
    }
}