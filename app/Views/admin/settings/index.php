<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6">
    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Pengaturan Sistem & Utilitas</h2>
    <p class="text-xs text-slate-500 mt-1">Informasi status server, versi framework, konfigurasi database, dan pembersihan cache.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Server & Environment Diagnostics (7 cols) -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-6">
        <h3 class="text-base font-bold text-slate-900 flex items-center">
            <i class="fas fa-server text-blue-500 mr-2"></i> Informasi Lingkungan Sistem
        </h3>

        <div class="space-y-3 text-xs">
            <div class="flex justify-between py-2.5 border-b border-slate-100">
                <span class="text-slate-500">Framework Versi:</span>
                <span class="font-bold text-slate-900">CodeIgniter v<?= esc($ciVersion) ?></span>
            </div>
            <div class="flex justify-between py-2.5 border-b border-slate-100">
                <span class="text-slate-500">PHP Version:</span>
                <span class="font-bold text-slate-900">PHP <?= esc($phpVersion) ?></span>
            </div>
            <div class="flex justify-between py-2.5 border-b border-slate-100">
                <span class="text-slate-500">Database Engine:</span>
                <span class="font-bold text-slate-900">MySQL (<?= esc($dbVersion) ?>)</span>
            </div>
            <div class="flex justify-between py-2.5 border-b border-slate-100">
                <span class="text-slate-500">Waktu Server (Timezone):</span>
                <span class="font-bold text-slate-900"><?= esc($serverTime) ?> (<?= esc($timezone) ?>)</span>
            </div>
            <div class="flex justify-between py-2.5 border-b border-slate-100">
                <span class="text-slate-500">Environment Mode:</span>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800 uppercase">
                    <?= ENVIRONMENT ?>
                </span>
            </div>
            <div class="flex justify-between py-2.5">
                <span class="text-slate-500">Base URL:</span>
                <span class="font-mono text-blue-600 font-semibold"><?= base_url() ?></span>
            </div>
        </div>
    </div>

    <!-- Cache & Maintenance Tools (5 cols) -->
    <div class="lg:col-span-5 space-y-6">
        <!-- Cache Tool Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-4">
            <h3 class="text-base font-bold text-slate-900 flex items-center">
                <i class="fas fa-broom text-amber-500 mr-2"></i> Manajemen Cache Aplikasi
            </h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Cache menyimpan data profil sekolah dan query populer untuk kecepatan akses. Jika baru saja mengubah data dan belum muncul di web publik, bersihkan cache aplikasi.
            </p>
            <div class="pt-2">
                <a href="<?= base_url('admin/pengaturan/clear-cache') ?>" class="inline-flex items-center w-full justify-center py-3 px-4 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-md shadow-amber-500/20 transition">
                    <i class="fas fa-sync-alt mr-2"></i> Bersihkan Semua Cache Sekarang
                </a>
            </div>
        </div>

        <!-- Security & Best Practice Card -->
        <div class="bg-gradient-to-br from-slate-900 to-blue-950 rounded-3xl p-6 text-white shadow-sm space-y-3">
            <h4 class="text-sm font-bold text-white flex items-center">
                <i class="fas fa-shield-alt text-amber-400 mr-2"></i> Proteksi Keamanan Aktif
            </h4>
            <ul class="text-xs text-slate-300 space-y-1.5 list-disc list-inside">
                <li>CSRF Token Validation pada setiap request POST</li>
                <li>XSS Output Escaping dengan <code class="text-blue-400 font-mono">esc()</code></li>
                <li>Penyimpanan password terenkripsi <code class="text-blue-400 font-mono">Bcrypt</code></li>
                <li>Validasi MIME Type berkas unggahan gambar</li>
                <li>Role-Based Access Control Middleware</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
