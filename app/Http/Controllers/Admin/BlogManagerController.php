<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\HtmlSanitizer;

class BlogManagerController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        $categories = Category::all();
        return view('admin.blog.index', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:200',
            'status'         => 'required|in:draft,publish',
            'excerpt'        => 'nullable|string',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $filename);
            $imagePath = 'uploads/blog/' . $filename;
        }

        // Auto-create or get a default category
        $categoryName = $request->input('category_name', 'E-Commerce');
        if ($categoryName === 'Pilih Kategori') {
            $categoryName = 'E-Commerce';
        }
        $category = Category::firstOrCreate(
            ['slug' => Str::slug($categoryName)],
            ['name' => $categoryName]
        );

        Article::create([
            'title'          => $validated['title'],
            'slug'           => Str::slug($validated['title']),
            'category_id'    => $category->id,
            'status'         => $validated['status'] === 'publish' ? 'published' : 'draft',
            'excerpt'        => $validated['excerpt'],
            'content'        => HtmlSanitizer::clean($validated['content']),
            'featured_image' => $imagePath,
            'published_at'   => $validated['status'] === 'publish' ? now() : null,
            'user_id'        => auth()->id() ?? 1, // Fallback if auth is bypassed
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:200',
            'status'         => 'required|in:draft,publish',
            'excerpt'        => 'nullable|string',
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = $article->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                @unlink(public_path($imagePath));
            }
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $filename);
            $imagePath = 'uploads/blog/' . $filename;
        }

        $categoryName = $request->input('category_name', 'E-Commerce');
        $category = Category::firstOrCreate(
            ['slug' => Str::slug($categoryName)],
            ['name' => $categoryName]
        );

        $article->update([
            'title'          => $validated['title'],
            'slug'           => Str::slug($validated['title']),
            'category_id'    => $category->id,
            'status'         => $validated['status'] === 'publish' ? 'published' : 'draft',
            'excerpt'        => $validated['excerpt'],
            'content'        => HtmlSanitizer::clean($validated['content']),
            'featured_image' => $imagePath,
            'published_at'   => $validated['status'] === 'publish' ? ($article->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image && file_exists(public_path($article->featured_image))) {
            @unlink(public_path($article->featured_image));
        }
        $article->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
