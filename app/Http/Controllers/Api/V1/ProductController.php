<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ProductCollection
     */
    public function index(Request $request): ProductCollection
    {
        $productsFilter = Product::query()
            ->when(request('id'), function ($query) {
                $query->where('id', 'LIKE', request('id'));
            })
            ->when(request('product-name'), function ($query) {
                $query->where('name', 'LIKE', '%' . request('product-name') . '%');
            });

        return new ProductCollection($productsFilter->paginate()->appends($request->query()));

    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product): Response
    {
        $product->delete();

        return response([
            'message' => 'Resource deleted successfully!'
        ], 200);
    }
}
