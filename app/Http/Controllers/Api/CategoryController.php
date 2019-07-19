<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->json(Category::with(['parent'])->get()->toArray());
    }

    protected static function parent(Request $request)
    {
        if ($request->has('parent_id')) {
            return Category::whereId($request->input('parent_id'));
        }
        return false;
    }

    public function store(Request $request)
    {
        try {
            if (Category::whereName($request->input('name'))->exists()) {
                throw new \Exception("A category with this name already exists, please come up with a new name");
            }
            Category::create([
                'name' => $request->input('name'),
                'parent_id' => (self::parent($request)) ? self::parent($request)->first()->id : null
            ]);
            return $this->swal("success", "Category Created!", "The category was created successfully");
        } catch (\Exception $e) {
            return $this->swal("error", "Failed Creating Category", $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        try {
            if (Category::whereParentId($category->id)->exists()) {
                throw new \Exception("Cannot delete a category with children");
            }
            if ($category->items()->exists()) {
                throw new \Exception("This category has items, please delete the items first");
            }
            $category->delete();
            return $this->swal("success", "Category Deleted", "The category was deleted successfully");
        } catch (\Exception $e) {
            return $this->swal("error", "Failed Deleting Category", $e->getMessage());
        }
    }
}
