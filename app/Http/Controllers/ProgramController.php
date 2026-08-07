<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::active()->ordered()->get();
        return view('program.index', compact('programs'));
    }

    public function show(string $slug)
    {
        $allPrograms = Program::active()->ordered()->get();
        $program = Program::where('slug', $slug)->active()->first();

        if (!$program) {
            // Mock fallback for previewing on local
            $mocks = [
                'start' => [
                    'title' => 'Program START',
                    'slug' => 'start',
                    'target_market' => 'Pemula / Brand Baru',
                    'short_description' => 'Validasi produk dan buat funnel penjualan online pertama Anda dengan struktur yang matang.',
                    'description' => 'Program START dirancang khusus bagi pebisnis yang ingin memvalidasi produk baru di pasar atau membuat landing page pertama dengan konversi penjualan tinggi. Di sini, Anda fokus untuk merapikan funnel masuk dari media sosial menuju penjualan terarah tanpa perlu pusing memikirkan pengelolaan teknologi server yang rumit di awal bisnis.',
                    'outcome' => [
                        ['icon' => 'check', 'text' => 'Landing Page Konversi Tinggi & Mobile-Optimized'],
                        ['icon' => 'check', 'text' => 'Integrasi Direct-to-WhatsApp CS Instant Order'],
                        ['icon' => 'check', 'text' => 'Setup Google Analytics 4 & FB Pixel Retargeting'],
                        ['icon' => 'check', 'text' => 'Free Domain .COM/.ID & Cloud Hosting 1 Tahun'],
                        ['icon' => 'cross', 'text' => 'Belum Termasuk Fitur Multi-Warehouse & Mobile Apps Native']
                    ],
                    'features' => [
                        (object) ['title' => 'Website Landing Page High-Conversion', 'description' => 'Desain modern, mobile-first, dan waktu muat di bawah 1.5 detik untuk meminimalisir bounce rate.'],
                        (object) ['title' => 'Integrasi Form Order WhatsApp', 'description' => 'Formulir order interaktif yang mengirimkan detail pesanan otomatis ke nomor WhatsApp Customer Service.'],
                        (object) ['title' => 'Tracking Pixel & Meta Ads Ready', 'description' => 'Pemasangan script pelacakan konversi lengkap untuk efisiensi kampanye iklan digital Anda.'],
                        (object) ['title' => 'Cloud Infrastructure & Managed Domain', 'description' => 'Penyimpanan server aman dengan sertifikat SSL HTTPS otomatis gratis selama 12 bulan.']
                    ]
                ],
                'grow' => [
                    'title' => 'Program GROW',
                    'slug' => 'grow',
                    'target_market' => 'Seller Marketplace Ingin Mandiri',
                    'short_description' => 'Mulai berpindah dari marketplace ke website mandiri dengan sistem pembayaran terintegrasi.',
                    'description' => 'Program GROW adalah langkah utama bagi seller marketplace yang ingin mengurangi ketergantungan potongan admin platform dan ingin mulai mengumpulkan database pelanggan sendiri. Kami membangun toko online e-commerce lengkap dengan katalog, keranjang belanja, pembayaran otomatis, dan database panel admin terpadu.',
                    'outcome' => [
                        ['icon' => 'check', 'text' => 'Toko Online E-Commerce Self-Hosted Mandiri'],
                        ['icon' => 'check', 'text' => 'Payment Gateway Otomatis (QRIS, VA, E-Wallet)'],
                        ['icon' => 'check', 'text' => 'Database Pelanggan Terpusat (CRM Base)'],
                        ['icon' => 'check', 'text' => 'Notifikasi WhatsApp CRM Follow-up Transaksi'],
                        ['icon' => 'cross', 'text' => 'Belum Termasuk Custom Mobile App Android/iOS']
                    ],
                    'features' => [
                        (object) ['title' => 'E-Commerce Store Engine Lengkap', 'description' => 'Katalog produk dinamis, variasi warna/ukuran, keranjang belanja, dan sistem checkout instan.'],
                        (object) ['title' => 'Payment Gateway Automatic Settlement', 'description' => 'Menerima pembayaran otomatis via QRIS, GoPay, OVO, Transfer Bank, & Minimarket tanpa cek manual.'],
                        (object) ['title' => 'Database & Order Management Panel', 'description' => 'Panel dashboard terpadu untuk memantau pesanan, riwayat belanja, dan kontak pembeli.'],
                        (object) ['title' => 'Automated WhatsApp Notification', 'description' => 'Kirim invoice dan pengingat pembayaran otomatis langsung ke WhatsApp pembeli secara waktu nyata.']
                    ]
                ],
                'scale' => [
                    'title' => 'Program SCALE',
                    'slug' => 'scale',
                    'target_market' => 'Brand yang Ingin Tumbuh Besar',
                    'short_description' => 'Tingkatkan profit bisnis dengan automasi pemasaran, CRM, SEO, dan kurir otomatis.',
                    'description' => 'Program SCALE ditargetkan untuk brand yang sudah memiliki basis pelanggan dan ingin melipatgandakan margin profit bersih mereka. Fokus utama program ini adalah memaksimalkan repeat order gratis, menerapkan fitur loyalitas pelanggan, optimasi SEO Google, dan kalkulasi ekspedisi kurir otomatis ke seluruh Indonesia.',
                    'outcome' => [
                        ['icon' => 'check', 'text' => 'Sistem CRM Retensi & Membership Point Reward'],
                        ['icon' => 'check', 'text' => 'Optimasi SEO Organik Target Halaman 1 Google'],
                        ['icon' => 'check', 'text' => 'Perhitungan Ongkir Multi-Kurir Otomatis Se-Indonesia'],
                        ['icon' => 'check', 'text' => 'WhatsApp Broadcast & Automated Campaign Engine'],
                        ['icon' => 'check', 'text' => 'Laporan Analisis Analytics & Retention Rate']
                    ],
                    'features' => [
                        (object) ['title' => 'Strategi SEO Google Rank 1', 'description' => 'Optimasi arsitektur website dan struktur konten agar mendominasi pencarian organik Google.'],
                        (object) ['title' => 'Sistem Membership & Point Reward', 'description' => 'Fitur reward poin pelanggan untuk memicu repeat order tanpa tergantung biaya iklan tinggi.'],
                        (object) ['title' => 'WhatsApp Broadcast Automation', 'description' => 'Fitur broadcast pesan massal terarah untuk promosi produk baru ke database pelanggan lama.'],
                        (object) ['title' => 'Integrasi Multi-Kurir Ekspedisi', 'description' => 'Cek ongkir otomatis (JNE, J&T, SiCepat, POS) hingga tingkat kecamatan di seluruh Indonesia.']
                    ]
                ],
                'empire' => [
                    'title' => 'Program EMPIRE',
                    'slug' => 'empire',
                    'target_market' => 'Penguasa Pasar / Enterprise',
                    'short_description' => 'Membangun ekosistem ERP mandiri untuk mengelola multi-warehouse dan custom mobile apps.',
                    'description' => 'Program EMPIRE diperuntukkan bagi brand skala nasional yang membutuhkan kustomisasi ekosistem digital secara menyeluruh. Kami mengembangkan sistem ERP, integrasi inventori multi-warehouse (gudang cabang), pembuatan aplikasi mobile (Android & iOS), serta menyediakan tim support teknis khusus untuk mengawal sistem Anda 24/7.',
                    'outcome' => [
                        ['icon' => 'check', 'text' => 'Mobile App Native (Android Google Play & iOS App Store)'],
                        ['icon' => 'check', 'text' => 'Custom Enterprise ERP & Multi-Warehouse Sync'],
                        ['icon' => 'check', 'text' => 'Dedicated High-Speed Cloud Server Architecture'],
                        ['icon' => 'check', 'text' => 'Dedicated Software Engineer & SLA Support 24/7'],
                        ['icon' => 'check', 'text' => 'Keamanan Ekstra Enkripsi Data Enterprise']
                    ],
                    'features' => [
                        (object) ['title' => 'Custom ERP & Multi-Warehouse System', 'description' => 'Sinkronisasi inventori antar cabang gudang, sistem stok otomatis, dan integrasi manajemen supplier.'],
                        (object) ['title' => 'Aplikasi Mobile Brand Sendiri (Android & iOS)', 'description' => 'Aplikasi mobile e-commerce resmi brand Anda terpublikasi di Play Store & App Store.'],
                        (object) ['title' => 'Dedicated High-Speed Server', 'description' => 'Infrastruktur cloud server dedicated dengan jaminan uptime 99.9% sanggup menampung flash sale massal.'],
                        (object) ['title' => 'Dedicated Developer Support 24/7', 'description' => 'Pengawalan khusus tim engineer untuk maintenance berkala dan pembaruan fitur sesuai kebutuhan bisnis.']
                    ]
                ]
            ];

            if (array_key_exists($slug, $mocks)) {
                $programObj = (object) $mocks[$slug];
                $programObj->features = collect($programObj->features);

                // Build mock allPrograms list if empty
                if ($allPrograms->isEmpty()) {
                    $allPrograms = collect([
                        (object)['slug' => 'start', 'title' => 'Program START'],
                        (object)['slug' => 'grow', 'title' => 'Program GROW'],
                        (object)['slug' => 'scale', 'title' => 'Program SCALE'],
                        (object)['slug' => 'empire', 'title' => 'Program EMPIRE'],
                    ]);
                }

                return view('program.show', ['program' => $programObj, 'allPrograms' => $allPrograms]);
            }

            abort(404);
        }

        return view('program.show', compact('program', 'allPrograms'));
    }
}
