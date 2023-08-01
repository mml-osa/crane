<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Nav\CcNav;
use App\Models\Nav\CcNavCat;
use App\Models\Pages\CcPage;
use App\Models\Pages\CcPagesCategory;
use App\Models\Pages\CcPagesMedia;
use App\Models\Post\CcPost;
use App\Models\Select\CcRole;
use App\Models\Select\CcVisibility;
use Faker\Provider\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    try {
      Controller::sessionVariables();
      $session = Auth::user();
      $CcRole = CcRole::ordered();
      $CcPost = CcPost::ordered();
      $CcPage = CcPage::ordered();
      $CcVisibility = CcVisibility::all();
      return view('admin.pages.index')
        ->with('pages', $CcPage)
        ->with('posts', $CcPost)
        ->with('roles', $CcRole)
        ->with('visibility', $CcVisibility)
        ->with('session', $session);
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Page not loading properly. Please try again");
    }
  }

  public function create()
  {
    try {
      Controller::sessionVariables();
      $session = Auth::user();
      $CcNav = CcNav::ordered();
      $CcPagesCategory = CcPagesCategory::ordered();
      $CcRole = CcRole::all();
      $CcVisibility = CcVisibility::all();
      $CcMediaAlbum = CcMediaAlbum::all();
      $CcMediaItem = CcMediaItem::all();
      $CcPagesMedia = CcPagesMedia::ordered();
      return view('admin.pages.create')
        ->with('pageCategories', $CcPagesCategory)
        ->with('navs', $CcNav)
        ->with('roles', $CcRole)
        ->with('visibility', $CcVisibility)
        ->with('albums', $CcMediaAlbum)
        ->with('items', $CcMediaItem)
        ->with('pagesMedia', $CcPagesMedia)
        ->with('session', $session);
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Page not loading properly. Please try again");
    }
  }

  public function store(Request $request)
  {
//        try {
    $session = Auth::user();
    $alias = strtolower(preg_replace('/\s+/', '-', $request->name));
    $exists = CcPage::where('alias', $alias)->first();
    if ($exists != null) {
      return redirect()->back()->with('error', 'Page already exists. Please use a different name');
    } else {
      //Creating A Page For The Category
      if (!file_exists("resources/views/web/$alias")) {
        mkdir("resources/views/web/$alias", 0777, true);
        $pageFile = fopen("resources/views/web/$alias/index.blade.php", "w") or die("Unable to open file!");
        $txt = "@extends('web.layout.main')\n@section('content')\n\n@endsection";
        fwrite($pageFile, $txt);
        fclose($pageFile);
      }
      $request->merge(['alias' => $alias, 'create_id' => $session->id, 'update_id' => $session->id]);
      $CcPage = CcPage::create($request->all());
      $order = CcNav::orderBy('order', 'DESC')->first();

      if ($CcPage) {
        $navCat = CcNavCat::where('alias', 'main')->first();
        $CcNav = CcNav::where('alias', $alias)->first();
        if ($CcNav == null) {
          CcNav::create([
            'title' => $request->name,
            'alias' => $alias,
            'route' => $alias,
            'url' => $alias,
            'page_id' => "$CcPage->id",
            'order' => $order->order + 1,
            'cat_id' => "$navCat->id",
            'create_id' => $session->id,
          ]);
        } else {
          return redirect()->back()->with('warning', 'Navigation already exists. Page has been created anyway');
        }
      }

      $page_id = $CcPage['id'];
      $items = $request->items;
      $type_id = $request->type_id;

      if ($items != null) {
        for ($ii = 0; $ii < count($items); $ii++) {
          $item = $items[$ii];
          CcPagesMedia::create([
            'item_id' => $item,
            'page_id' => $page_id,
            'page_alias' => $alias,
            'type_id' => $type_id,
            'create_id' => $session->id,
            'update_id' => $session->id
          ]);
        }
      }
    }
    return redirect()->back()->with('success', 'Page created successfully');
//        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem creating the page"); }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    try {
      Controller::sessionVariables();
      $session = Auth::user();
      $CcPage = CcPage::findOrFail($id);
      $CcNav = CcNav::ordered();
      $CcPagesCategory = CcPagesCategory::ordered();
      $CcRole = CcRole::ordered();
      $CcVisibility = CcVisibility::all();
      $CcMediaAlbum = CcMediaAlbum::ordered();
      $CcPagesMedia = CcPagesMedia::ordered();
      $CcMediaItem = CcMediaItem::ordered();
      return view('admin.pages.edit')
        ->with('pages', $CcPage)
        ->with('navs', $CcNav)
        ->with('pagesCategories', $CcPagesCategory)
        ->with('roles', $CcRole)
        ->with('visibility', $CcVisibility)
        ->with('albums', $CcMediaAlbum)
        ->with('items', $CcMediaItem)
        ->with('pagesMedia', $CcPagesMedia)
        ->with('session', $session);
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Edit page not loading properly");
    }
  }

  public function update(Request $request, $id)
  {
//        try {
    $session = Auth::user();
    $request->merge(['update_id' => $session->id]);

    $content = CcPage::findOrFail($id)->update($request->all());
    if ($content) {
      $content_items = $request->items;
      if ($content_items != null) {
        $type_id = $request->type_id;
        for ($ii = 0; $ii < count($content_items); $ii++) {
          $item = $content_items[$ii];
          $CcPagesMedia = CcPagesMedia::where('page_id', $id)->where('featured', "$request->featured")->first();
          if ($CcPagesMedia != null) {
            $CcPagesMedia->update([
              'item_id' => $item,
              'page_id' => $id,
              'type_id' => $type_id,
              'featured' => $request->featured,
              'create_id' => $session->id,
              'update_id' => $session->id
            ]);
          } else {
            CcPagesMedia::create([
              'item_id' => $item,
              'page_id' => $id,
              'type_id' => $type_id,
              'featured' => $request->featured,
              'create_id' => $session->id,
              'update_id' => $session->id
            ]);
          }
        }
      }
    }
    return redirect()->back()->with('success', 'Page content updated successfully.');
//        } catch (\Exception $e) {return redirect()->back()->with("error", "There was a problem updating page content");}
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
      CcPage::findOrFail($id)->update(['published' => $request->switch]);
      return redirect()->back()->with("success", "Category $publish successfully");
    } catch (\Exception $e) {
      return redirect()->back()->with("warning", "There was a problem publishing page.");
    }
  }

  public function remove_featured($id, $featured)
  {
    try {
      CcPagesMedia::findOrFail($id)->where('featured', $featured)->delete();
      return redirect()->back()->with('success', 'Featured image has been removed successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "There was an error removing featured image");
    }
  }

  public function remove_featured_all($id)
  {
    try {
      CcPagesMedia::where('page_id', $id)->delete();
      return redirect()->back()->with('success', 'All featured media has been removed successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "There was an error removing all featured media");
    }
  }

  public function destroy(Request $request, $id)
  {
    try {
      $CcPage = CcPage::findOrFail($id);
      $filePath = "resources/views/web/$CcPage->alias";
      if (file_exists($filePath)) {
//                dd($filePath);
        \File::deleteDirectory($filePath);
      }
      CcNav::where('alias', $CcPage->alias)->delete();
      $CcPage->delete();
      return redirect()->back()->with('success', 'page has been delete successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with("warning", "There was an error deleting page.");
    }
  }
}
