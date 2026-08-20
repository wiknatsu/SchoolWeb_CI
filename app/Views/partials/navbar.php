<?php
$social = [];
if (!empty($profile['social_media'])) {
    $social = is_string($profile['social_media']) ? json_decode($profile['social_media'], true) : $profile['social_media'];
}
?>

<!-- 1. Top Announcement Header Bar -->
<div class="bg-slate-950 text-slate-300 text-xs py-2.5 px-4 border-b border-slate-800/80 hidden md:block">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Left: Verified Contact Info & Accreditation -->
        <div class="flex items-center space-x-6">
            <?php if (!empty($profile['phone'])): ?>
                <a href="tel:<?= esc($profile['phone']) ?>" class="flex items-center hover:text-cyan-400 transition">
                    <i class="fas fa-phone-alt text-cyan-400 mr-2 text-[11px]"></i> <?= esc($profile['phone']) ?>
                </a>
            <?php endif; ?>
            <?php if (!empty($profile['email'])): ?>
                <a href="mailto:<?= esc($profile['email']) ?>" class="flex items-center hover:text-cyan-400 transition">
                    <i class="fas fa-envelope text-cyan-400 mr-2 text-[11px]"></i> <?= esc($profile['email']) ?>
                </a>
            <?php endif; ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-amber-400/10 text-amber-300 font-semibold border border-amber-400/20 text-[11px]">
                <i class="fas fa-certificate mr-1 text-amber-400"></i> Akreditasi <?= esc($profile['accreditation'] ?? 'A (Unggul)') ?>
            </span>
        </div>

        <!-- Right: Social Channels & Auth Link -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3 text-slate-400">
                <?php if (!empty($social['facebook'])): ?>
                    <a href="<?= esc($social['facebook']) ?>" target="_blank" rel="noopener" class="hover:text-blue-400 transition" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if (!empty($social['instagram'])): ?>
                    <a href="<?= esc($social['instagram']) ?>" target="_blank" rel="noopener" class="hover:text-pink-400 transition" title="Instagram"><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if (!empty($social['youtube'])): ?>
                    <a href="<?= esc($social['youtube']) ?>" target="_blank" rel="noopener" class="hover:text-red-400 transition" title="YouTube"><i class="fab fa-youtube"></i></a>
                <?php endif; ?>
                <?php if (!empty($social['tiktok'])): ?>
                    <a href="<?= esc($social['tiktok']) ?>" target="_blank" rel="noopener" class="hover:text-white transition" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <?php endif; ?>
            </div>
            
            <span class="text-slate-700">|</span>

            <?php if (session()->get('is_logged_in')): ?>
                <a href="<?= base_url('admin/dashboard') ?>" class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-600/20 text-blue-300 hover:bg-blue-600 hover:text-white transition font-semibold text-[11px] border border-blue-500/30">
                    <i class="fas fa-user-shield mr-1.5"></i> Admin Panel
                </a>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="inline-flex items-center text-slate-300 hover:text-white transition font-medium">
                    <i class="fas fa-lock mr-1.5 text-slate-400 text-[11px]"></i> Login Admin
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 2. Main Sticky Navbar -->
<header x-data="{ mobileOpen: false, profileDropdown: false }" class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Brand Logo & School Identity -->
            <a href="<?= base_url('/') ?>" class="flex items-center space-x-3 group">
                <img src="<?= get_image_url($profile['logo'] ?? null, 'logo') ?>" alt="Logo <?= esc($profile['school_name'] ?? 'Sekolah') ?>" class="h-12 w-auto object-contain transition-transform group-hover:scale-105">
                <div>
                    <span class="block text-lg sm:text-xl font-black tracking-tight text-slate-900 leading-tight group-hover:text-blue-600 transition">
                        <?= esc($profile['school_name'] ?? 'SMP Negeri 3 Abiansemal') ?>
                    </span>
                    <span class="block text-xs font-semibold text-slate-500 truncate max-w-xs sm:max-w-md">
                        <?= esc($profile['slogan'] ?? 'Mendidik dengan Hati, Memimpin dengan Cerdas') ?>
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="<?= base_url('/') ?>" class="px-3.5 py-2 rounded-xl text-sm font-bold transition <?= uri_string() === '' ? 'text-blue-600 bg-blue-50 shadow-sm' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' ?>">
                    Beranda
                </a>

                <!-- Dropdown Profil -->
                <div class="relative" @mouseenter="profileDropdown = true" @mouseleave="profileDropdown = false">
                    <button type="button" class="px-3.5 py-2 rounded-xl text-sm font-bold flex items-center space-x-1.5 transition <?= strpos(uri_string(), 'profil') !== false ? 'text-blue-600 bg-blue-50 shadow-sm' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' ?>">
                        <span>Profil</span>
                        <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="profileDropdown ? 'rotate-180 text-blue-600' : ''"></i>
                    </button>

                    <div x-show="profileDropdown"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute top-full left-0 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 mt-1 z-50 divide-y divide-slate-50">
                        <div class="py-1 space-y-1">
                            <a href="<?= base_url('profil/tentang') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition group">
                                <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-3 group-hover:bg-blue-600 group-hover:text-white transition">
                                    <i class="fas fa-university text-xs"></i>
                                </span>
                                <div>
                                    <p class="leading-tight">Tentang & Visi Misi</p>
                                    <p class="text-[10px] text-slate-400 font-normal mt-0.5">Sejarah dan cita-cita</p>
                                </div>
                            </a>
                            <a href="<?= base_url('profil/fasilitas-sekolah') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition group">
                                <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mr-3 group-hover:bg-indigo-600 group-hover:text-white transition">
                                    <i class="fas fa-building text-xs"></i>
                                </span>
                                <div>
                                    <p class="leading-tight">Fasilitas & Sarana</p>
                                    <p class="text-[10px] text-slate-400 font-normal mt-0.5">Laboratorium & sarana</p>
                                </div>
                            </a>
                            <a href="<?= base_url('profil/prestasi-sekolah') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-amber-50 hover:text-amber-600 transition group">
                                <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mr-3 group-hover:bg-amber-600 group-hover:text-white transition">
                                    <i class="fas fa-trophy text-xs"></i>
                                </span>
                                <div>
                                    <p class="leading-tight">Prestasi Sekolah</p>
                                    <p class="text-[10px] text-slate-400 font-normal mt-0.5">Rekam jejak juara</p>
                                </div>
                            </a>
                            <a href="<?= base_url('profil/tata-tertib') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-cyan-50 hover:text-cyan-600 transition group">
                                <span class="w-8 h-8 rounded-lg bg-cyan-50 text-cyan-600 flex items-center justify-center mr-3 group-hover:bg-cyan-600 group-hover:text-white transition">
                                    <i class="fas fa-clipboard-check text-xs"></i>
                                </span>
                                <div>
                                    <p class="leading-tight">Tata Tertib Murid</p>
                                    <p class="text-[10px] text-slate-400 font-normal mt-0.5">Kode etik kedisiplinan</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="<?= base_url('berita') ?>" class="px-3.5 py-2 rounded-xl text-sm font-bold transition <?= strpos(uri_string(), 'berita') !== false ? 'text-blue-600 bg-blue-50 shadow-sm' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' ?>">
                    Berita & Artikel
                </a>

                <a href="<?= base_url('galeri') ?>" class="px-3.5 py-2 rounded-xl text-sm font-bold transition <?= uri_string() === 'galeri' ? 'text-blue-600 bg-blue-50 shadow-sm' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' ?>">
                    Galeri
                </a>

                <a href="<?= base_url('kontak') ?>" class="px-3.5 py-2 rounded-xl text-sm font-bold transition <?= uri_string() === 'kontak' ? 'text-blue-600 bg-blue-50 shadow-sm' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50' ?>">
                    Kontak
                </a>
            </nav>

            <!-- Actions CTA -->
            <div class="hidden lg:flex items-center space-x-3">
                <a href="<?= base_url('#aplikasi-sekolah') ?>" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-md shadow-blue-600/25 hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition transform">
                    <i class="fas fa-th-large mr-2"></i> Portal Aplikasi
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="flex items-center lg:hidden space-x-2">
                <button @click="mobileOpen = !mobileOpen" type="button" class="p-2.5 rounded-2xl text-slate-700 hover:text-blue-600 hover:bg-slate-100 transition focus:outline-none" aria-label="Toggle navigation">
                    <i class="fas" :class="mobileOpen ? 'fa-times text-xl' : 'fa-bars text-xl'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-white border-b border-slate-200 px-5 pt-3 pb-6 space-y-2 shadow-2xl rounded-b-3xl">
        <a href="<?= base_url('/') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold <?= uri_string() === '' ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' ?>">
            <i class="fas fa-home w-6 text-slate-400"></i> Beranda
        </a>
        <a href="<?= base_url('profil/tentang') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50">
            <i class="fas fa-university w-6 text-slate-400"></i> Profil & Visi Misi
        </a>
        <a href="<?= base_url('profil/fasilitas-sekolah') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50">
            <i class="fas fa-building w-6 text-slate-400"></i> Fasilitas Sekolah
        </a>
        <a href="<?= base_url('profil/prestasi-sekolah') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50">
            <i class="fas fa-trophy w-6 text-slate-400"></i> Prestasi Sekolah
        </a>
        <a href="<?= base_url('berita') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold <?= strpos(uri_string(), 'berita') !== false ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' ?>">
            <i class="fas fa-newspaper w-6 text-slate-400"></i> Berita & Artikel
        </a>
        <a href="<?= base_url('galeri') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold <?= uri_string() === 'galeri' ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' ?>">
            <i class="fas fa-images w-6 text-slate-400"></i> Galeri Dokumentasi
        </a>
        <a href="<?= base_url('kontak') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-bold <?= uri_string() === 'kontak' ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' ?>">
            <i class="fas fa-map-marker-alt w-6 text-slate-400"></i> Kontak & Lokasi
        </a>
        <div class="pt-4 border-t border-slate-100 flex flex-col space-y-2.5">
            <a href="<?= base_url('#aplikasi-sekolah') ?>" @click="mobileOpen = false" class="w-full text-center py-3 rounded-2xl font-bold text-xs bg-blue-600 text-white shadow-md shadow-blue-600/25">
                <i class="fas fa-th-large mr-2"></i> Portal Aplikasi Sekolah
            </a>
            <a href="<?= base_url('login') ?>" class="w-full text-center py-2.5 rounded-2xl font-bold text-xs text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                <i class="fas fa-lock mr-1.5 text-slate-400"></i> Login Administrator
            </a>
        </div>
    </div>
</header>
