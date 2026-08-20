<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Banner -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="px-3.5 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider border border-blue-500/30">
                Pusat Bantuan & Layanan
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white mt-3 tracking-tight">Hubungi Kami & Lokasi</h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2">Kirimkan pertanyaan, saran, atau kunjungi kampus <?= esc($profile['school_name']) ?> secara langsung.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <?= $this->include('partials/breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Kontak & Lokasi', 'url' => '']
        ]
    ]) ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-6">
        <!-- Contact Info Cards -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 space-y-6">
                <h2 class="text-xl font-black text-slate-900">Informasi Kontak Resmi</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Alamat Sekolah</h4>
                            <p class="text-xs text-slate-600 mt-0.5 leading-relaxed"><?= esc($profile['address']) ?></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Telepon / WhatsApp</h4>
                            <p class="text-xs text-slate-600 mt-0.5"><?= esc($profile['phone']) ?></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Email Resmi</h4>
                            <p class="text-xs text-slate-600 mt-0.5"><?= esc($profile['email']) ?></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Jam Operasional Pelayanan</h4>
                            <p class="text-xs text-slate-600 mt-0.5">Senin - Jumat: 07.00 - 16.00 WIB</p>
                            <p class="text-[11px] text-slate-400">Sabtu & Minggu: Libur</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100 space-y-6">
                <div>
                    <h2 class="text-xl font-black text-slate-900">Kirim Pesan / Pengaduan</h2>
                    <p class="text-xs text-slate-500 mt-1">Kami akan segera merespons pertanyaan atau keperluan Anda sesegera mungkin.</p>
                </div>

                <form action="<?= base_url('kontak/kirim') ?>" method="POST" class="space-y-4">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="<?= old('name') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition" placeholder="Nama Anda">
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                            <input type="email" name="email" id="email" value="<?= old('email') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition" placeholder="email@domain.com">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Subjek / Topik Pesan</label>
                        <input type="text" name="subject" id="subject" value="<?= old('subject') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition" placeholder="Contoh: Informasi Pendaftaran Siswa Baru">
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Isi Pesan</label>
                        <textarea name="message" id="message" rows="5" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition" placeholder="Tuliskan pertanyaan atau pesan Anda secara detail..."><?= old('message') ?></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md shadow-blue-600/20 transition">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <?php if (!empty($profile['map_embed'])): ?>
        <div class="mt-12 bg-white rounded-3xl p-4 shadow-sm border border-slate-100 overflow-hidden">
            <h3 class="text-sm font-bold text-slate-900 mb-3 px-2 flex items-center">
                <i class="fas fa-map-marked-alt text-blue-500 mr-2"></i> Lokasi Kampus Sekolah
            </h3>
            <div class="w-full h-96 rounded-2xl overflow-hidden">
                <?= $profile['map_embed'] ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
