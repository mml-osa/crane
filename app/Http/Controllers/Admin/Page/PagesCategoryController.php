<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Pages\CcPagesCategory;
use App\Models\Post\CcPostCategory;
use App\Models\Select\CcRole;
use App\Models\Services\CcServicesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcPagesCategory = CcPagesCategory::ordered();
            return view('admin.pages.categories')
                ->with('session',$session)
                ->with('roles',$CcRole)
                ->with('pagesCategories',$CcPagesCategory);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Page categories page not loading properly"); }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
//        try {
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias'=>$alias,'create_id'=>$session->id,'update_id'=>$session->id]);
            CcPagesCategory::create($request->all());
            return redirect()->back()->with('success', 'Page category has been added successfully');
//        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the service category"); }
    }

    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            if ($request->switch == 1){ $publish = "published"; } else{ $publish = "unpublished"; }
            $request->merge(['update_id' => $session->id]);
            CcPagesCategory::findOrFail($id)->update(['published' => $request->switch]);
            return redirect()->back()->with("success", "Page category status updated successfully");
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem updating page category post");}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $session = Auth::user();
            $CcServicesCategory = CcServicesCategory::findOrFail($id);
            $request->merge(['update_id' => $session->id]);
            $CcServicesCategory->update($request->all());
            return redirect()->back()->with('success', 'Service category has been updated successfully');
        }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating service category"); }
    }

    public function destroy($id)
    {
        try {
            CcServicesCategory::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Service category has been delete successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting service category"); }
    }
}
