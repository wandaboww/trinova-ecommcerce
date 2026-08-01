<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaLibraryController extends Controller
{
    public function index()
    {
        return view('admin.media.index');
    }

    public function store(Request $request)
    {
        return redirect()->back()->with('success', 'Media uploaded.');
    }

    public function destroy(Media $media)
    {
        return redirect()->back()->with('success', 'Media deleted.');
    }
}
