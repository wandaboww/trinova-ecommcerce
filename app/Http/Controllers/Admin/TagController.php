<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.tag.index');
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.blog.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        return redirect()->route('admin.blog.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        return redirect()->route('admin.blog.tags.index')->with('success', 'Tag deleted successfully.');
    }
}
