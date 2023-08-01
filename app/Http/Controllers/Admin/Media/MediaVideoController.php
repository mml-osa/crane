<?php

namespace App\Http\Controllers\Admin\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Media\CcMediaType;
use App\Models\Select\CcRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class MediaVideoController extends Controller
{
    public function create($id)
    {
        try{
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcMediaAlbum = CcMediaAlbum::findOrFail($id);
            $CcMediaAlbums = CcMediaAlbum::ordered();
            $CcMediaType = CcMediaType::ordered();
            return view('admin.media.video.create')
                ->with('roles',$CcRole)
                ->with('type',$CcMediaType)
                ->with('album',$CcMediaAlbum)
                ->with('albums',$CcMediaAlbums)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Page not loading properly"); }
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

    public function store(Request $request, $id)
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
    public function edit(Request $request, $id)
    {
//        try{
            $session = Auth::user();
            $CcMediaItem = CcMediaItem::findOrFail($id);
            $existingFile = $CcMediaItem->file;
            $CcMediaAlbum = CcMediaAlbum::findOrFail($request->album_id);
            $album_alias = $CcMediaAlbum->alias;

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
                if ($CcMediaAlbum->sub == 1){
                    $album = $CcMediaAlbum->mediaAlbum['alias'];
                    //Delete existing file
                    Storage::delete("public/web/album/$album/$album_alias/$existingFile");
                    $file->storeAs("public/web/album/$album/$album_alias", $fileNameToStore);
                }
                else{
                    Storage::delete("public/web/album/$album_alias/$existingFile");
                    $file->storeAs("public/web/album/$album_alias", $fileNameToStore);
                }
                $request->merge(['file' => $fileNameToStore,'update_id' => $session->id]);
                $CcMediaItem->update(['file' => $fileNameToStore,'update_id' => $session->id]);
            }
            return redirect()->back()->with('success', 'Media item has been changed successfully!');
//        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem replacing this image"); }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            $request->merge(['update_id' => $session->id]);
            CcMediaItem::findOrFail($id)->update(['published' => $request->switch,'update_id' => $session->id]);
            return redirect()->back()->with('success', 'Media item has been published successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing media item"); }
    }

    public function remove($id)
    {
        try {
            $subAlbum = CcMediaAlbum::findOrFail($id);
            $albumItems = CcMediaItem::where('album_id',$id)->get();
            $subName = $subAlbum->alias;

            if ($subAlbum->sub == 1){
                $mainAlbum = CcMediaAlbum::findOrFail($subAlbum->sub_id);
                $mainName = $mainAlbum->alias;
                if(Storage::exists("/public/web/album/$mainName/$subName")) {
                  Storage::deleteDirectory("/public/web/album/$mainName/$subName");
                }
            }
            else{
                $mainAlbum = CcMediaAlbum::findOrFail($subAlbum->sub_id);
                $mainName = $mainAlbum->alias;
                    if(Storage::exists("/public/web/album/$mainName")) {
                        Storage::deleteDirectory("/public/web/album/$mainName");
                    }
            }
            foreach($albumItems as $albumItem) {
                $CcMediaAlbum = CcMediaAlbum::findOrFail($id);
//                $album_name = $CcMediaAlbum->alias;
//                Storage::delete("public/web/album/$album_name/$albumItem->file");
                CcMediaItem::findOrFail($albumItem->id)->delete();
            }
            return redirect()->back()->with('success', 'Media item has been deleted successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting all media item for the ".$subAlbum->title." album"); }
    }

    public function destroy($id)
    {
        try {
            $McMediaItem = CcMediaItem::findOrFail($id);
            $McMediaAlbum = CcMediaAlbum::findOrFail($McMediaItem->album_id);
            $album_name = $McMediaAlbum->alias;
            Storage::delete("public/web/album/$album_name/$McMediaItem->file");
            CcMediaItem::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Media item has been deleted successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting media item"); }
    }
}
