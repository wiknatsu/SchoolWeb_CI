<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- 1. Hero Section & Swiper Slider -->
<section class="relative bg-slate-900 text-white overflow-hidden">
    <!-- Background Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-blue-900/80 z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-semibold">
                    <i class="fas fa-certificate text-amber-400"></i>
                    <span>Terakreditasi <?= esc($profile['accreditation'] ?? 'A (Unggul)') ?> &bull; Berdiri Sejak <?= esc($profile['established_year'] ?? '1985') ?></span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-tight">
                    Mewujudkan <span class="bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">Generasi Unggul</span> & Berkarakter Global
                </h1>

                <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl">
                    <?= esc($profile['description'] ?? 'Institusi pendidikan terdepan yang memadukan keunggulan akademik, sains teknologi mutakhir, karakter kebangsaan, dan lingkungan belajar inklusif.') ?>
                </p>

                <div class="pt-4 flex flex-wrap gap-4 items-center">
                    <a href="<?= base_url('profil/tentang') ?>" class="inline-flex items-center px-6 py-3.5 rounded-xl font-bold text-sm bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-500/25 transition transform hover:-translate-y-0.5">
                        <i class="fas fa-university mr-2"></i> Jelajahi Profil Sekolah
                    </a>
                    <a href="<?= base_url('berita') ?>" class="inline-flex items-center px-6 py-3.5 rounded-xl font-bold text-sm bg-slate-800/80 text-slate-200 hover:bg-slate-800 hover:text-white border border-slate-700 transition">
                        <i class="fas fa-newspaper mr-2 text-amber-400"></i> Kabar & Berita Terbaru
                    </a>
                </div>

                <!-- Fast Facts -->
                <div class="pt-8 grid grid-cols-3 gap-6 border-t border-slate-800/80">
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-blue-400">100%</p>
                        <p class="text-xs text-slate-400 font-medium mt-0.5">Lulusan Kompeten</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-cyan-400">50+</p>
                        <p class="text-xs text-slate-400 font-medium mt-0.5">Prestasi Nasional</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-amber-400">20+</p>
                        <p class="text-xs text-slate-400 font-medium mt-0.5">Ekstrakurikuler</p>
                    </div>
                </div>
            </div>

            <!-- Right Hero Slider / Highlight Card -->
            <div class="lg:col-span-5">
                <div class="swiper heroSwiper rounded-3xl shadow-2xl border border-slate-700/60 overflow-hidden bg-slate-800/50">
                    <div class="swiper-wrapper">
                        <?php if (!empty($highlightedNews)): ?>
                            <?php foreach ($highlightedNews as $hNews): ?>
                                <div class="swiper-slide relative group">
                                    <div class="aspect-[4/3] w-full overflow-hidden relative">
                                        <img src="<?= get_image_url($hNews['featured_image'], 'news') ?>" alt="<?= esc($hNews['title']) ?>" width="1200" height="900" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                                        <div class="absolute top-4 left-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-600 text-white shadow-md">
                                                <i class="fas fa-star mr-1 text-amber-300"></i> Sorotan Utama
                                            </span>
                                        </div>
                                        <div class="absolute bottom-6 left-6 right-6 space-y-2">
                                            <span class="text-xs font-semibold text-blue-400 flex items-center">
                                                <i class="far fa-calendar-alt mr-1.5"></i> <?= format_date_indo($hNews['published_at']) ?>
                                            </span>
                                            <h3 class="text-lg sm:text-xl font-bold text-white leading-snug line-clamp-2">
                                                <a href="<?= base_url('berita/' . $hNews['slug']) ?>" class="hover:text-blue-400 transition">
                                                    <?= esc($hNews['title']) ?>
                                                </a>
                                            </h3>
                                            <p class="text-xs text-slate-300 line-clamp-2"><?= esc($hNews['excerpt']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="swiper-slide">
                                <div class="aspect-[4/3] w-full bg-slate-800 flex items-center justify-center p-8 text-center">
                                    <div>
                                        <i class="fas fa-graduation-cap text-5xl text-blue-400 mb-3"></i>
                                        <h3 class="text-lg font-bold text-white"><?= esc($profile['school_name']) ?></h3>
                                        <p class="text-xs text-slate-400 mt-1"><?= esc($profile['slogan']) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Sambutan Kepala Sekolah Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Principal Photo & Card -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative max-w-sm w-full">
                    <!-- Decorative blur bg -->
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-indigo-500 rounded-3xl blur-lg opacity-25"></div>
                    
                    <div class="relative bg-white rounded-3xl overflow-hidden shadow-xl border border-slate-100 p-3">
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100">
                            <img src="<?= get_image_url($profile['principal_photo'] ?? null, 'principal') ?>" alt="Kepala Sekolah" width="800" height="1066" loading="lazy" decoding="async" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-black text-slate-900 leading-tight"><?= esc($profile['principal_name'] ?? 'I Nyoman Budiasa, S.Pd., M.M.') ?></h3>
                            <p class="text-xs font-bold text-blue-600 mt-1">Kepala <?= esc($profile['school_name'] ?? 'SMP Negeri 3 Abiansemal') ?></p>
                            <div class="mt-3 pt-3 border-t border-slate-100 text-[11px] text-slate-500 italic font-medium">
                                "Mendidik dengan Hati, Memimpin dengan Cerdas"
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Sambutan Pimpinan -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-md border border-blue-100">
                        <i class="fas fa-comment-dots mr-1.5"></i> Sambutan Pimpinan
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">Selamat Datang di Portal Resmi Sekolah</h2>
                </div>

                <div class="prose prose-slate text-slate-600 leading-relaxed text-sm sm:text-base">
                    <?= $profile['principal_welcome'] ?? '<p>Selamat datang di portal resmi sekolah kami. Kami berkomitmen menyelenggarakan pendidikan berkualitas dan berkarakter.</p>' ?>
                </div>

                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="<?= base_url('profil/tentang') ?>" class="inline-flex items-center px-5 py-3 rounded-xl font-bold text-xs bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
                        <i class="fas fa-university mr-2"></i> Profil Lengkap Sekolah
                    </a>
                    <a href="<?= base_url('kontak') ?>" class="inline-flex items-center px-5 py-3 rounded-xl font-bold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        <i class="fas fa-envelope mr-2 text-slate-500"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Visi & Misi Satuan Pendidikan (Dedicated Stand-alone Section) -->
<section class="py-20 bg-slate-50 border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/80 px-3.5 py-1.5 rounded-full border border-blue-200">
                <i class="fas fa-compass mr-1.5"></i> Arah & Komitmen Pendidikan
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">Visi & Misi Satuan Pendidikan</h2>
            <p class="text-sm sm:text-base text-slate-600 mt-2">
                Fondasi utama dalam membentuk murid CEMPAKA (Cerdas, Empati, Berkarakter) berlandaskan kearifan lokal Tri Hita Karana.
            </p>
        </div>

        <!-- Vision & Mission 2-Col Grid Showcase -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Left: Visi Highlight Card (5 Cols) -->
            <div class="lg:col-span-5 flex flex-col">
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 text-white p-8 sm:p-10 shadow-xl flex-1 flex flex-col justify-between">
                    <div class="absolute -right-8 -bottom-8 opacity-10 text-white text-9xl pointer-events-none">
                        <i class="fas fa-quote-right"></i>
                    </div>

                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-500/25 text-cyan-300 text-xs font-bold border border-blue-400/30">
                                <i class="fas fa-eye mr-1.5 text-cyan-400"></i> Visi Utama
                            </span>
                            <span class="text-xs text-blue-200/80 font-medium">SMP Negeri 3 Abiansemal</span>
                        </div>

                        <div>
                            <h3 class="text-xs uppercase tracking-wider text-blue-300 font-bold mb-2">Cita-Cita Luhur</h3>
                            <p class="text-xl sm:text-2xl font-black tracking-tight leading-relaxed italic text-white/95">
                                "<?= esc($profile['vision'] ?? 'Terwujudnya murid yang CEMPAKA berlandaskan Tri Hita Karana.') ?>"
                            </p>
                        </div>

                        <!-- 3 Pillars Mini Tags -->
                        <div class="pt-4 border-t border-blue-800/80 grid grid-cols-3 gap-2 text-center">
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <p class="text-[10px] text-blue-300 font-bold uppercase">Parahyangan</p>
                                <p class="text-[9px] text-slate-300 mt-0.5">Ketuhanan</p>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <p class="text-[10px] text-cyan-300 font-bold uppercase">Pawongan</p>
                                <p class="text-[9px] text-slate-300 mt-0.5">Kemanusiaan</p>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                <p class="text-[10px] text-emerald-300 font-bold uppercase">Palemahan</p>
                                <p class="text-[9px] text-slate-300 mt-0.5">Kelestarian</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 pt-6 mt-6 border-t border-white/10">
                        <a href="<?= base_url('profil/tentang') ?>" class="inline-flex items-center text-xs font-bold text-cyan-300 hover:text-cyan-200 transition">
                            Pelajari Selengkapnya di Halaman Profil <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Misi List Card (7 Cols) -->
            <div class="lg:col-span-7 flex flex-col">
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200/80 flex-1 flex flex-col justify-between space-y-6">
                    <div>
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold border border-indigo-100">
                                <i class="fas fa-bullseye mr-1.5 text-indigo-600"></i> Misi Satuan Pendidikan
                            </span>
                            <span class="text-xs font-medium text-slate-400">Langkah Strategis Nyata</span>
                        </div>

                        <div class="mt-6 space-y-3.5">
                            <?php
                            $rawMission = trim($profile['mission'] ?? '');
                            $missionLines = array_filter(array_map('trim', explode("\n", $rawMission)));
                            ?>

                            <?php if (!empty($missionLines)): ?>
                                <?php 
                                $mCount = 1;
                                foreach ($missionLines as $mLine): 
                                    $cleanMLine = preg_replace('/^\d+[\.\)]\s*/', '', $mLine);
                                ?>
                                    <div class="flex items-start space-x-3.5 p-3.5 rounded-2xl bg-slate-50 hover:bg-indigo-50/40 border border-slate-100 hover:border-indigo-200 transition group">
                                        <div class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-md shadow-indigo-600/20 group-hover:scale-105 transition transform mt-0.5">
                                            <?= $mCount ?>
                                        </div>
                                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium pt-0.5">
                                            <?= esc($cleanMLine) ?>
                                        </p>
                                    </div>
                                <?php 
                                    $mCount++;
                                endforeach; 
                                ?>
                            <?php else: ?>
                                <p class="text-xs text-slate-500 italic"><?= nl2br(esc($profile['mission'] ?? 'Belum ada data misi sekolah.')) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400 font-medium">Berdasarkan Kurikulum & Tata Kelola Sekolah</span>
                        <a href="<?= base_url('profil/tentang') ?>" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                            Lihat Nilai-Nilai Utama <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Portal Link Aplikasi Sekolah Section -->
<section id="aplikasi-sekolah" class="py-20 bg-slate-900 text-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-400 bg-blue-950/80 px-3.5 py-1.5 rounded-full border border-blue-500/30">
                <i class="fas fa-laptop-code mr-1.5"></i> Ekosistem Digital Sekolah
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-white mt-3 tracking-tight">Portal Layanan & Aplikasi Terintegrasi</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Akses cepat seluruh platform digital pembelajaran, administrasi, dan perpustakaan sekolah.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($schoolApps)): ?>
                <?php foreach ($schoolApps as $app): ?>
                    <div class="group bg-slate-800/80 backdrop-blur border border-slate-700 hover:border-blue-500/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-950/40 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white text-xl shadow-md shadow-blue-500/20 group-hover:scale-110 transition duration-300">
                                    <i class="<?= esc($app['icon'] ?: 'fas fa-external-link-alt') ?>"></i>
                                </div>
                                <?= app_category_badge($app['category']) ?>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition"><?= esc($app['name']) ?></h3>
                            <p class="text-xs text-slate-400 mt-2 leading-relaxed"><?= esc($app['description']) ?></p>
                        </div>
                        <div class="pt-6 mt-4 border-t border-slate-700/60">
                            <a href="<?= esc($app['url']) ?>" target="_blank" rel="noopener" class="inline-flex items-center text-xs font-bold text-blue-400 group-hover:text-blue-300 transition">
                                <span>Buka Aplikasi</span>
                                <i class="fas fa-arrow-right ml-2 text-[10px] transform group-hover:translate-x-1 transition"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 4. Berita & Informasi Terbaru Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/60 px-3 py-1 rounded-md">Warta & Kabar</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-2 tracking-tight">Berita & Agenda Sekolah Terkini</h2>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="<?= base_url('berita') ?>" class="inline-flex items-center font-bold text-sm text-blue-600 hover:text-blue-700 transition">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $news): ?>
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col group hover:-translate-y-1">
                        <!-- Thumbnail -->
                        <div class="aspect-[16/10] overflow-hidden relative bg-slate-100">
                            <img src="<?= get_image_url($news['featured_image'], 'news') ?>" alt="<?= esc($news['title']) ?>" width="1200" height="750" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <?php if (!empty($news['category_name'])): ?>
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-xs font-bold bg-white/90 backdrop-blur-sm text-slate-800 shadow-sm">
                                    <?= esc($news['category_name']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex items-center space-x-3 text-xs text-slate-400 mb-2.5">
                                    <span><i class="far fa-calendar-alt mr-1"></i> <?= format_date_indo($news['published_at']) ?></span>
                                    <span>&bull;</span>
                                    <span><i class="far fa-clock mr-1"></i> <?= reading_time($news['content']) ?></span>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                    <a href="<?= base_url('berita/' . $news['slug']) ?>">
                                        <?= esc($news['title']) ?>
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                    <?= esc($news['excerpt'] ?: excerpt_words($news['content'], 20)) ?>
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-medium text-slate-400">
                                    <i class="far fa-eye mr-1"></i> <?= number_format($news['view_count']) ?> views
                                </span>
                                <a href="<?= base_url('berita/' . $news['slug']) ?>" class="inline-flex items-center text-xs font-bold text-blue-600 group-hover:text-blue-700">
                                    Baca Selengkapnya <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 5. Galeri Foto & Dokumentasi Teaser Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/60 px-3 py-1 rounded-md">Dokumentasi</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-2 tracking-tight">Galeri Kegiatan Sekolah</h2>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="<?= base_url('galeri') ?>" class="inline-flex items-center font-bold text-sm text-blue-600 hover:text-blue-700 transition">
                    Lihat Semua Galeri <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php if (!empty($galleries)): ?>
                <?php foreach ($galleries as $gal): ?>
                    <a href="<?= esc($gal['file_url']) ?>" class="glightbox group relative aspect-square rounded-2xl overflow-hidden bg-slate-100 shadow-sm hover:shadow-lg transition block" data-gallery="home-gallery" data-title="<?= esc($gal['title']) ?>" data-description="<?= esc($gal['description'] ?? '') ?>">
                        <img src="<?= esc($gal['file_url']) ?>" alt="<?= esc($gal['title']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center p-3 text-center">
                            <div>
                                <i class="fas <?= $gal['type'] === 'video' ? 'fa-play-circle text-2xl' : 'fa-search-plus text-xl' ?> text-white mb-1"></i>
                                <p class="text-[11px] font-bold text-white line-clamp-2"><?= esc($gal['title']) ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 6. Lokasi & Peta Embed Section -->
<?php if (!empty($profile['map_embed'])): ?>
<section class="bg-slate-100 relative">
    <div class="w-full h-96 overflow-hidden rounded-t-3xl shadow-inner">
        <?= $profile['map_embed'] ?>
    </div>
</section>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>
<?= $this->endSection() ?>
