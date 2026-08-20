<?php
$currentUri = uri_string();
$role = session()->get('user_role');
?>

<aside class="w-64 bg-slate-900 text-slate-300 min-h-screen flex flex-col justify-between border-r border-slate-800 transition-all duration-300 select-none">
    <div>
        <!-- Brand Header -->
        <div class="h-20 px-6 flex items-center border-b border-slate-800 bg-slate-950/50">
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <i class="fas fa-school text-lg"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-white tracking-wide uppercase leading-none">Admin Panel</h2>
                    <p class="text-xs text-amber-400 mt-1 font-medium truncate max-w-[130px]"><?= esc($profile['school_name'] ?? 'School Portal') ?></p>
                </div>
            </a>
        </div>

        <!-- User Profile Quick Bar -->
        <div class="px-5 py-4 border-b border-slate-800/80 bg-slate-900/50 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-blue-700/40 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold">
                <?php if (session()->get('user_avatar')): ?>
                    <img src="<?= base_url('uploads/users/' . session()->get('user_avatar')) ?>" alt="Avatar" class="w-full h-full rounded-full object-cover">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-white truncate"><?= esc(session()->get('full_name') ?? 'Admin') ?></p>
                <div class="mt-0.5">
                    <?= user_role_badge(session()->get('user_role') ?? 'editor') ?>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="px-3 py-4 space-y-1 text-sm font-medium">
            <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Utama</p>
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= $currentUri === 'admin/dashboard' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-chart-pie w-5 mr-3 text-sm <?= $currentUri === 'admin/dashboard' ? 'text-white' : 'text-slate-400' ?>"></i>
                Dashboard
            </a>

            <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mt-6 mb-2">Publikasi & Konten</p>
            <a href="<?= base_url('admin/berita') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/berita') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-newspaper w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/berita') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                Berita & Artikel
            </a>

            <a href="<?= base_url('admin/kategori') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= $currentUri === 'admin/kategori' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-tags w-5 mr-3 text-sm <?= $currentUri === 'admin/kategori' ? 'text-white' : 'text-slate-400' ?>"></i>
                Kategori Berita
            </a>

            <a href="<?= base_url('admin/halaman') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/halaman') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-file-alt w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/halaman') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                Halaman Statis
            </a>

            <a href="<?= base_url('admin/galeri') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/galeri') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-photo-video w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/galeri') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                Galeri & Media
            </a>

            <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mt-6 mb-2">Portal Sekolah</p>
            <a href="<?= base_url('admin/aplikasi') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/aplikasi') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-th-large w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/aplikasi') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                Link Aplikasi
            </a>

            <a href="<?= base_url('admin/profil-sekolah') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/profil-sekolah') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-university w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/profil-sekolah') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                Profil Sekolah
            </a>

            <?php if ($role === 'superadmin'): ?>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mt-6 mb-2">Sistem</p>
                <a href="<?= base_url('admin/pengguna') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/pengguna') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                    <i class="fas fa-users-cog w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/pengguna') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                    Manajemen Pengguna
                </a>
            <?php endif; ?>

            <a href="<?= base_url('admin/pengaturan') ?>" class="flex items-center px-3 py-2.5 rounded-xl transition <?= strpos($currentUri, 'admin/pengaturan') !== false ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>">
                <i class="fas fa-sliders-h w-5 mr-3 text-sm <?= strpos($currentUri, 'admin/pengaturan') !== false ? 'text-white' : 'text-slate-400' ?>"></i>
                Pengaturan Sistem
            </a>
        </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-slate-800 bg-slate-950/40 space-y-2">
        <a href="<?= base_url('/') ?>" target="_blank" class="flex items-center justify-center w-full px-3 py-2 rounded-lg text-xs font-semibold text-slate-300 bg-slate-800 hover:bg-slate-700 hover:text-white transition">
            <i class="fas fa-external-link-alt mr-2 text-[10px]"></i> Lihat Website Publik
        </a>
        <a href="<?= base_url('logout') ?>" onclick="return confirm('Apakah Anda yakin ingin keluar?');" class="flex items-center justify-center w-full px-3 py-2 rounded-lg text-xs font-semibold text-rose-400 bg-rose-950/40 hover:bg-rose-900/60 border border-rose-900/40 transition">
            <i class="fas fa-sign-out-alt mr-2 text-[10px]"></i> Keluar (Logout)
        </a>
    </div>
</aside>
