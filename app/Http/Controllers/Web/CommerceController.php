<?php

  namespace App\Http\Controllers\Web;

  use App\Http\Controllers\Controller;
  use App\Models\Commerce\CcProduct;
  use App\Models\Commerce\CcProductCategory;
  use App\Models\Events\CcEvents;
  use App\Models\Media\CcMediaAlbum;
  use App\Models\Media\CcMediaItem;
  use App\Models\Nav\CcNav;
  use App\Models\Post\CcPost;
  use App\Models\Post\CcPostCategory;
  use App\Models\Post\CcPostComment;
  use App\Models\Post\CcPostMedia;
  use App\Models\Services\CcServices;
  use App\Models\Services\CcServicesCategory;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class CommerceController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        Controller::sessionVariables();
        if (session('landing')->state == 1 && !Auth::check()) {
          return view("landing.index");
        } else {
          $CcProduct = CcProduct::where('published','1')->ordered();
          $CcPostMedia = CcPostMedia::all();
          $CcMediaItem = CcMediaItem::all();
          $CcProductCategory = CcProductCategory::where('published','1')->ordered();
          return view("web.store.index")
            ->with('productCategories',$CcProductCategory)
            ->with('products',$CcProduct)
            ->with('postMedia',$CcPostMedia)
            ->with('items',$CcMediaItem)
            ;
        }
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "Online store page not loading properly");
      }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
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
      //
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
      //
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
        CcPostComment::findOrFail($id)->delete();
        CcPostComment::where('comment_id', $id)->delete();
        return redirect()->back()->with('success', 'Comment has been delete successfully');
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "There was an error deleting comment");
      }
    }
  }
