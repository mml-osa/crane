<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\CcAddress;
use App\Models\Select\CcCountry;
use App\Models\Setting\CcSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
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
        Controller::sessionVariables();
        $session = Auth::user();
        $CcAddress = CcAddress::ordered();
        $CcCountry = CcCountry::ordered();
        $CcSwitch = CcSwitch::all();
        return view('admin.profile.address')
            ->with('session',$session)
            ->with('addresses',$CcAddress)
            ->with('switches',$CcSwitch)
            ->with('countries',$CcCountry);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias'=>$alias,'create_id'=>$session->id,'update_id'=>$session->id]);
            CcAddress::create($request->all());
            return redirect()->back()->with('success', 'Address has been added successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the address"); }
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
        $CcAbout = CcAddress::findOrFail($id);
        $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
        $request->merge(['alias'=>$alias,'update_id'=>$session->id]);
        $CcAbout->update($request->all());
        return redirect()->back()->with('success', 'Address has been updated successfully');
    }

    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            if ($request->switch == 1){$publish = "published";} else{$publish = "unpublished";}
            $request->merge(['update_id' => $session->id]);
            CcAddress::findOrFail($id)->update(['published' => $request->switch]);
            return redirect()->back()->with("success", "address $publish successfully");
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem publishing address.");}
    }

    public function main(Request $request,$id)
    {
        try {
            $session = Auth::user();
            if ($request->switch == 1){$publish = "marked";} else{$publish = "marked";}
            $request->merge(['update_id' => $session->id]);
            CcAddress::findOrFail($id)->update(['main' => $request->switch]);
            $Addresses = CcAddress::all();
            foreach($Addresses as $Address) {if ($Address->id != $id) {$Address->update(['main' => 0]);} }
            return redirect()->back()->with("success", "Address $publish successfully");
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem marking address as main.");}
    }

    public function destroy($id)
    {
//        try {
            $CcAddress = CcAddress::findOrFail($id);
            $CcAddress->delete();
            return redirect()->back()->with('success', 'Address has been removed successfully');
//        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was an error removing address."); }
    }
}
