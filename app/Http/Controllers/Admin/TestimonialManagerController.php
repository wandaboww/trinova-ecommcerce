<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialManagerController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::ordered()->get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:150',
            'role'       => 'nullable|string|max:200',
            'rating'     => 'required|integer|min:1|max:5',
            'content'    => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Split "role" field into company/position: "Founder @HijabNisa"
        $roleParts = explode(' ', $validated['role'] ?? '', 2);

        Testimonial::create([
            'name'       => $validated['name'],
            'position'   => $validated['role'] ?? null,
            'company'    => null,
            'content'    => $validated['content'],
            'rating'     => $validated['rating'],
            'sort_order' => $validated['sort_order'] ?? Testimonial::max('sort_order') + 1,
            'is_active'  => true,
        ]);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:150',
            'role'       => 'nullable|string|max:200',
            'rating'     => 'required|integer|min:1|max:5',
            'content'    => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        $testimonial->update([
            'name'       => $validated['name'],
            'position'   => $validated['role'] ?? $testimonial->position,
            'content'    => $validated['content'],
            'rating'     => $validated['rating'],
            'sort_order' => $validated['sort_order'] ?? $testimonial->sort_order,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
