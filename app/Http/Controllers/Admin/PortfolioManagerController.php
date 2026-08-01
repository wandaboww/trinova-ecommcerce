<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Str;

class PortfolioManagerController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:150',
            'category'    => 'required|string|max:150',
            'problem'     => 'required|string',
            'result'      => 'required|string',
        ]);

        $title = $validated['client_name'] . ' Scaling Project';

        Portfolio::create([
            'title'        => $title,
            'slug'         => Str::slug($validated['client_name']),
            'client_name'  => $validated['client_name'],
            'industry'     => $validated['category'],
            'problem'      => $validated['problem'],
            'solution'     => 'Membangun direct-to-consumer (D2C) online store dengan landing page premium teroptimasi.',
            'result'       => $validated['result'],
            'is_featured'  => true,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.portfolio.index')->with('success', 'Studi kasus portfolio berhasil ditambahkan.');
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:150',
            'category'    => 'required|string|max:150',
            'problem'     => 'required|string',
            'result'      => 'required|string',
        ]);

        $portfolio->update([
            'title'       => $validated['client_name'] . ' Scaling Project',
            'slug'        => Str::slug($validated['client_name']),
            'client_name' => $validated['client_name'],
            'industry'    => $validated['category'],
            'problem'     => $validated['problem'],
            'result'      => $validated['result'],
        ]);

        return redirect()->route('admin.portfolio.index')->with('success', 'Studi kasus portfolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Studi kasus portfolio berhasil dihapus.');
    }
}
