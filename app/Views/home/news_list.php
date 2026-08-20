<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Banner -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="px-3.5 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider border border-blue-500/30">
                Pusat Informasi
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white mt-3 tracking-tight">
                <?= !empty($activeCategory) ? 'Kategori: ' . esc($activeCategory['name']) : 'Kabar & Berita Sekolah' ?>
            </h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2">
                <?= !empty($activeCategory['description']) ? esc($activeCategory['description']) : 'Informasi resmi seputar agenda, prestasi siswa, program kurikulum, dan pengumuman sekolah.' ?>
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <?= $this->include('partials/breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Berita', 'url' => base_url('berita')],
            ['title' => !empty($activeCategory) ? $activeCategory['name'] : 'Semua Berita', 'url' => '']
        ]
    ]) ?>

    <!-- Category Pills Filter & Search Bar -->
    <div class="mt-8 flex flex-col lg:flex-row items-center justify-between gap-6 pb-8 border-b border-slate-200">
        <!-- Category Filter Pills -->
        <div class="flex items-center space-x-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 scrollbar-none">
            <a href="<?= base_url('berita') ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= empty($activeCategory) ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' ?>">
                Semua Kategori
            </a>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= base_url('berita/kategori/' . $cat['slug']) ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= (!empty($activeCategory) && $activeCategory['id'] == $cat['id']) ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' ?>">
                        <i class="<?= esc($cat['icon'] ?: 'fas fa-tag') ?> mr-1 text-[10px]"></i> <?= esc($cat['name']) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Search Box -->
        <form action="<?= base_url('berita') ?>" method="GET" class="w-full lg:w-80 relative">
            <input type="text" name="q" value="<?= esc($keyword ?? '') ?>" placeholder="Cari judul atau topik..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fas fa-search text-xs"></i>
            </div>
            <?php if (!empty($keyword)): ?>
                <a href="<?= base_url('berita') ?>" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 text-xs">
                    <i class="fas fa-times"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Main Grid Content with Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-10">
        <!-- News Grid -->
        <div class="lg:col-span-8 space-y-8">
            <?php if (!empty($newsList)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($newsList as $news): ?>
                        <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col group hover:-translate-y-1">
                            <div class="aspect-[16/10] overflow-hidden relative bg-slate-100">
                                <img src="<?= get_image_url($news['featured_image'], 'news') ?>" alt="<?= esc($news['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <?php if (!empty($news['category_name'])): ?>
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-xs font-bold bg-white/95 backdrop-blur text-slate-800 shadow-sm">
                                        <?= esc($news['category_name']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    <div class="flex items-center space-x-3 text-xs text-slate-400 mb-2.5">
                                        <span><i class="far fa-calendar-alt mr-1"></i> <?= format_date_indo($news['published_at']) ?></span>
                                        <span>&bull;</span>
                                        <span><i class="far fa-clock mr-1"></i> <?= reading_time($news['content']) ?></span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                        <a href="<?= base_url('berita/' . $news['slug']) ?>">
                                            <?= esc($news['title']) ?>
                                        </a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                        <?= esc($news['excerpt'] ?: excerpt_words($news['content'], 20)) ?>
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-xs text-slate-400">
                                        <i class="far fa-eye mr-1"></i> <?= number_format($news['view_count']) ?> views
                                    </span>
                                    <a href="<?= base_url('berita/' . $news['slug']) ?>" class="inline-flex items-center text-xs font-bold text-blue-600 group-hover:text-blue-700">
                                        Baca Artikel <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="pt-8 flex justify-center">
                    <?= $pager->links('news', 'default_full') ?>
                </div>

            <?php else: ?>
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm space-y-4">
                    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Tidak ada berita yang ditemukan</h3>
                    <p class="text-sm text-slate-500 max-w-sm mx-auto">Coba gunakan kata kunci pencarian yang lain atau pilih kategori yang berbeda.</p>
                    <a href="<?= base_url('berita') ?>" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white hover:bg-blue-700 transition">
                        Reset Filter & Pencarian
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Popular News Widget -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-base font-bold text-slate-900 flex items-center">
                    <i class="fas fa-fire text-rose-500 mr-2"></i> Berita Populer
                </h3>
                <div class="space-y-4 divide-y divide-slate-100">
                    <?php if (!empty($popularNews)): ?>
                        <?php foreach ($popularNews as $pIdx => $pNews): ?>
                            <div class="pt-4 first:pt-0 flex items-start space-x-3 group">
                                <span class="text-2xl font-black text-slate-200 group-hover:text-blue-500 transition w-6 flex-shrink-0">
                                    0<?= $pIdx + 1 ?>
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                        <a href="<?= base_url('berita/' . $pNews['slug']) ?>">
                                            <?= esc($pNews['title']) ?>
                                        </a>
                                    </h4>
                                    <div class="flex items-center space-x-2 text-[10px] text-slate-400 mt-1">
                                        <span><?= format_date_indo($pNews['published_at']) ?></span>
                                        <span>&bull;</span>
                                        <span><i class="far fa-eye"></i> <?= number_format($pNews['view_count']) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Categories List Widget -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center">
                    <i class="fas fa-folder text-blue-500 mr-2"></i> Semua Kategori
                </h3>
                <ul class="space-y-1.5 text-sm">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="<?= base_url('berita/kategori/' . $cat['slug']) ?>" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                    <span class="flex items-center">
                                        <i class="<?= esc($cat['icon'] ?: 'fas fa-tag') ?> w-4 text-blue-500 mr-2 text-[10px]"></i>
                                        <?= esc($cat['name']) ?>
                                    </span>
                                    <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
