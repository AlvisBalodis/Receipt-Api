<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreReceiptRequest;
use App\Http\Requests\V1\UpdateReceiptRequest;
use App\Http\Resources\V1\ReceiptCollection;
use App\Http\Resources\V1\ReceiptResource;
use App\Models\Receipt;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|ReceiptCollection
     */
    public function index(Request $request): Response|ReceiptCollection
    {
        $receiptsFilter = Receipt::query()
            ->when(request('id'), function ($query) {
                $query->where('id', 'LIKE', request('id'));
            })
            ->when(request('createdon'), function ($query) use ($request) {
                $query->where('created_at', 'LIKE', '%' . request('createdon') . '%');
            })
            ->when(request('items'), function ($query) {
                $query->whereHas('products', function ($query) {
                    $query->where('name', 'LIKE', '%' . request('items') . '%');
                });
            });

        return new ReceiptCollection($receiptsFilter->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReceiptRequest $request
     * @return ReceiptResource
     */
    public function store(StoreReceiptRequest $request): ReceiptResource
    {
        return new ReceiptResource(Receipt::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param Receipt $receipt
     * @return ReceiptResource
     */
    public function show(Receipt $receipt): ReceiptResource
    {
        return new ReceiptResource($receipt);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReceiptRequest $request
     * @param Receipt $receipt
     * @return void
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt): void
    {
        $receipt->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Receipt $receipt
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Receipt $receipt): Application|ResponseFactory|Response
    {
        $receipt->delete();

        return response([
            'message' => 'Resource deleted successfully!'
        ], 200);
    }
}
