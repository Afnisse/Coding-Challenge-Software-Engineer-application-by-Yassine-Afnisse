<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product;
use App\Http\Resources\ProductCollection;
use App\Services\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    private $productService;
    /**
     * ProductsController constructor.
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|object
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sort' => ['string', Rule::in(['name', 'price'])],
            'sort_type' => ['string', 'max:4', Rule::in(['asc', 'desc']), 'required_with:sort'],
            'filter_by' => ['string', 'exists:App\Category,name'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        return  (new ProductCollection($this->productService->getAllProductsFilteredByCategoryAndSortedBy(
            $request->get('filter_by'),
            $request->get('sort'),
            $request->get('sort_type')
        )))->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'description' => ['max:255'],
            'price' => ['required', 'numeric', 'between:0,999999.99'],
            'category_id' => ['required', 'numeric', 'exists:App\Category,id'],
            'image' => ['required', 'image']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $data = $request->only(['name', 'description', 'price', 'category_id']);
        $data['image'] =  Storage::url($request->file('image')
                        ->storePubliclyAs('public/images', $request->file('image')->getClientOriginalName()));

        $result = $this->productService->addNewProduct($data);

        return (new Product($result))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
