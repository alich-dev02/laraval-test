<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return Product[]|Collection
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric'
            ]
        );

        return Product::create($validatedData);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->getProduct($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric'
            ]
        );

        $product = $this->getProduct($id);

        if ($product->update($validatedData) == true) {
            return response()->json(['message' => "The product has been updated"]);
        }

        return response()->json(['message' => "There was a problem while updating the product"]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = $this->getProduct($id);

        if ($product->delete() == true) {
            return response()->json(['message' => "The product has been deleted"]);
        }

        return response()->json(['message' => "There was a problem while deleting the product"]);
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Exception $exception) {
            return response()->json(['message' => "The requested product wasn't found"]);
        }

        return $product;
    }
}
