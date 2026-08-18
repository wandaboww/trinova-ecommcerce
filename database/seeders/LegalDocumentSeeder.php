<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LegalDocument;
use App\Models\LegalSection;
use Illuminate\Support\Str;

class LegalDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPrivacyPolicy();
        $this->seedTermsAndConditions();
    }

    private function seedPrivacyPolicy(): void
    {
        $doc = LegalDocument::updateOrCreate(
            ['type' => 'privacy_policy'],
            [
                'title'            => 'Kebijakan Privasi',
                'subtitle'         => 'Kami berkomitmen untuk melindungi data pribadi Anda dengan standar keamanan tertinggi.',
                'version'          => '1.0',
                'effective_date'   => '2024-01-01',
                'meta_title'       => 'Kebijakan Privasi | Omset Digital',
                'meta_description' => 'Kebijakan Privasi Omset Digital yang menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi pengguna.',
                'status'           => 'published',
                'published_at'     => now(),
            ]
        );

        $sections = [
            [
                'title'      => 'Informasi yang Kami Kumpulkan',
                'slug'       => 'informasi-yang-kami-kumpulkan',
                'sort_order' => 1,
                'content'    => 'Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, seperti nama, alamat email, nomor telepon, dan informasi bisnis Anda ketika Anda mengisi formulir di situs kami, menghubungi kami, atau menggunakan layanan kami.

Kami juga mengumpulkan informasi secara otomatis ketika Anda mengunjungi situs kami, termasuk alamat IP, jenis browser, halaman yang dikunjungi, waktu kunjungan, dan data analitik lainnya melalui cookie dan teknologi serupa.',
            ],
            [
                'title'      => 'Cara Kami Menggunakan Informasi Anda',
                'slug'       => 'cara-kami-menggunakan-informasi',
                'sort_order' => 2,
                'content'    => 'Kami menggunakan informasi yang dikumpulkan untuk memberikan, memelihara, dan meningkatkan layanan kami kepada Anda. Ini mencakup memproses permintaan Anda, mengirimkan komunikasi terkait layanan, dan menyediakan dukungan pelanggan.

Kami juga menggunakan informasi Anda untuk menganalisis penggunaan situs, memahami kebutuhan pengguna, dan mengembangkan produk serta layanan baru yang lebih baik untuk mendukung pertumbuhan bisnis Anda.',
            ],
            [
                'title'      => 'Perlindungan Data Pribadi',
                'slug'       => 'perlindungan-data-pribadi',
                'sort_order' => 3,
                'content'    => 'Kami menerapkan langkah-langkah keamanan teknis dan organisasional yang sesuai untuk melindungi informasi pribadi Anda dari akses tidak sah, pengungkapan, perubahan, atau penghancuran.

Akses ke data pribadi Anda dibatasi hanya pada karyawan dan mitra kami yang membutuhkannya untuk memberikan layanan kepada Anda. Seluruh pihak yang memiliki akses terikat oleh kewajiban kerahasiaan yang ketat.',
            ],
            [
                'title'      => 'Berbagi Informasi dengan Pihak Ketiga',
                'slug'       => 'berbagi-informasi-pihak-ketiga',
                'sort_order' => 4,
                'content'    => 'Kami tidak menjual, menyewakan, atau memperdagangkan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali dalam situasi yang dijelaskan dalam kebijakan ini.

Kami dapat berbagi informasi dengan penyedia layanan terpercaya yang membantu kami menjalankan bisnis, seperti layanan hosting, analitik, dan komunikasi email. Semua penyedia layanan ini wajib menjaga kerahasiaan informasi Anda.',
            ],
            [
                'title'      => 'Cookie dan Teknologi Pelacakan',
                'slug'       => 'cookie-dan-teknologi-pelacakan',
                'sort_order' => 5,
                'content'    => 'Situs kami menggunakan cookie dan teknologi pelacakan serupa untuk meningkatkan pengalaman Anda. Cookie adalah file teks kecil yang disimpan di perangkat Anda ketika Anda mengunjungi situs kami.

Anda dapat mengatur browser Anda untuk menolak semua cookie atau untuk memberi tahu Anda ketika cookie dikirimkan. Namun, beberapa fitur situs mungkin tidak berfungsi dengan baik jika cookie dinonaktifkan.',
            ],
            [
                'title'      => 'Hak-Hak Anda',
                'slug'       => 'hak-hak-anda',
                'sort_order' => 6,
                'content'    => 'Anda memiliki hak untuk mengakses, memperbarui, atau menghapus informasi pribadi yang kami miliki tentang Anda. Anda juga berhak untuk membatasi atau menolak pemrosesan data Anda dalam kondisi tertentu.

Untuk menggunakan hak-hak ini atau jika Anda memiliki pertanyaan tentang praktik privasi kami, silakan hubungi kami melalui halaman kontak. Kami akan merespons permintaan Anda dalam waktu yang wajar.',
            ],
            [
                'title'      => 'Perubahan Kebijakan Privasi',
                'slug'       => 'perubahan-kebijakan-privasi',
                'sort_order' => 7,
                'content'    => 'Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu untuk mencerminkan perubahan dalam praktik kami atau karena alasan operasional, hukum, atau regulasi lainnya.

Kami akan memberitahu Anda tentang perubahan material melalui email atau melalui pemberitahuan yang jelas di situs kami sebelum perubahan berlaku. Tanggal "Berlaku Sejak" di bagian atas halaman ini menunjukkan kapan kebijakan ini terakhir diperbarui.',
            ],
        ];

        foreach ($sections as $section) {
            LegalSection::updateOrCreate(
                [
                    'legal_document_id' => $doc->id,
                    'slug'              => $section['slug'],
                ],
                array_merge($section, ['is_active' => true])
            );
        }
    }

    private function seedTermsAndConditions(): void
    {
        $doc = LegalDocument::updateOrCreate(
            ['type' => 'terms_and_conditions'],
            [
                'title'            => 'Syarat & Ketentuan',
                'subtitle'         => 'Harap baca syarat dan ketentuan ini dengan seksama sebelum menggunakan layanan kami.',
                'version'          => '1.0',
                'effective_date'   => '2024-01-01',
                'meta_title'       => 'Syarat & Ketentuan | Omset Digital',
                'meta_description' => 'Syarat dan ketentuan penggunaan website serta layanan Omset Digital.',
                'status'           => 'published',
                'published_at'     => now(),
            ]
        );

        $sections = [
            [
                'title'      => 'Penerimaan Syarat',
                'slug'       => 'penerimaan-syarat',
                'sort_order' => 1,
                'content'    => 'Dengan mengakses atau menggunakan layanan Omset Digital, Anda menyatakan bahwa Anda telah membaca, memahami, dan menyetujui untuk terikat oleh Syarat & Ketentuan ini.

Jika Anda tidak setuju dengan salah satu ketentuan ini, Anda tidak diperkenankan menggunakan layanan kami. Penggunaan layanan kami secara berkelanjutan setelah perubahan pada syarat ini merupakan persetujuan Anda terhadap perubahan tersebut.',
            ],
            [
                'title'      => 'Deskripsi Layanan',
                'slug'       => 'deskripsi-layanan',
                'sort_order' => 2,
                'content'    => 'Omset Digital menyediakan layanan pembuatan website profesional, konsultasi digital marketing, dan solusi teknologi untuk membantu bisnis Anda berkembang secara online. Layanan kami dirancang khusus untuk pelaku UMKM, seller marketplace, dan pengusaha online shop.

Kami berhak untuk memodifikasi, menangguhkan, atau menghentikan layanan kami kapan saja dengan atau tanpa pemberitahuan sebelumnya. Kami tidak bertanggung jawab atas kerugian yang timbul akibat penghentian layanan tersebut.',
            ],
            [
                'title'      => 'Kewajiban Pengguna',
                'slug'       => 'kewajiban-pengguna',
                'sort_order' => 3,
                'content'    => 'Dengan menggunakan layanan kami, Anda menyatakan bahwa Anda berusia minimal 18 tahun atau memiliki izin dari orang tua/wali jika di bawah usia tersebut. Anda bertanggung jawab penuh atas semua aktivitas yang terjadi di bawah akun Anda.

Anda setuju untuk tidak menggunakan layanan kami untuk tujuan yang melanggar hukum, menipu, merusak, atau merugikan pihak lain. Pelanggaran ketentuan ini dapat mengakibatkan penghentian layanan tanpa pengembalian dana.',
            ],
            [
                'title'      => 'Hak Kekayaan Intelektual',
                'slug'       => 'hak-kekayaan-intelektual',
                'sort_order' => 4,
                'content'    => 'Seluruh konten, desain, kode, dan materi lain yang dibuat oleh Omset Digital dalam penyampaian layanan adalah milik Omset Digital kecuali disepakati lain secara tertulis dalam perjanjian kerja sama.

Setelah pelunasan penuh biaya layanan, hak kepemilikan atas aset digital yang dibuat khusus untuk klien (seperti desain website) akan dialihkan kepada klien sesuai dengan ruang lingkup yang disepakati dalam perjanjian proyek.',
            ],
            [
                'title'      => 'Pembayaran dan Pengembalian Dana',
                'slug'       => 'pembayaran-dan-pengembalian-dana',
                'sort_order' => 5,
                'content'    => 'Biaya layanan harus dibayarkan sesuai dengan jadwal yang disepakati dalam perjanjian kerja sama. Kami berhak untuk menghentikan pengerjaan proyek jika pembayaran tidak diterima sesuai jadwal.

Pengembalian dana hanya dapat dilakukan dalam kondisi tertentu yang diatur dalam perjanjian proyek individual. Sebagai kebijakan umum, uang muka yang telah dibayarkan tidak dapat dikembalikan kecuali jika Omset Digital tidak dapat memenuhi kewajiban yang telah disepakati.',
            ],
            [
                'title'      => 'Batasan Tanggung Jawab',
                'slug'       => 'batasan-tanggung-jawab',
                'sort_order' => 6,
                'content'    => 'Omset Digital tidak bertanggung jawab atas kerugian tidak langsung, insidental, khusus, atau konsekuensial yang timbul dari penggunaan atau ketidakmampuan menggunakan layanan kami, termasuk namun tidak terbatas pada kehilangan keuntungan atau data bisnis.

Total tanggung jawab Omset Digital dalam hal apapun tidak akan melebihi jumlah biaya yang telah Anda bayarkan untuk layanan dalam 3 bulan terakhir sebelum kejadian yang menimbulkan klaim tersebut.',
            ],
            [
                'title'      => 'Penyelesaian Sengketa',
                'slug'       => 'penyelesaian-sengketa',
                'sort_order' => 7,
                'content'    => 'Setiap sengketa yang timbul dari penggunaan layanan kami akan diselesaikan terlebih dahulu melalui musyawarah untuk mufakat antara kedua belah pihak dalam jangka waktu 30 (tiga puluh) hari sejak sengketa dilaporkan.

Jika penyelesaian melalui musyawarah tidak tercapai, sengketa akan diselesaikan melalui Badan Arbitrase Nasional Indonesia (BANI) atau pengadilan yang berwenang di Indonesia sesuai dengan hukum yang berlaku.',
            ],
            [
                'title'      => 'Perubahan Syarat & Ketentuan',
                'slug'       => 'perubahan-syarat-ketentuan',
                'sort_order' => 8,
                'content'    => 'Omset Digital berhak untuk mengubah Syarat & Ketentuan ini kapan saja. Perubahan akan berlaku efektif segera setelah dipublikasikan di situs kami kecuali jika ditentukan lain.

Anda bertanggung jawab untuk meninjau Syarat & Ketentuan ini secara berkala. Penggunaan layanan kami secara berkelanjutan setelah perubahan dipublikasikan merupakan persetujuan Anda terhadap syarat yang diperbarui.',
            ],
        ];

        foreach ($sections as $section) {
            LegalSection::updateOrCreate(
                [
                    'legal_document_id' => $doc->id,
                    'slug'              => $section['slug'],
                ],
                array_merge($section, ['is_active' => true])
            );
        }
    }
}
