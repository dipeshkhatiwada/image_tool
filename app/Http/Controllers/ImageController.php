<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use DB;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::where(function ($query) {
            if (!(auth()->user()->role == 'admin')) {
                $userId = auth()->user()->id;
                $query->where('owner_id', $userId);
            }
        })->get();
        return view('image.index', compact('images'));
    }

    public function store(ImageRequest $request)
    {
        if ($request->has('image_file')) {
            $dir = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
            $imagePhoto = $request->file('image_file');
            $name = rand(1111, 9999) . $imagePhoto->getClientOriginalName();
            $imagePhoto->move($dir, $name);
            $request->request->add(['image' => $name]);
        }
        $request->request->add(['owner_id' => auth()->user()->id]);
        Image::create($request->all());
        return redirect()->route('image.index')
          ->with('success', 'Image added successfully!');
    }

    public function create()
    {
        return view('image.create');
    }

    public function show(int $id)
    {
        $data['image'] = Image::find($id);
        if (!$data['image']) {
            request()->session()->flash('error', 'Invalid request!!!');
            return redirect()->route('image.index');
        }

        return view('image.show', compact('data'));
    }

    public function edit(int $id)
    {
        $image = Image::find($id);
        if (!$image) {
            request()->session()->flash('error', 'Image not found !!');
            return redirect()->route('image.index');
        }
        return view('image.edit', compact('image'));
    }

    public function update(ImageRequest $request, int $id)
    {
        $image = Image::find($id);
        if (!$image) {
            request()->session()->flash('error_message', 'Invalid request for details');
            return redirect()->route('gallery_image.index');
        }
        if ($request->has('image_file')) {
            $dir = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
            $imagePhoto = $request->file('image_file');
            $name = rand(1111, 9999) . $imagePhoto->getClientOriginalName();
            $imagePhoto->move($dir, $name);
            $request->request->add(['image' => $name]);
        }
        if ($image->update($request->all())) {
            $request->session()->flash('success', 'Image Update Successfully!!');
        } else {
            $request->session()->flash('error', 'Failed to update Image !!');
        }
        return redirect()->route('image.index');
    }

    public function destroy(Request $request, int $id)
    {
        if (!$image = Image::find($id)) {
            $request->session()->flash('error', 'Image not found !!');
        }
        if ($image->delete()) {
            $request->session()->flash('success', 'Image Deleted Successful !!');
        } else {
            $request->session()->flash('error', ' Failed to Delete Image !!');
        }
        return redirect()->route('image.index');
    }
}
