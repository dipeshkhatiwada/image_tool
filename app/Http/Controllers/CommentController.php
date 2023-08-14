<?php

namespace App\Http\Controllers;

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
    public function store(ImageRequest $request)
    {
        if ($request->has('image_file')){
            $imagePhoto = $request->file('image_file');
            $name = rand(1111, 9999).'_'.$imagePhoto->getClientOriginalName();
            $dir = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR ;
            $imagePhoto->move($dir, $name);
            $request->request->add(['image' => $name]);
        }
        $request->request->add(['owner_id' => auth()->user()->id]);
        Image::create($request->all());
        return redirect()->route('image.index')
            ->with('success','Image added successfully!');
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
