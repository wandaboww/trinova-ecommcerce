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

    public function create()
    {
        return redirect()->route('admin.program.index');
    }

    public function edit(Program $program)
    {
        return redirect()->route('admin.program.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => 'required|string|unique:programs,slug',
            'short_description' => 'required|string',
            'description'       => 'nullable|string',
            'target_market'     => 'required|string|max:200',
            'outcome_text'      => 'required|array|min:1',
            'outcome_text.*'    => 'required|string',
            'outcome_icon'      => 'required|array',
            'spec_warranty'     => 'nullable|string|max:100',
            'spec_speed'        => 'nullable|string|max:100',
            'spec_support'      => 'nullable|string|max:100',
            'spec_license'      => 'nullable|string|max:100',
            'original_price'    => 'nullable|string|max:100',
            'current_price'     => 'nullable|string|max:100',
            'icon'              => 'nullable|string|max:100',
        ]);

        $outcomeItems = [];
        foreach ($request->outcome_text as $i => $text) {
            if (!empty(trim($text))) {
                $outcomeItems[] = [
                    'icon' => ($request->outcome_icon[$i] ?? 'check'),
                    'text' => trim($text),
                    'custom_class' => trim($request->outcome_custom_class[$i] ?? ''),
                ];
            }
        }

        Program::create([
            'title'             => $request->title,
            'slug'              => Str::slug($request->slug),
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'target_market'     => $request->target_market,
            'outcome'           => $outcomeItems,
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => Program::max('sort_order') + 1,
            'icon'              => $request->icon,
            'spec_warranty'     => $request->spec_warranty ?? '100% Turnkey Ready',
            'spec_speed'        => $request->spec_speed ?? '< 1.5 Detik',
            'spec_support'      => $request->spec_support ?? 'Tim Dedicated CS',
            'spec_license'      => $request->spec_license ?? 'Full Mandiri (100% Hak Milik)',
            'original_price'    => $request->original_price,
            'current_price'     => $request->current_price,
        ]);

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => 'required|string|unique:programs,slug,' . $program->id,
            'short_description' => 'required|string',
            'description'       => 'nullable|string',
            'target_market'     => 'required|string|max:200',
            'outcome_text'      => 'required|array|min:1',
            'outcome_text.*'    => 'required|string',
            'outcome_icon'      => 'required|array',
            'spec_warranty'     => 'nullable|string|max:100',
            'spec_speed'        => 'nullable|string|max:100',
            'spec_support'      => 'nullable|string|max:100',
            'spec_license'      => 'nullable|string|max:100',
            'original_price'    => 'nullable|string|max:100',
            'current_price'     => 'nullable|string|max:100',
            'icon'              => 'nullable|string|max:100',
        ]);

        $outcomeItems = [];
        foreach ($request->outcome_text as $i => $text) {
            if (!empty(trim($text))) {
                $outcomeItems[] = [
                    'icon' => ($request->outcome_icon[$i] ?? 'check'),
                    'text' => trim($text),
                    'custom_class' => trim($request->outcome_custom_class[$i] ?? ''),
                ];
            }
        }

        $program->update([
            'title'             => $request->title,
            'slug'              => Str::slug($request->slug),
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'target_market'     => $request->target_market,
            'outcome'           => $outcomeItems,
            'is_active'         => $request->boolean('is_active', true),
            'spec_warranty'     => $request->spec_warranty ?? '100% Turnkey Ready',
            'spec_speed'        => $request->spec_speed ?? '< 1.5 Detik',
            'spec_support'      => $request->spec_support ?? 'Tim Dedicated CS',
            'spec_license'      => $request->spec_license ?? 'Full Mandiri (100% Hak Milik)',
            'original_price'    => $request->original_price,
            'current_price'     => $request->current_price,
            'icon'              => $request->icon,
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

    public function updateTopics(Request $request, Program $program)
    {
        $request->validate([
            'topic_title'   => 'required|array|min:1',
            'topic_title.*' => 'required|string',
        ]);

        $topics = [];
        if ($request->has('topic_title') && is_array($request->topic_title)) {
            foreach ($request->topic_title as $i => $title) {
                if (!empty(trim($title))) {
                    $rawKey = $request->topic_key[$i] ?? '';
                    $key = !empty($rawKey) ? Str::slug($rawKey, '_') : Str::slug($title, '_');
                    $topics[] = [
                        'key'          => $key ?: 'topic_' . ($i + 1),
                        'icon'         => $request->topic_icon[$i] ?? '📌',
                        'title'        => trim($title),
                        'subtitle'     => trim($request->topic_subtitle[$i] ?? ''),
                        'content'      => trim($request->topic_content[$i] ?? ''),
                        'custom_class' => trim($request->topic_custom_class[$i] ?? ''),
                    ];
                }
            }
        }

        $program->update(['topics' => $topics]);

        return redirect()->route('admin.program.index')->with('success', "Navigasi Topik Detail untuk program '{$program->title}' berhasil diperbarui.");
    }
}
