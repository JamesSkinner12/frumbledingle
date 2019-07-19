<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return response()->json(Location::get());
    }

    public function store(Request $request)
    {
        Location::create(['name' => $request->input('name')]);
    }

    public function destroy(Location $location)
    {
        try {
            if ($location->items()->exists()) {
                throw new \Exception("This location has items, please delete the items first");
            }
            $location->delete();
            return $this->swal("success", "Location Deleted", "The location was deleted successfully");
        } catch (\Exception $e) {
            return $this->swal('error', 'Error Deleting Location', $e->getMessage());
        }

    }
}