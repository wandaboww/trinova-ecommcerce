<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::published()->latest()->get();
        return view('portfolio.index', compact('portfolios'));
    }

    public function show(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->published()->firstOrFail();
        return view('portfolio.show', compact('portfolio'));
    }
}
