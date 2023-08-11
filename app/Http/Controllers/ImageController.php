<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ImageController extends Controller
{

    public function index()
    {
        $data['image'] = Image::where(function($query) {
            if (!auth()->user()->is_admin) {
                $query->where('owner', auth()->user()->id);
            }
        })->get();
        return view('image.index',compact('data'));
    }
    public function create()
    {
        $data = [];
        
        return view('image.create',compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:images',
            'description' => 'required',
            'price' => 'required',
        ]);
        if ($request->has('img_photo')){
            $photo = $request->file('img_photo');
            $path = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR ;
            $photo_name = rand(111, 999).'_'.$photo->getClientOriginalName();
            $photo->move($path, $photo_name);
            $request->request->add(['photo' => $photo_name]);
        }
        $request->request->add(['owner' => auth()->user()->id]);
        Image::create($request->all());
       
        return redirect()->route('image.index')
            ->with('success','Image created successfully.');
    }

    public function show(int $id)
    {
        
        $data['image'] = Image::find($id);
        if (!$data['image']) {
            request()->session()->flash('error', 'Invalid request!!!');
            return redirect()->route('image.index');
        }
        
        return view('image.show',compact('data'));
    }
    public function edit(int $id)
    {
        $data['image'] = Image::find($id);
        if (!$data['image']) {
            request()->session()->flash('error', 'Invalid request!!!');
            return redirect()->route('image.index');
        }
        return view('image.edit',compact('data'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
          'title' => [
            'required','max:255',
            Rule::unique('images')->ignore($id),
          ],
          'description' => 'required',
          'price'       => 'required',
        ]);
        $data['image'] = Image::find($id);
        if (!$data['image']) {
            request()->session()->flash('error_message', 'Invalid request for details');
            return redirect()->route('gallery_image.index');
        }
        if ($request->has('img_photo')){
            $photo = $request->file('img_photo');
            $path = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR ;
            $photo_name = rand(111, 999).'_'.$photo->getClientOriginalName();
            $photo->move($path, $photo_name);
            $request->request->add(['photo' => $photo_name]);
        }
        $image = $data['image']->update($request->all());
        if ($image) {
            $request->session()->flash('success', 'Image Update Successfully ');
        } else {
            $request->session()->flash('error', 'Image Update Failed');
        }
        return redirect()->route('image.index');
    }

    public function destroy(Request $request, int $id)
    {
       
        if(!$data['image'] = Image::find($id)){
            $request->session()->flash('error', 'Invalid request!');
        }
        if($data['image']->delete()){
            $request->session()->flash('success', 'Image Deletion Successful!');
        }else{
            $request->session()->flash('error', ' Image Deletion Failed!');
        }
        return redirect()->route('image.index');
    }
}
