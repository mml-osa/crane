<?php

namespace App\Http\Controllers\Admin\Media;

use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Media\CcMediaType;
use App\Models\Select\CcRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaAlbumController extends Controller
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaType = CcMediaType::ordered();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view("admin.media.album.index")
                ->with('roles',$CcRole)
                ->with('albums',$CcMediaAlbum)
                ->with('items',$CcMediaItem)
                ->with('mediaTypes',$CcMediaType)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Page not loading properly"); }
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $session = Auth::user();
            $type = $request->type_id;
            $sub_id = $request->sub_id;
            if ($sub_id != null) { CcMediaAlbum::findOrFail($sub_id)->update(['sub'=>'1']); }
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias' => $alias, 'create_id' => $session->id, 'update_id' => $session->id, 'type_id' => $type]);
            CcMediaAlbum::create($request->all());
            return redirect()->back()->with('success', 'Media album has been created successfully!');
        } catch (\Exception $e) { return redirect()->back()->withInput($request->all())->with("error", "There was a problem creating media album"); }
    }

    /**
     * Activate category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $album_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            CcMediaAlbum::findOrFail($id)->update(['published' => $request->switch]);
            $request->merge(['update_id' => $session->id]);
            return redirect()->back()->with('success', 'Media album has been published successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing media album"); }
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        try {
            $session = Auth::user();
            $sub_id = $request->sub_id;
            $request->merge(['update_id' => $session->id]);
            if ($sub_id != null) { $request->merge(['sub' => 1]); } else{ $request->merge(['sub' => 0]); }
            CcMediaAlbum::findOrFail($id)->update($request->all());
            return redirect()->back()->with('success','Media album updated successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error","There was a problem updating media album - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request,$id)
    {
        try {
            $CcMediaAlbum = CcMediaAlbum::findOrFail($id);
            $album_name = $CcMediaAlbum->alias;
            if(!Storage::exists("/app/public/web/album/$album_name")) {
                Storage::deleteDirectory("/app/public/web/album/$album_name");
            }
            $CcMediaItems = CcMediaItem::where('album_id',$CcMediaAlbum->id)->get();
            foreach($CcMediaItems as $CcMediaItem){
                $CcMediaItem->delete();
            }
            $CcMediaAlbum->delete();
            return redirect()->back()->with('success', 'Media album has been deleted successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting media album"); }
    }
}
