<?php

namespace App\Http\Controllers;

use App\Models\LegalDocument;

class LegalController extends Controller
{
    public function terms()
    {
        // Public: hanya tampilkan dokumen yang sudah Published
        // Jika admin (authenticated), bisa preview Draft via query param ?preview=1
        $query = LegalDocument::ofType('terms_and_conditions');

        if (request()->has('preview') && auth()->check()) {
            // Admin preview mode: tampilkan dokumen apapun statusnya
            $document = $query->latest()->first();
        } else {
            $document = $query->published()->latest('published_at')->first();
        }

        if (!$document) {
            abort(404, 'Dokumen Syarat & Ketentuan belum dipublikasikan.');
        }

        $sections = $document->activeSections()->get();

        $seo = [
            'title'       => $document->meta_title ?: ($document->title . ' | Omset Digital'),
            'description' => $document->meta_description ?: 'Syarat dan ketentuan penggunaan website serta layanan Omset Digital.',
            'canonical'   => route('terms'),
        ];

        return view('legal.terms', compact('document', 'sections', 'seo'));
    }

    public function privacy()
    {
        $query = LegalDocument::ofType('privacy_policy');

        if (request()->has('preview') && auth()->check()) {
            $document = $query->latest()->first();
        } else {
            $document = $query->published()->latest('published_at')->first();
        }

        if (!$document) {
            abort(404, 'Dokumen Kebijakan Privasi belum dipublikasikan.');
        }

        $sections = $document->activeSections()->get();

        $seo = [
            'title'       => $document->meta_title ?: ($document->title . ' | Omset Digital'),
            'description' => $document->meta_description ?: 'Kebijakan Privasi Omset Digital yang menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi pengguna.',
            'canonical'   => route('privacy'),
        ];

        return view('legal.privacy', compact('document', 'sections', 'seo'));
    }
}
