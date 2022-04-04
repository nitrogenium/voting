<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vote;
use DB;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function up($image_id, Request $request)
    {
        $ip = $request->ip();

        $image = Image::findOrFail($image_id);

        // delete old votes
        DB::table('votes')->join('images', 'votes.image_id', 'images.id')
            ->where('ip', $ip)->where('folder_id', $image->folder_id)->delete();

        $image->votes()->create(['ip'=>$ip]);

        flash('Ваш голос засчитан');

        return to_route('folder', $image->folder_id);


    }

}
