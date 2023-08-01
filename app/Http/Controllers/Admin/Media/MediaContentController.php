<?php

namespace App\Http\Controllers\admin\Media;

use App\Models\Auth\User;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Media\CcMediaType;
use App\Models\Select\CcRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MediaContentController extends Controller
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
    public function image()
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaType = CcMediaType::ordered();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view("admin.media.image.index")
                ->with('roles',$CcRole)
                ->with('type',$CcMediaType)
                ->with('albums',$CcMediaAlbum)
                ->with('items',$CcMediaItem)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Image media not loading properly"); }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function audio()
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaType = CcMediaType::ordered();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view("admin.media.audio.index")
                ->with('roles',$CcRole)
                ->with('type',$CcMediaType)
                ->with('albums',$CcMediaAlbum)
                ->with('items',$CcMediaItem)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Audio media page not loading properly"); }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function video()
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaType = CcMediaType::ordered();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view("admin.media.video.index")
                ->with('roles',$CcRole)
                ->with('type',$CcMediaType)
                ->with('albums',$CcMediaAlbum)
                ->with('items',$CcMediaItem)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Video media page not loading properly"); }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function document()
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaType = CcMediaType::ordered();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view("admin.media.document.index")
                ->with('roles',$CcRole)
                ->with('type',$CcMediaType)
                ->with('albums',$CcMediaAlbum)
                ->with('items',$CcMediaItem)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Document media page not loading properly"); }
    }

    public function caption(Request $request)
    {
        try {
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias'=>$alias,'update_id' => $session->id]);
            $item_id = $request->item_id;
            $CcMediaItem = CcMediaItem::findOrFail($item_id);
            $CcMediaItem->update($request->all());
            return redirect()->back()->with('success', 'Media item caption has been created successfully!');
        } catch (\Exception $e) {return redirect()->back()->withInput($request->all())->with("error", "There was a problem adding media item caption");}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id,$type)
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaAlbum = CcMediaAlbum::findOrFail($id);
            $CcMediaAlbums = CcMediaAlbum::ordered();
            $CcMediaType = CcMediaType::ordered();
            return view("admin.media.$type.create")
                ->with('roles',$CcRole)
                ->with('type',$CcMediaType)
                ->with('album',$CcMediaAlbum)
                ->with('albums',$CcMediaAlbums)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Page not loading properly"); }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,$id,$type)
    {
        try {
            $session = Auth::user();
            $CcMediaAlbum = CcMediaAlbum::findOrFail($id);
            $album_name = $CcMediaAlbum->alias;
            $request->merge(['create_id'=>$session->id,'update_id' => $session->id,'album_id' => $id]);
            $items = CcMediaItem::create($request->all());
            if ($request->hasFile('file')) {
                $file = $request->file;
                //Get Filename With The Extension
                $fileNameOnly = $file->getClientOriginalName();
                //Get Just Filename
                $fileName = pathinfo($fileNameOnly, PATHINFO_FILENAME);
                //Get Just Extension
                $fileNameWithExtension = $file->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore = $fileName.".".$fileNameWithExtension;
                //Upload Image
                if ($CcMediaAlbum->sub_id != null){
                    $album = $CcMediaAlbum->mainAlbum['alias'];
                    $path = $file->storeAs("public/web/album/$album/$album_name", $fileNameToStore);
                }
                else{
                    $path = $file->storeAs("public/web/album/$album_name", $fileNameToStore);
                }
                if($path){
                    $items->update(['file' => $fileNameToStore]);
                }
            }
            return redirect()->back()->with('success', 'Media item has been created successfully!');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing media item"); }
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
    public function edit($id, $type_id, Request $request)
    {
        try{
            $session = Auth::user();
            $McMediaItem = McMediaItem::findOrFail($id);
            $existingFile = $McMediaItem->file;
            $McMediaAlbum = McMediaAlbum::findOrFail($request->album_id);
            $album_alias = $McMediaAlbum->alias;
            $request->merge(['update_id' => $session->id]);

            if ($request->hasFile('file')) {
                $file = $request->file;
                //Get Filename With The Extension
                $filenameWithExt = $file->getClientOriginalName();
                //Get Just Filename
                $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get Just Extension
                $fileExtension = $file->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore = $fileName.".".$fileExtension;
                //Upload Image
                if ($McMediaAlbum->sub == 1){
                    $album = $McMediaAlbum->album['alias'];
                    //Delete existing file
                    Storage::delete("web/album/$album/$album_alias/$existingFile");
                    $path = $file->storeAs("web/album/$album/$album_alias", $fileNameToStore);
                }
                else{
                    Storage::delete("web/album/$album_alias/$existingFile");
                    $path = $file->storeAs("web/album/$album_alias", $fileNameToStore);
                }
                $request->merge(['file' => $fileNameToStore]);
                $update = $McMediaItem->update(['file' => $fileNameToStore,'update_id' => $session->id]);
            }

            return redirect()->back()->with('success', 'Media item has been changed successfully!');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem replacing this image - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
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
        //
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
            $McMediaItem = McMediaItem::findOrFail($id)->update(['published' => $request->switch,'update_id' => $session->id]);
            return redirect()->back()->with('success', 'Media item has been published successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing media item - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $item_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        try {
            $albumItems = McMediaItem::where('album_id',$id)->get();
            foreach($albumItems as $albumItem) {
                $McMediaAlbum = McMediaAlbum::findOrFail($id);
                $album_name = $McMediaAlbum->alias;
                Storage::delete("web/album/$album_name/$albumItem->file");
                $McMediaItem = McMediaItem::findOrFail($albumItem->id)->delete();
            }
            return redirect()->back()->with('success', 'Media item has been deleted successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting media item - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $item_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $McMediaItem = McMediaItem::findOrFail($id);
            $McMediaAlbum = McMediaAlbum::findOrFail($McMediaItem->album_id);
            $album_name = $McMediaAlbum->alias;
            Storage::delete("web/album/$album_name/$McMediaItem->file");
            $McMediaItem = McMediaItem::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Media item has been deleted successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting media item - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
    }
}
