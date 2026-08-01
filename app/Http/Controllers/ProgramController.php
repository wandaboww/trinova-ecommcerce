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
                    'outcome' => 'Landing Page Konversi Tinggi & Integrasi Form WhatsApp.',
                    'features' => [
                        (object) ['title' => 'Website Landing Page 1 Halaman', 'description' => 'Desain responsif, mobile-first, dan loading di bawah 2 detik.'],
                        (object) ['title' => 'Integrasi Form WhatsApp', 'description' => 'Form order dinamis yang terhubung langsung ke WhatsApp CS Anda.'],
                        (object) ['title' => 'Setup Google Analytics & FB Pixel', 'description' => 'Pelacakan konversi traffic untuk keperluan penargetan ulang iklan (retargeting).'],
                        (object) ['title' => 'Hosting & Domain Gratis', 'description' => 'Domain .com atau .id pilihan Anda gratis beserta cloud hosting premium selama 1 tahun.']
                    ]
                ],
                'grow' => [
                    'title' => 'Program GROW',
                    'slug' => 'grow',
                    'target_market' => 'Seller Marketplace Ingin Mandiri',
                    'short_description' => 'Mulai berpindah dari marketplace ke website mandiri dengan sistem pembayaran terintegrasi.',
                    'description' => 'Program GROW adalah langkah utama bagi seller marketplace yang ingin mengurangi ketergantungan potongan admin platform dan ingin mulai mengumpulkan database pelanggan sendiri. Kami membangun toko online e-commerce lengkap dengan katalog, keranjang belanja, pembayaran otomatis, dan database panel admin terpadu.',
                    'outcome' => 'E-Commerce Lengkap, Payment Gateway, & CRM WhatsApp.',
                    'features' => [
                        (object) ['title' => 'E-Commerce Store Lengkap', 'description' => 'Katalog produk dinamis, sistem kategori, keranjang belanja, dan checkout aman.'],
                        (object) ['title' => 'Integrasi Payment Gateway', 'description' => 'Menerima pembayaran otomatis via QRIS, E-Wallet (Gopay/OVO), Transfer Bank, dan Alfamart/Indomaret.'],
                        (object) ['title' => 'Sinkronisasi Database Otomatis', 'description' => 'Penyimpanan rapi data pelanggan (nama, alamat, WhatsApp) setiap kali terjadi transaksi.'],
                        (object) ['title' => 'WhatsApp CRM Follow Up', 'description' => 'Notifikasi otomatis transaksi sukses atau instruksi pembayaran yang dikirim langsung ke nomor WhatsApp pembeli.']
                    ]
                ],
                'scale' => [
                    'title' => 'Program SCALE',
                    'slug' => 'scale',
                    'target_market' => 'Brand yang Ingin Tumbuh Besar',
                    'short_description' => 'Tingkatkan profit bisnis dengan automasi pemasaran, CRM, SEO, dan kurir otomatis.',
                    'description' => 'Program SCALE ditargetkan untuk brand yang sudah memiliki basis pelanggan dan ingin melipatgandakan margin profit bersih mereka. Fokus utama program ini adalah memaksimalkan repeat order gratis, menerapkan fitur loyalitas pelanggan, optimasi SEO Google, dan kalkulasi ekspedisi kurir otomatis ke seluruh Indonesia.',
                    'outcome' => 'Sistem CRM Retensi, Optimasi SEO Halaman Satu Google, & Kurir Pro.',
                    'features' => [
                        (object) ['title' => 'Strategi SEO & Google Rank 1', 'description' => 'Optimasi struktur coding dan konten agar website Anda mudah ditemukan di halaman utama Google secara organik.'],
                        (object) ['title' => 'Sistem Membership & Point Reward', 'description' => 'Memberikan point belanja bagi pelanggan untuk ditukarkan diskon guna memicu repeat order berkelanjutan.'],
                        (object) ['title' => 'WhatsApp Broadcast Automation', 'description' => 'Mengirim promosi massal secara gratis dan terarah langsung ke database kontak pelanggan Anda.'],
                        (object) ['title' => 'Integrasi Kurir Pro', 'description' => 'Cek ongkos kirim otomatis (multikurir) hingga tingkat kecamatan se-Indonesia (JNE, J&T, Sicepat, POS).']
                    ]
                ],
                'empire' => [
                    'title' => 'Program EMPIRE',
                    'slug' => 'empire',
                    'target_market' => 'Penguasa Pasar / Enterprise',
                    'short_description' => 'Membangun ekosistem ERP mandiri untuk mengelola multi-warehouse dan custom mobile apps.',
                    'description' => 'Program EMPIRE diperuntukkan bagi brand skala nasional yang membutuhkan kustomisasi ekosistem digital secara menyeluruh. Kami mengembangkan sistem ERP, integrasi inventori multi-warehouse (gudang cabang), pembuatan aplikasi mobile (Android & iOS), serta menyediakan tim support teknis khusus untuk mengawal sistem Anda 24/7.',
                    'outcome' => 'Mobile Apps Android/iOS, ERP System Kustom, & Dedicated Developer.',
                    'features' => [
                        (object) ['title' => 'Custom ERP & Multi-Warehouse', 'description' => 'Integrasi stok antar gudang cabang, kelola inventori real-time, dan manajemen supplier terpadu.'],
                        (object) ['title' => 'Aplikasi Mobile Android & iOS', 'description' => 'Aplikasi native e-commerce brand Anda sendiri yang siap dirilis di Google Play Store dan Apple App Store.'],
                        (object) ['title' => 'Server Dedicated Premium', 'description' => 'Setup infrastruktur server dedicated berkecepatan tinggi dengan SLA uptime 99.9% untuk menampung traffic massal.'],
                        (object) ['title' => 'Dedicated Support Developer 24/7', 'description' => 'Dukungan penuh tim developer khusus untuk perawatan sistem rutin dan penyelesaian kendala operasional kapan pun.']
                    ]
                ]
            ];

            if (array_key_exists($slug, $mocks)) {
                $programObj = (object) $mocks[$slug];
                $programObj->features = collect($programObj->features);
                return view('program.show', ['program' => $programObj]);
            }

            abort(404);
        }

        return view('program.show', compact('program'));
    }
}
