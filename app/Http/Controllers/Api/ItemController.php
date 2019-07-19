<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateItemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return $this->json(Item::with([
            'category',
            'location'
        ])->get()->toArray());
    }

    public function store(Request $request)
    {
        try {
            Item::create([
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'location_id' => $request->input('location'),
                'price' => $request->input('price'),
            ]);
            return $this->swal('success', 'Item Created', 'Your item was created successfully');
        } catch (\Exception $e) {
            return $this->swal("error", "Error Creating Item", $e->getMessage());
        }
    }

    public function destroy(Item $item)
    {
        try {
            $item->delete();
            return $this->swal('success', 'Item Deleted', 'Your item was deleted successfully');
        } catch (\Exception $e) {
            return $this->swal('error', 'Error Deleting Item', $e->getMessage());
        }
    }
}
