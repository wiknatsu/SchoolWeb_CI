<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Banner -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="px-3.5 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider border border-blue-500/30">
                Informasi & Profil
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white mt-3 tracking-tight"><?= esc($page['title']) ?></h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2"><?= esc($profile['school_name']) ?></p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <?= $this->include('partials/breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Halaman', 'url' => ''],
            ['title' => $page['title'], 'url' => '']
        ]
    ]) ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-6">
        <!-- Main Page Content -->
        <main class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100 space-y-6">
                <?php if (!empty($page['featured_image'])): ?>
                    <div class="aspect-[16/9] w-full rounded-2xl overflow-hidden shadow-md mb-6">
                        <img src="<?= get_image_url($page['featured_image'], 'profiles') ?>" alt="<?= esc($page['title']) ?>" class="w-full h-full object-cover">
                    </div>
                <?php endif; ?>

                <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed">
                    <?= $page['content'] ?>
                </div>
            </div>
        </main>

        <!-- Sidebar Navigation -->
        <aside class="lg:col-span-4 space-y-6">
            <!-- Other Pages Menu -->
            <?php if (!empty($otherPages)): ?>
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-3">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Halaman Terkait</h3>
                    <ul class="space-y-1.5 text-sm">
                        <?php foreach ($otherPages as $oPage): ?>
                            <li>
                                <a href="<?= base_url('profil/' . $oPage['slug']) ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                    <span><i class="fas fa-file-alt text-blue-500 mr-2"></i> <?= esc($oPage['title']) ?></span>
                                    <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li>
                            <a href="<?= base_url('profil/tentang') ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <span><i class="fas fa-university text-blue-500 mr-2"></i> Tentang Kami & Visi Misi</span>
                                <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Contact Box -->
            <div class="bg-gradient-to-br from-slate-900 to-blue-950 rounded-3xl p-6 text-white shadow-md space-y-4">
                <h3 class="text-base font-bold text-white">Butuh Informasi Tambahan?</h3>
                <p class="text-xs text-slate-300 leading-relaxed">Silakan hubungi layanan informasi resmi kami untuk konsultasi dan informasi pendaftaran.</p>
                <a href="<?= base_url('kontak') ?>" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 text-white hover:bg-blue-700 shadow-md transition">
                    <i class="fas fa-envelope mr-2"></i> Hubungi Sekolah
                </a>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>
