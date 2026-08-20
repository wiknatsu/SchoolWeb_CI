<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <?= $this->include('partials/breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Berita', 'url' => base_url('berita')],
            ['title' => $news['category_name'] ?? 'Kategori', 'url' => !empty($news['category_slug']) ? base_url('berita/kategori/' . $news['category_slug']) : ''],
            ['title' => $news['title'], 'url' => '']
        ]
    ]) ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-6">
        <!-- Main Article Body -->
        <article class="lg:col-span-8 space-y-8">
            <header class="space-y-4">
                <?php if (!empty($news['category_name'])): ?>
                    <a href="<?= base_url('berita/kategori/' . $news['category_slug']) ?>" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-800 hover:bg-blue-200 transition">
                        <i class="<?= esc($news['category_icon'] ?: 'fas fa-tag') ?> mr-1.5 text-[10px]"></i> <?= esc($news['category_name']) ?>
                    </a>
                <?php endif; ?>

                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 leading-tight tracking-tight">
                    <?= esc($news['title']) ?>
                </h1>

                <!-- Meta bar -->
                <div class="flex flex-wrap items-center justify-between gap-4 py-4 border-y border-slate-200 text-xs text-slate-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">
                            <?= strtoupper(substr($news['author_name'] ?? 'A', 0, 1)) ?>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800"><?= esc($news['author_name'] ?? 'Redaksi Sekolah') ?></p>
                            <p class="text-[11px] text-slate-400">Penulis & Redaksi</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span><i class="far fa-calendar-alt mr-1 text-blue-600"></i> <?= format_date_indo($news['published_at']) ?></span>
                        <span>&bull;</span>
                        <span><i class="far fa-clock mr-1 text-blue-600"></i> <?= reading_time($news['content']) ?></span>
                        <span>&bull;</span>
                        <span><i class="far fa-eye mr-1 text-blue-600"></i> <?= number_format($news['view_count']) ?> views</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <?php if (!empty($news['featured_image'])): ?>
                <div class="aspect-[16/9] w-full rounded-3xl overflow-hidden shadow-lg bg-slate-100">
                    <img src="<?= get_image_url($news['featured_image'], 'news') ?>" alt="<?= esc($news['title']) ?>" class="w-full h-full object-cover">
                </div>
            <?php endif; ?>

            <!-- Article Excerpt Highlight -->
            <?php if (!empty($news['excerpt'])): ?>
                <div class="p-5 rounded-2xl bg-blue-50/60 border-l-4 border-blue-500 text-slate-700 italic font-medium text-base leading-relaxed">
                    <?= esc($news['excerpt']) ?>
                </div>
            <?php endif; ?>

            <!-- Article Body (Summernote HTML) -->
            <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed space-y-4">
                <?= $news['content'] ?>
            </div>

            <!-- Social Share Bar -->
            <div class="pt-8 border-t border-slate-200">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50 p-6 rounded-2xl border border-slate-200">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        <i class="fas fa-share-alt mr-1.5 text-blue-600"></i> Bagikan Artikel:
                    </span>
                    <div class="flex items-center space-x-2">
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($news['title'] . ' - ' . current_url()) ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold flex items-center transition">
                            <i class="fab fa-whatsapp mr-1.5 text-sm"></i> WhatsApp
                        </a>
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold flex items-center transition">
                            <i class="fab fa-facebook-f mr-1.5 text-sm"></i> Facebook
                        </a>
                        <!-- Twitter / X -->
                        <a href="https://twitter.com/intent/tweet?text=<?= urlencode($news['title']) ?>&url=<?= urlencode(current_url()) ?>" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-black text-white text-xs font-bold flex items-center transition">
                            <i class="fab fa-x-twitter mr-1.5 text-sm"></i> Twitter
                        </a>
                        <!-- Copy Link -->
                        <button type="button" onclick="copyArticleUrl()" class="px-3 py-1.5 rounded-lg bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold flex items-center transition" title="Salin Tautan">
                            <i class="fas fa-link mr-1"></i> Salin
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <?php if (!empty($relatedNews)): ?>
                <section class="pt-8 space-y-6">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center">
                        <span class="w-2 h-5 bg-blue-600 rounded mr-2.5"></span> Berita Terkait Lainnya
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <?php foreach ($relatedNews as $rNews): ?>
                            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition border border-slate-100 group">
                                <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                                    <img src="<?= get_image_url($rNews['featured_image'], 'news') ?>" alt="<?= esc($rNews['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                                <div class="p-4 space-y-2">
                                    <span class="text-[10px] text-slate-400 block"><?= format_date_indo($rNews['published_at']) ?></span>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition line-clamp-2 leading-snug">
                                        <a href="<?= base_url('berita/' . $rNews['slug']) ?>"><?= esc($rNews['title']) ?></a>
                                    </h4>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
        </article>

        <!-- Sidebar Widgets -->
        <aside class="lg:col-span-4 space-y-8">
            <!-- Popular News -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-base font-bold text-slate-900 flex items-center">
                    <i class="fas fa-fire text-rose-500 mr-2"></i> Berita Terpopuler
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

            <!-- Categories -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center">
                    <i class="fas fa-folder text-blue-500 mr-2"></i> Kategori Berita
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
        </aside>
    </div>
</div>

<script>
function copyArticleUrl() {
    navigator.clipboard.writeText(window.location.href);
    Swal.fire({
        icon: 'success',
        title: 'Tautan Disalin!',
        text: 'Link artikel telah disalin ke papan klip.',
        timer: 2000,
        showConfirmButton: false,
    });
}
</script>
<?= $this->endSection() ?>
