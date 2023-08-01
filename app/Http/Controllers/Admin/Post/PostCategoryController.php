<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\CcPost;
use App\Models\Post\CcPostCategory;
use App\Models\Select\CcRole;
use App\Models\Services\CcServicesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCategoryController extends Controller
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

    public function index()
    {
        try{
            Controller::sessionVariables();
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcPostCategory = CcPostCategory::ordered();
            return view('admin.posts.categories')
                ->with('session',$session)
                ->with('roles',$CcRole)
                ->with('postCategories',$CcPostCategory);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Post categories page not loading properly"); }
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
            CcPostCategory::create($request->all());
            return redirect()->back()->with('success', 'Post category has been added successfully');
//        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the post category"); }
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
        CcPostCategory::findOrFail($id)->update(['published' => $request->switch]);
        return redirect()->back()->with("success", "Post category status updated successfully");
      } catch (\Exception $e) {
        return redirect()->back()->with("error", "There was a problem updating post category post");
      }
    }

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

    public function update(Request $request, $id)
    {
        try {
            $session = Auth::user();
            $CcPostCategory = CcPostCategory::findOrFail($id);
            $request->merge(['update_id' => $session->id]);
            $CcPostCategory->update($request->all());
            return redirect()->back()->with('success', 'Post category has been updated successfully');
        }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating post category"); }
    }

    public function destroy($id)
    {
        try {
            CcPost::where('cat_id',$id)->delete();
            CcPostCategory::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Post category has been delete successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting post"); }
    }
}
