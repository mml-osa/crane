<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Nav\CcNav;
use App\Models\Nav\CcNavCat;
use App\Models\Pages\CcPage;
use App\Models\Post\CcPost;
use App\Models\Post\CcPostCategory;
use App\Models\Post\CcPostMedia;
use App\Models\Select\CcRole;
use App\Models\Select\CcVisibility;
use App\Models\Services\CcServices;
use App\Models\Services\CcServicesCategory;
use App\Models\Services\CcServicesMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
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
            $CcServices = CcServices::ordered();
            return view('admin.services.index')
                ->with('services', $CcServices)
                ->with('roles', $CcRole)
                ->with('session', $session);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Service page not loading properly. Please try again");
        }
    }

    public function create()
    {
        try {
            Controller::sessionVariables();
            $session = Auth::user();
            $CcNav = CcNav::ordered();
            $CcServicesCategory = CcServicesCategory::ordered();
            $CcRole = CcRole::all();
            $CcVisibility = CcVisibility::all();
            $CcMediaAlbum = CcMediaAlbum::all();
            $CcMediaItem = CcMediaItem::all();
            return view('admin.services.create')
                ->with('serviceCategories', $CcServicesCategory)
                ->with('navs', $CcNav)
                ->with('roles', $CcRole)
                ->with('visibility', $CcVisibility)
                ->with('albums', $CcMediaAlbum)
                ->with('items', $CcMediaItem)
                ->with('session', $session);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Create services page not loading properly");
        }
    }

    public function store(Request $request)
    {
        try {
          $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $exists = CcServices::where('alias', $alias)->first();
            if ($exists != null) {
                return redirect()->back()->with('error', 'Service already exists. Please use a different name');
            } else {
                $session = Auth::user();
                $alias = strtolower(preg_replace('/\s+/', '-', $request->name));
                $nav = CcNav::where('alias', 'services')->first();

                //Creating A Page For The Category
                if (!file_exists("resources/views/web/services")) {
                    mkdir("resources/views/web/services", 0777, true);
                }
                if (!file_exists("resources/views/web/services/$alias")) {
                    $pageFile = fopen("resources/views/web/services/$alias.blade.php", "w") or die("Unable to open file!");
                    $txt = "@extends('web.layout.view.main')\n@section('content')\n\n@endsection";
                    fwrite($pageFile, $txt);
                    fclose($pageFile);
                }
                $request->merge(['alias' => $alias, 'create_id' => $session->id, 'update_id' => $session->id]);
                $order = CcNav::orderBy('order', 'DESC')->first();
                $CcServices = CcServices::create($request->all());

                if ($CcServices) {
                    $navCat = CcNavCat::where('alias', 'main')->first();
                    CcNav::create([
                        'title' => $request->name,
                        'alias' => $alias,
                        'page_id' => "$CcServices->id",
                        'sub' => 1,
                        'level' => 1,
                        'parent_id' => $nav->id,
                        'order' => $order->order + 1,
                        'cat_id' => "$navCat->id",
                        'create_id' => $session->id,
                    ]);
                }
                $service_id = $CcServices['id'];
                $items = $request->items;
                $type_id = $request->type_id;

                if ($items != null) {
                    for ($ii = 0; $ii < count($items); $ii++) {
                        $item = $items[$ii];
                        CcServicesMedia::create([
                            'item_id' => $item,
                            'service_id' => $service_id,
                            'service_alias' => $alias,
                            'type_id' => $type_id,
                            'featured' => $request->featured,
                            'create_id' => $session->id,
                            'update_id' => $session->id
                        ]);
                    }
                }
            }
            return redirect(route('services.edit', $service_id))->with('success', 'Service content has been added successfully!');
        } catch (\Exception $e) { return redirect()->back()->withInput($request->all())->with("error", "There was a problem adding service content");}
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
            CcServices::findOrFail($id)->update(['published' => $request->switch]);
            return redirect()->back()->with("success", "Category status updated successfully");
        } catch (\Exception $e) {return redirect()->back()->with("error", "There was a problem updating category status post");}
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
            $CcServices = CcServices::findOrFail($id);
            $CcNav = CcNav::ordered();
            $CcServicesCategory = CcServicesCategory::ordered();
            $CcRole = CcRole::ordered();
            $CcVisibility = CcVisibility::all();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcServicesMedia = CcServicesMedia::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view('admin.services.edit')
                ->with('services', $CcServices)
                ->with('navs', $CcNav)
                ->with('serviceCategories', $CcServicesCategory)
                ->with('roles', $CcRole)
                ->with('visibility', $CcVisibility)
                ->with('albums', $CcMediaAlbum)
                ->with('items', $CcMediaItem)
                ->with('serviceMedia', $CcServicesMedia)
                ->with('session', $session);
        } catch (\Exception $e) {return redirect()->back()->with("error", "Edit services page not loading properly");}
    }

    public function update(Request $request, $id)
    {
//        try {
            $session = Auth::user();
            if ($request->cat_id == null){ $request->merge(['cat_id' => null]); }
            $request->merge(['update_id' => $session->id]);

            $content = CcServices::findOrFail($id)->update($request->all());
            if ($content) {
                $content_items = $request->items;
                if ($content_items != null) {
                    $type_id = $request->type_id;
                    for ($ii = 0; $ii < count($content_items); $ii++) {
                        $item = $content_items[$ii];
                        $CcServicesMedia = CcServicesMedia::where('service_id',$id)->where('featured',"$request->featured")->first();
                        if ($CcServicesMedia != null) {
                            $CcServicesMedia->update([
                                'item_id' => $item,
                                'service_id' => $id,
                                'type_id' => $type_id,
                                'featured' => $request->featured,
                                'create_id' => $session->id,
                                'update_id' => $session->id
                            ]);
                        }
                        else {
                            CcServicesMedia::create([
                                'item_id' => $item,
                                'service_id' => $id,
                                'type_id' => $type_id,
                                'featured' => $request->featured,
                                'create_id' => $session->id,
                                'update_id' => $session->id
                            ]);
                        }
                    }
                }
            }
            return redirect()->back()->with('success', 'Service content updated successfully.');
//        } catch (\Exception $e) {return redirect()->back()->with("error", "There was a problem updating service content");}
    }

    public function remove_featured($id)
    {
        try {
            CcServicesMedia::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Featured media has been removed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error removing featured media");
        }
    }

    public function remove_featured_all($id)
    {
        try {
            CcServicesMedia::where('post_id', $id)->delete();
            return redirect()->back()->with('success', 'All featured media has been removed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error removing all featured media");
        }
    }

    public function destroy($id)
    {
        try {
            $CcServices = CcServices::findOrFail($id);
            $alias = $CcServices->alias;
            $filePath = "resources/views/web/service/$alias";
//            if (!file_exists("$filePath")) {
//                \File::delete($filePath);
//            }
            CcNav::where('sub', 1)->where('alias', $alias)->delete();
            $CcServices->delete();
            return redirect(route('services.index'))->with('success', 'Service has been delete successfully');
        } catch (\Exception $e) {return redirect()->back()->with("warning", "There was an error deleting service.");}
    }
}
