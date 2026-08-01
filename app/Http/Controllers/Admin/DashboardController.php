<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Program;
use App\Models\Article;
use App\Models\Faq;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLeads = Lead::count();
        $totalPrograms = Program::count();
        $totalArticles = Article::count();
        $totalFaqs = Faq::count();
        
        $recentLeads = Lead::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLeads',
            'totalPrograms',
            'totalArticles',
            'totalFaqs',
            'recentLeads'
        ));
    }
}
