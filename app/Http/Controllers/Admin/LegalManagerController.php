<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalDocument;
use App\Models\LegalSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LegalManagerController extends Controller
{
    /**
     * Show the Legal Document editor page (Terms or Privacy).
     */
    public function index(Request $request)
    {
        $type = in_array($request->query('type'), ['privacy_policy', 'terms_and_conditions']) 
            ? $request->query('type') 
            : 'terms_and_conditions';

        $document = LegalDocument::ofType($type)->latest()->first();
        $sections = $document ? $document->sections()->get() : collect();

        return view('admin.legal.index', compact('document', 'sections', 'type'));
    }

    /**
     * Save or update the document metadata (Draft mode).
     */
    public function updateDocument(Request $request)
    {
        $validated = $request->validate([
            'type'             => 'required|string|in:terms_and_conditions,privacy_policy',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string',
            'version'          => 'required|string|max:20',
            'effective_date'   => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $type = $validated['type'];
        $document = LegalDocument::ofType($type)->latest()->first();

        if ($document) {
            $document->update($validated);
        } else {
            $document = LegalDocument::create(array_merge($validated, [
                'status' => 'draft',
            ]));
        }

        return redirect()->route('admin.legal.index', ['type' => $type])->with('success', 'Dokumen berhasil disimpan sebagai Draft.');
    }

    /**
     * Publish the document — make it live on public page.
     */
    public function publish(Request $request)
    {
        $validated = $request->validate([
            'type'             => 'required|string|in:terms_and_conditions,privacy_policy',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string',
            'version'          => 'required|string|max:20',
            'effective_date'   => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $type = $validated['type'];
        $document = LegalDocument::ofType($type)->latest()->first();

        if (!$document) {
            return redirect()->route('admin.legal.index', ['type' => $type])->with('error', 'Buat dokumen terlebih dahulu sebelum mempublikasikan.');
        }

        $document->update(array_merge($validated, [
            'status'       => 'published',
            'published_at' => now(),
        ]));

        return redirect()->route('admin.legal.index', ['type' => $type])->with('success', 'Dokumen berhasil dipublikasikan dan kini tampil di halaman publik.');
    }

    /**
     * Store a new section.
     */
    public function storeSection(Request $request)
    {
        $validated = $request->validate([
            'type'       => 'required|string|in:terms_and_conditions,privacy_policy',
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $type = $validated['type'];
        $document = LegalDocument::ofType($type)->latest()->first();

        if (!$document) {
            return redirect()->route('admin.legal.index', ['type' => $type])->with('error', 'Simpan informasi dokumen terlebih dahulu sebelum menambah section.');
        }

        LegalSection::create([
            'legal_document_id' => $document->id,
            'title'             => $validated['title'],
            'slug'              => Str::slug($validated['title'], '-'),
            'content'           => $validated['content'] ?? '',
            'sort_order'        => $validated['sort_order'] ?? (LegalSection::where('legal_document_id', $document->id)->max('sort_order') + 1),
            'is_active'         => true,
        ]);

        return redirect()->route('admin.legal.index', ['type' => $type])->with('success', 'Section baru berhasil ditambahkan.');
    }

    /**
     * Update an existing section.
     */
    public function updateSection(Request $request, LegalSection $section)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);

        $section->update([
            'title'      => $validated['title'],
            'slug'       => Str::slug($validated['title'], '-'),
            'content'    => $validated['content'] ?? '',
            'sort_order' => $validated['sort_order'] ?? $section->sort_order,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        $type = $section->document->type ?? 'terms_and_conditions';

        return redirect()->route('admin.legal.index', ['type' => $type])->with('success', 'Section berhasil diperbarui.');
    }

    /**
     * Delete a section.
     */
    public function destroySection(LegalSection $section)
    {
        $type = $section->document->type ?? 'terms_and_conditions';
        $section->delete();

        return redirect()->route('admin.legal.index', ['type' => $type])->with('success', 'Section berhasil dihapus.');
    }
}
