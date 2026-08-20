<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Banner -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="px-3.5 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider border border-blue-500/30">
                Media & Dokumentasi
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white mt-3 tracking-tight">Galeri Foto & Video</h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2">Momen kegiatan belajar mengajar, sarana prasarana, pentas seni, dan perayaan prestasi di <?= esc($profile['school_name']) ?>.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ activeFilter: 'all' }">
    <!-- Breadcrumbs -->
    <?= $this->include('partials/breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Galeri & Media', 'url' => '']
        ]
    ]) ?>

    <!-- Filter Buttons -->
    <div class="mt-8 flex flex-wrap items-center gap-2 pb-6 border-b border-slate-200">
        <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition">
            Semua Media
        </button>
        <button @click="activeFilter = 'image'" :class="activeFilter === 'image' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition">
            <i class="fas fa-camera mr-1"></i> Foto
        </button>
        <button @click="activeFilter = 'video'" :class="activeFilter === 'video' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition">
            <i class="fas fa-video mr-1"></i> Video
        </button>

        <?php if (!empty($galleryCategories)): ?>
            <?php foreach ($galleryCategories as $gCat): ?>
                <button @click="activeFilter = '<?= esc($gCat) ?>'" :class="activeFilter === '<?= esc($gCat) ?>' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition">
                    <?= esc($gCat) ?>
                </button>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
        <?php if (!empty($galleries)): ?>
            <?php foreach ($galleries as $gal): ?>
                <div x-show="activeFilter === 'all' || activeFilter === '<?= $gal['type'] ?>' || activeFilter === '<?= esc($gal['category']) ?>'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col group hover:-translate-y-1">

                    <div class="aspect-[4/3] w-full overflow-hidden relative bg-slate-100">
                        <img src="<?= $gal['type'] === 'video' ? 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=600&q=80' : esc($gal['file_url']) ?>" alt="<?= esc($gal['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-white/95 backdrop-blur text-slate-800 shadow-sm">
                            <?= esc($gal['category']) ?>
                        </span>

                        <a href="<?= esc($gal['file_url']) ?>" class="glightbox absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white" data-gallery="school-gallery" data-title="<?= esc($gal['title']) ?>" data-description="<?= esc($gal['description'] ?? '') ?>">
                            <div class="w-12 h-12 rounded-full bg-blue-600/90 text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                                <i class="fas <?= $gal['type'] === 'video' ? 'fa-play ml-0.5' : 'fa-search-plus' ?> text-base"></i>
                            </div>
                        </a>
                    </div>

                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition line-clamp-1 leading-snug">
                                <?= esc($gal['title']) ?>
                            </h3>
                            <?php if (!empty($gal['description'])): ?>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                    <?= esc($gal['description']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
                <i class="fas fa-images text-4xl text-slate-300 mb-3"></i>
                <h3 class="text-base font-bold text-slate-800">Belum ada dokumentasi galeri</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
