<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\ImageComment;
use DB;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $comments = Comment::get();
        } else {
            $imageArr = Image::where('owner_id', auth()->user()->id)->pluck('id')->toArray();
            $comments = ImageComment::whereIn('image_id', $imageArr)->get();
        }
        return view('comments.index',compact('comments'));
    }
    public function store(CommentRequest $request)
    {
        $request->request->add(['added_by' => auth()->user()->id]);
        ImageComment::create($request->all());
        return redirect()->back()
            ->with('success','Comment added successfully!');
    }
    public function destroy(Request $request, int $id)
    {
       
        if(!$image = Image::find($id)){
            $request->session()->flash('error', 'Image not found !!');
        }
        if($image->delete()){
            $request->session()->flash('success', 'Image Deleted Successful !!');
        }else{
            $request->session()->flash('error', ' Failed to Delete Image !!');
        }
        return redirect()->route('image.index');
    }
}
