<?php

namespace App\Http\Controllers\User\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\McMediaType;
use App\Models\Post\McPostCategory;
use App\Models\Select\McRole;
use App\Models\Setting\McSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $session = Auth::user();
            $McRole = McRole::ordered();
            $McMediaType = McMediaType::ordered();
            $McSetting = McSetting::where('active',1)->first();
            return view('user.media.type.index')
                ->with('roles',$McRole)
                ->with('session',$session)
                ->with('settings', $McSetting)
                ->with('mediaTypes',$McMediaType);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Media type page not loading properly - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
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
        try {
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->type));
            $request->merge(['alias' => $alias,'create_id' => $session->id,'update_id' => $session->id]);
            $McMediaType = McMediaType::create($request->all());
            return redirect()->back()->with('success', 'Media Type created successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem creating media type - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
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
            $request->merge(['update_id' => $session->id]);
            $McMediaType = McMediaType::findOrFail($id)->update($request->all());
            return redirect()->back()->with('success', 'Media type updated successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem updating the media type - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
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
            $McMediaType = McMediaType::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Media type has been delete successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting media type - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()); }
    }
}
