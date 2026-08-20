<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Banner -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="px-3.5 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider border border-blue-500/30">
                Profil Lembaga
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white mt-3 tracking-tight">Tentang Sekolah & Visi Misi</h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2">Mengenal rekam jejak, komitmen keunggulan pendidikan, dan nilai-nilai luhur <?= esc($profile['school_name']) ?>.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <?= $this->include('partials/breadcrumb', ['breadcrumbs' => [['title' => 'Profil', 'url' => ''], ['title' => 'Tentang Kami', 'url' => '']]]) ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mt-6">
        <!-- Main Content -->
        <div class="lg:col-span-8 space-y-12">
            <!-- 1. Profil Singkat -->
            <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 space-y-4">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <h2 class="text-2xl font-black text-slate-900 flex items-center">
                        <span class="w-2.5 h-6 bg-blue-600 rounded mr-3"></span> Profil Singkat
                    </h2>
                    <span class="text-xs font-bold px-3 py-1 bg-slate-100 text-slate-600 rounded-full">
                        Berdiri <?= esc($profile['established_year'] ?? '1984') ?>
                    </span>
                </div>
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm sm:text-base">
                    <p><?= nl2br(esc($profile['description'])) ?></p>
                </div>
            </section>

            <!-- 2. Visi Sekolah Section -->
            <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-md">Cita-Cita & Pandangan</span>
                        <h2 class="text-2xl font-black text-slate-900 flex items-center mt-2">
                            <span class="w-2.5 h-6 bg-blue-600 rounded mr-3"></span> Visi Sekolah
                        </h2>
                    </div>
                    <div class="hidden sm:flex w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 items-center justify-center text-xl shadow-sm">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <!-- Visi Card Highlight -->
                <div class="relative overflow-hidden p-8 rounded-3xl bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 text-white shadow-xl">
                    <div class="absolute -right-8 -bottom-8 opacity-10 text-white text-9xl pointer-events-none">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    
                    <div class="relative z-10 space-y-4">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-500/20 text-cyan-300 text-xs font-semibold border border-blue-400/30">
                            <i class="fas fa-compass text-xs"></i>
                            <span>Visi Utama Lembaga</span>
                        </div>
                        <p class="text-lg sm:text-2xl font-black tracking-tight leading-relaxed italic text-white/95">
                            "<?= esc($profile['vision']) ?>"
                        </p>
                        <p class="text-xs text-blue-200/80 font-medium">
                            Menjadi pedoman arah pendidikan, pembentukan karakter murid, dan tata kelola satuan pendidikan di lingkungan <?= esc($profile['school_name']) ?>.
                        </p>
                    </div>
                </div>
            </section>

            <!-- 3. Misi Sekolah Section -->
            <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-md">Langkah Strategis</span>
                        <h2 class="text-2xl font-black text-slate-900 flex items-center mt-2">
                            <span class="w-2.5 h-6 bg-indigo-600 rounded mr-3"></span> Misi Satuan Pendidikan
                        </h2>
                    </div>
                    <div class="hidden sm:flex w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 items-center justify-center text-xl shadow-sm">
                        <i class="fas fa-bullseye"></i>
                    </div>
                </div>

                <p class="text-sm text-slate-500">
                    Komitmen dan tindakan nyata yang dilaksanakan secara berkesinambungan untuk mewujudkan visi sekolah:
                </p>

                <?php
                $rawMission = trim($profile['mission'] ?? '');
                $missionLines = array_filter(array_map('trim', explode("\n", $rawMission)));
                ?>

                <?php if (!empty($missionLines)): ?>
                    <div class="grid grid-cols-1 gap-4">
                        <?php 
                        $counter = 1;
                        foreach ($missionLines as $line): 
                            $cleanLine = preg_replace('/^\d+[\.\)]\s*/', '', $line);
                        ?>
                            <div class="flex items-start space-x-4 p-5 rounded-2xl bg-slate-50 hover:bg-blue-50/50 border border-slate-100 hover:border-blue-200 transition group">
                                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex-shrink-0 flex items-center justify-center font-bold text-sm shadow-md shadow-indigo-600/20 group-hover:scale-110 transition transform">
                                    <?= $counter ?>
                                </div>
                                <div class="text-sm text-slate-700 leading-relaxed font-medium pt-1">
                                    <?= esc($cleanLine) ?>
                                </div>
                            </div>
                        <?php 
                            $counter++;
                        endforeach; 
                        ?>
                    </div>
                <?php else: ?>
                    <div class="p-6 rounded-2xl bg-slate-50 text-sm text-slate-600">
                        <?= nl2br(esc($profile['mission'] ?? 'Belum ada data misi sekolah.')) ?>
                    </div>
                <?php endif; ?>
            </section>

            <!-- 4. Nilai Inti -->
            <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 space-y-6">
                <h2 class="text-2xl font-black text-slate-900 flex items-center">
                    <span class="w-2.5 h-6 bg-blue-600 rounded mr-3"></span> Nilai-Nilai Utama (Core Values)
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 mx-auto flex items-center justify-center text-xl font-bold mb-3">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Integritas & Akhlak</h4>
                        <p class="text-xs text-slate-500 mt-1">Mengutamakan kejujuran, religiusitas, dan budi pekerti luhur.</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 mx-auto flex items-center justify-center text-xl font-bold mb-3">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Keunggulan Mutu</h4>
                        <p class="text-xs text-slate-500 mt-1">Berkomitmen mencapai standar akademik dan prestasi terbaik.</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 mx-auto flex items-center justify-center text-xl font-bold mb-3">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Karakter CEMPAKA</h4>
                        <p class="text-xs text-slate-500 mt-1">Cerdas, Empati, dan Berkarakter berlandaskan Tri Hita Karana.</p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Kepala Sekolah Card -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 text-center">
                <div class="aspect-square w-40 rounded-2xl overflow-hidden bg-slate-100 mx-auto shadow-md mb-4">
                    <img src="<?= get_image_url($profile['principal_photo'] ?? null, 'principal') ?>" alt="Kepala Sekolah" class="w-full h-full object-cover">
                </div>
                <h3 class="text-base font-bold text-slate-900"><?= esc($profile['principal_name']) ?></h3>
                <p class="text-xs font-semibold text-blue-600 mt-0.5">Kepala Sekolah</p>
                <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-500 italic">
                    "Mendidik dengan Hati, Memimpin dengan Cerdas."
                </div>
            </div>

            <!-- Identitas Lengkap -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Identitas Satuan Pendidikan</h3>
                <div class="space-y-3 text-xs">
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Nama Resmi:</span>
                        <span class="font-bold text-slate-800 text-right"><?= esc($profile['school_name']) ?></span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Akreditasi:</span>
                        <span class="font-bold text-amber-600"><?= esc($profile['accreditation'] ?? 'A') ?></span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Tahun Berdiri:</span>
                        <span class="font-bold text-slate-800"><?= esc($profile['established_year'] ?? '1984') ?></span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Email:</span>
                        <span class="font-semibold text-slate-800"><?= esc($profile['email'] ?? '-') ?></span>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <span class="text-slate-400">Telepon:</span>
                        <span class="font-semibold text-slate-800"><?= esc($profile['phone'] ?? '-') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
