<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\ImageComment;
use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('home', compact('images'));
    }

    public function image($id)
    {
        $image = Image::withTotalVisitCount()->find($id);
        if ($image) {
            $image->visit();
            $views = $image->visits->count();
        }
        $comments = ImageComment::where('image_id', $id)->get();
        return view('image', compact('image', 'views', 'comments'));
    }
}