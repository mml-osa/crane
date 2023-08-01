<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Events\CcEvents;
use App\Models\Post\CcPostComment;
use App\Models\Post\CcPostCommentReply;
use App\Models\Post\McPostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Controller::sessionVariables();
        $session = Auth::user();
        $CcPostComment = CcPostComment::ordered();
        $CcPostCommentReply = CcPostCommentReply::ordered();
        return view('admin.comment.index')
            ->with('session',$session)
            ->with('comments',$CcPostComment)
            ->with('replies',$CcPostCommentReply)
            ;
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
        //
    }

    /**
     * Activate category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            $request->merge(['update_id' => $session->id]);
            if($request->reply == 1){ CcPostCommentReply::findOrFail($id)->update(['published' => $request->switch]); }
            elseif($request->reply == 0){ CcPostComment::findOrFail($id)->update(['published' => $request->switch]); }
            return redirect()->back()->with("success", "Comment publish status updated successfully");
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing comment");}
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
        //
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
        CcPostComment::findOrFail($id)->delete();
        CcPostCommentReply::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Comment has been delete successfully');
      } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting comment"); }
    }
}
