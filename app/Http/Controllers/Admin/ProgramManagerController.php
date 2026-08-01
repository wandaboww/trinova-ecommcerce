<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramManagerController extends Controller
{
    public function index()
    {
        $programs = Program::ordered()->get();
        return view('admin.program.index', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => 'required|string|unique:programs,slug',
            'short_description' => 'required|string',
            'target_market'     => 'required|string|max:200',
            'outcome_text'      => 'required|array|min:1',
            'outcome_text.*'    => 'required|string',
            'outcome_icon'      => 'required|array',
        ]);

        $outcomeItems = [];
        foreach ($request->outcome_text as $i => $text) {
            if (!empty(trim($text))) {
                $outcomeItems[] = [
                    'icon' => ($request->outcome_icon[$i] ?? 'check'),
                    'text' => trim($text),
                ];
            }
        }

        Program::create([
            'title'             => $request->title,
            'slug'              => Str::slug($request->slug),
            'short_description' => $request->short_description,
            'target_market'     => $request->target_market,
            'outcome'           => $outcomeItems,
            'is_active'         => true,
            'sort_order'        => Program::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => 'required|string|unique:programs,slug,' . $program->id,
            'short_description' => 'required|string',
            'target_market'     => 'required|string|max:200',
            'outcome_text'      => 'required|array|min:1',
            'outcome_text.*'    => 'required|string',
            'outcome_icon'      => 'required|array',
        ]);

        $outcomeItems = [];
        foreach ($request->outcome_text as $i => $text) {
            if (!empty(trim($text))) {
                $outcomeItems[] = [
                    'icon' => ($request->outcome_icon[$i] ?? 'check'),
                    'text' => trim($text),
                ];
            }
        }

        $program->update([
            'title'             => $request->title,
            'slug'              => Str::slug($request->slug),
            'short_description' => $request->short_description,
            'target_market'     => $request->target_market,
            'outcome'           => $outcomeItems,
        ]);

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.program.index')->with('success', 'Program berhasil dihapus.');
    }

    public function toggleBestValue(Program $program)
    {
        $newVal = !$program->is_best_value;
        
        if ($newVal) {
            Program::where('id', '!=', $program->id)->update(['is_best_value' => false]);
        }
        
        $program->update(['is_best_value' => $newVal]);
        
        $msg = $newVal ? "Program {$program->title} ditandai sebagai Recommended!" : "Tanda Recommended dinonaktifkan.";
        return redirect()->route('admin.program.index')->with('success', $msg);
    }
}
