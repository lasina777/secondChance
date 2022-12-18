<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Product\ProductCreateValidation;
use App\Http\Requests\Admin\Product\ProductUpdateValidation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::simplePaginate(15);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.product.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCreateValidation $request)
    {
        $validate = $request->validated();
        unset($validate['photo']);
        # public/sdfsdfsdfsd.jpg
        $photo = $request->file('photo')->store('public');
        # Explode => / => public/sdfsdfsdfsd.jpg => ['public', 'sdfsdfsdfsd.jpg']
        $validate['photo'] = explode('/',$photo)[1];

        Product::create($validate);
        return redirect()->route('index')->with(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request,Product $product)
    {
        $request->session()->flashInput($product->toArray());
        return view('admin.product.createOrUpdate', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateValidation $request, Product $product)
    {
        $validate = $request->validated();
        unset($validate['photo']);
        if ($request->hasFile('photo')){
            # public/sdfsdfsdfsd.jpg
            $photo = $request->file('photo')->store('public');
            # Explode => / => public/sdfsdfsdfsd.jpg => ['public', 'sdfsdfsdfsd.jpg']
            $validate['photo'] = explode('/',$photo)[1];
        }
        $product->update($validate);
        return redirect()->route('index')->with(['update' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('index')->with(['delete' => true]);
    }
}
