<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Image;
use DB;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function index($folder_id, Request $request)
    {

        $ip = $request->ip();

        $folder = Folder::findOrFail($folder_id);

        $upvoted = DB::table('images')->join('votes', 'votes.image_id', 'images.id')
            ->where('ip', $ip)->where('folder_id', $folder->id)->first();

//        ray($upvoted->toSql());
        ray($upvoted);

        return view('images', compact('folder','upvoted'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Image $image)
    {
        //
    }

    public function edit(Image $image)
    {
        //
    }

    public function update(Request $request, Image $image)
    {
        //
    }

    public function destroy(Image $image)
    {
        //
    }
}
