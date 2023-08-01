<?php

namespace App\Http\Controllers\Admin\Commerce\Products;

use App\Http\Controllers\Controller;
use App\Models\Commerce\CcProduct;
use App\Models\Commerce\CcProductCategory;
use App\Models\Select\CcRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Controller::sessionVariables();
      try {
        $session = Auth::user();
        $CcRole = CcRole::ordered();
        $CcProduct = CcProduct::ordered();
        $CcProductCategory = CcProductCategory::ordered();
        return view('admin.commerce.products.categories')
          ->with('products', $CcProduct)
          ->with('productCategories', $CcProductCategory)
          ->with('roles', $CcRole)
          ->with('session', $session);
      } catch (\Exception $e) { return redirect()->back()->with("error", "Product categories page not loading properly"); }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//      try {
        $session = Auth::user();
        $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
        $request->merge(['alias'=>$alias,'create_id'=>$session->id,'update_id'=>$session->id]);
        CcProductCategory::create($request->all());
        return redirect()->back()->with('success', 'Post category has been added successfully');
//      } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the post category"); }
    }

  public function publish(Request $request,$id)
  {
    try {
      $session = Auth::user();
      if ($request->switch == 1) {
        $publish = "published";
      } else {
        $publish = "unpublished";
      }
      $request->merge(['update_id' => $session->id]);
      CcProductCategory::findOrFail($id)->update(['published' => $request->switch]);
      return redirect()->back()->with("success", "Product category status updated successfully");
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "There was a problem updating product category post");
    }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $session = Auth::user();
        $CcProductCategory = CcProductCategory::findOrFail($id);
        $request->merge(['update_id' => $session->id]);
        $CcProductCategory->update($request->all());
        return redirect()->back()->with('success', 'Product category has been updated successfully');
      }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating product category"); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        CcProduct::where('cat_id',$id)->delete();
        CcProductCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product category has been delete successfully');
      } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting product category"); }
    }
}
