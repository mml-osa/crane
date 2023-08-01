<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\CcLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Controller::sessionVariables();
        $session = Auth::user();
        $CcLogo = CcLogo::all();
        return view('admin.profile.logo')
            ->with('session',$session)
            ->with('logos',$CcLogo);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $session = Auth::user();
            if($request->title == null) {$request->merge(['title' => 'Logo']);; }
            $request->merge(['create_id' => $session->id]);
            $file = $request->img;
            if ($request->hasFile('img')) {
                //Get Filename With The Extension
                $filenameWithExt = $file->getClientOriginalName();
                //Get Just Filename
                $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get Just Extension
                $fileExtension = $file->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore = time() . '.' . $fileExtension;
                //Upload Image
                $path = $file->storeAs("public/web/logo", $fileNameToStore);
                $CcLogo = CcLogo::create($request->except('img'));
                $CcLogo->update(['img' => $fileNameToStore]);
            }
            return redirect()->back()->with("success", "Logo was updated successfully");

        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem adding logo"); }
    }

    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            if ($request->switch == 1){$publish = "published";} else{$publish = "unpublished";}
            $cat = $request->category;
            $request->merge(['alias' => $alias, 'update_id' => $session->id]);
            $CcLogo = CcLogo::findOrFail($id)->update(['published' => $request->switch]);
            $Logos = CcLogo::all();
            foreach($Logos as $Logo) {if ($Logo->id != $id && $Logo->alias != 'favicon') {$Logo->update(['published' => 0]);} }
            return redirect()->back()->with("success", "Logo $publish successfully");
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem publishing logo.");}
    }

    public function favicon(Request $request,$id)
    {
        try {
            $session = Auth::user();
            if ($request->switch == 1){$publish = "enabled";} else{$publish = "disabled";}
            $cat = $request->category;
            $request->merge(['update_id' => $session->id]);
            $CcLogo = CcLogo::findOrFail($id)->update(['favicon' => $request->switch]);
            $Logos = CcLogo::all();
            foreach($Logos as $Logo) {if ($Logo->id != $id) {$Logo->update(['favicon' => 0]);} }
            return redirect()->back()->with("success", "Logo $publish as favicon successfully");
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem publishing page.");}
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
        $session = Auth::user();
        $request->merge(['update_id' => $session->id]);
        $CcLogo=CcLogo::where('id',$id)->first();

        $file = $request->img;
        if ($request->hasFile('img')) {
            $path = storage_path("app/public/web/logo/$CcLogo->img");
            if(File::exists($path)) { Storage::delete("public/web/logo/$CcLogo->img"); }
            //Get Filename With The Extension
            $filenameWithExt = $file->getClientOriginalName();
            //Get Just Filename
            $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Just Extension
            $fileExtension = $file->getClientOriginalExtension();
            //Filename To Store
            $fileNameToStore = time() . '.' . $fileExtension;
            //Upload Image
            $path = $file->storeAs("public/web/logo/", $fileNameToStore);
            $CcLogo->update(['img' => $fileNameToStore]);
        }
        $CcLogo->update($request->except('img'));
        return redirect()->back()->with("success", "Logo was updated successfully");
    }

    public function destroy($id)
    {
        try {
            $CcLogo = CcLogo::findOrFail($id);
            $path = storage_path("app/public/web/logo/$CcLogo->img");
            if(File::exists($path)) {
                $delLogo = Storage::delete("public/web/logo/$CcLogo->img");
                if ($delLogo) { $CcLogo->delete(); return redirect()->back()->with('success', 'Logo has been removed successfully');}
                else { return redirect()->back()->with('error', 'Logo cannot be removed at this time'); }
            }
            else {
                return redirect()->back()->with('error', 'Logo file does not exist');
            }
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was an error removing logo."); }
    }
}
