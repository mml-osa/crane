<?php

  namespace App\Http\Controllers\Admin\Commerce\Products;

  use App\Http\Controllers\Controller;
  use App\Models\Commerce\CcProduct;
  use App\Models\Commerce\CcProductCategory;
  use App\Models\Media\CcMediaAlbum;
  use App\Models\Media\CcMediaItem;
  use App\Models\Nav\CcNav;
  use App\Models\Post\CcPostMedia;
  use App\Models\Select\CcRole;
  use App\Models\Select\CcVisibility;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class ProductsController extends Controller
  {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

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
        return view('admin.commerce.products.index')
          ->with('products', $CcProduct)
          ->with('productCategories', $CcProductCategory)
          ->with('roles', $CcRole)
          ->with('session', $session);
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "Product page not loading properly. Please try again");
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      try {
        Controller::sessionVariables();
        $session = Auth::user();
        $CcNav = CcNav::ordered();
        $CcProductCategory = CcProductCategory::ordered();
        $CcRole = CcRole::all();
        $CcVisibility = CcVisibility::all();
        $CcMediaAlbum = CcMediaAlbum::all();
        $CcMediaItem = CcMediaItem::all();
        return view('admin.commerce.products.create')
          ->with('productCategories', $CcProductCategory)
          ->with('navs', $CcNav)
          ->with('roles', $CcRole)
          ->with('visibility', $CcVisibility)
          ->with('albums', $CcMediaAlbum)
          ->with('items', $CcMediaItem)
          ->with('session', $session);
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "Create product page not loading properly");
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//      try {
        $session = Auth::user();
        $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
        $request->merge(['alias' => $alias, 'create_id' => $session->id, 'update_id' => $session->id]);
        $CcProduct = CcProduct::create($request->all());
        if ($CcProduct) {
          $product_id = $CcProduct['id'];
          $items = $request->items;
          $type_id = $request->type_id;

          if ($items != null) {
            for ($ii = 0; $ii < count($items); $ii++) {
              $item = $items[$ii];
              CcPostMedia::create([
                'item_id' => $item,
                'post_id' => $product_id,
                'post_alias' => $alias,
                'type_id' => $type_id,
                'create_id' => $session->id,
                'update_id' => $session->id
              ]);
            }
          }
        }
        return redirect(route('products.edit', $product_id))->with('success', 'Product detail has been added successfully!');
//      } catch (\Exception $e) {return redirect()->back()->withInput($request->all())->with("error", "There was a problem adding product content");}
    }

    public function publish(Request $request, $id)
    {
      try {
        $session = Auth::user();
        if ($request->switch == 1) {
          $publish = "published";
        } else {
          $publish = "unpublished";
        }
        $request->merge(['update_id' => $session->id]);
        CcProduct::findOrFail($id)->update(['published' => $request->switch]);
        return redirect()->back()->with("success", "Product status updated successfully");
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "There was a problem updating product status");
      }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try {
        Controller::sessionVariables();
        $session = Auth::user();
        $CcProduct = CcProduct::findOrFail($id);
        $CcNav = CcNav::ordered();
        $CcProductCategory = CcProductCategory::ordered();
        $CcRole = CcRole::ordered();
        $CcVisibility = CcVisibility::all();
        $CcMediaAlbum = CcMediaAlbum::ordered();
        $CcPostMedia = CcPostMedia::ordered();
        $CcMediaItem = CcMediaItem::ordered();
        return view('admin.commerce.products.edit')
          ->with('products', $CcProduct)
          ->with('navs', $CcNav)
          ->with('productCategories', $CcProductCategory)
          ->with('roles', $CcRole)
          ->with('visibility', $CcVisibility)
          ->with('albums', $CcMediaAlbum)
          ->with('items', $CcMediaItem)
          ->with('postMedia', $CcPostMedia)
          ->with('session', $session);
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "Edit product page not loading properly");
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $session = Auth::user();
        $request->merge(['update_id' => $session->id]);
        $content = CcProduct::findOrFail($id)->update($request->all());
        if ($content) {
          $content_items = $request->items;
          if ($content_items != null) {
            $type_id = $request->type_id;
            for ($ii = 0; $ii < count($content_items); $ii++) {
              $item = $content_items[$ii];
              CcPostMedia::create([
                'item_id' => $item,
                'post_id' => $id,
                'type_id' => $type_id,
                'create_id' => $session->id,
                'update_id' => $session->id
              ]);
            }
          }
        }
        return redirect()->back()->with('success', 'Product details updated successfully.');
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "There was a problem updating product content");
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        CcProduct::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product has been delete successfully');
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "There was an error deleting product");
      }
    }
  }
