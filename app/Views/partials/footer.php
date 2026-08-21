<?php
$social = [];
if (!empty($profile['social_media'])) {
    $social = is_string($profile['social_media']) ? json_decode($profile['social_media'], true) : $profile['social_media'];
}
?>

<footer class="bg-slate-950 text-slate-400 pt-16 pb-12 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800/80">
            <!-- Col 1: School Identity -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <?php if (!empty($profile['logo'])): ?>
                        <img src="<?= base_url('uploads/profiles/' . $profile['logo']) ?>" alt="Logo" class="h-12 w-auto object-contain">
                    <?php else: ?>
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                    <?php endif; ?>
                    <div>
                        <span class="block text-base font-black text-white tracking-tight">
                            <?= esc($profile['school_name'] ?? 'SMP Negeri 3 Abiansemal') ?>
                        </span>
                        <span class="block text-[11px] text-amber-400 font-semibold">
                            Terakreditasi <?= esc($profile['accreditation'] ?? 'A (Unggul)') ?>
                        </span>
                    </div>
                </div>
                <p class="text-xs leading-relaxed text-slate-400">
                    <?= esc(excerpt_words($profile['description'] ?? 'Mewujudkan murid CEMPAKA (Cerdas, Empati, Berkarakter) berlandaskan filosofi kearifan lokal Tri Hita Karana.', 25)) ?>
                </p>
                <div class="flex items-center space-x-2 pt-2">
                    <?php if (!empty($social['facebook'])): ?>
                        <a href="<?= esc($social['facebook']) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-blue-600 hover:text-white flex items-center justify-center transition" title="Facebook"><i class="fab fa-facebook-f text-xs"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($social['instagram'])): ?>
                        <a href="<?= esc($social['instagram']) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-gradient-to-tr hover:from-amber-500 hover:to-pink-600 hover:text-white flex items-center justify-center transition" title="Instagram"><i class="fab fa-instagram text-xs"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($social['youtube'])): ?>
                        <a href="<?= esc($social['youtube']) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-red-600 hover:text-white flex items-center justify-center transition" title="YouTube"><i class="fab fa-youtube text-xs"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($social['tiktok'])): ?>
                        <a href="<?= esc($social['tiktok']) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-800 hover:text-white flex items-center justify-center transition" title="TikTok"><i class="fab fa-tiktok text-xs"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-white text-sm font-bold tracking-wider uppercase mb-4 flex items-center">
                    <span class="w-2 h-4 bg-blue-500 rounded-sm mr-2.5"></span> Jelajah Tautan
                </h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="<?= base_url('profil/tentang') ?>" class="hover:text-blue-400 transition flex items-center"><i class="fas fa-chevron-right text-[9px] mr-2 text-slate-600"></i> Profil & Visi Misi</a></li>
                    <li><a href="<?= base_url('profil/fasilitas-sekolah') ?>" class="hover:text-blue-400 transition flex items-center"><i class="fas fa-chevron-right text-[9px] mr-2 text-slate-600"></i> Fasilitas & Sarana</a></li>
                    <li><a href="<?= base_url('profil/prestasi-sekolah') ?>" class="hover:text-blue-400 transition flex items-center"><i class="fas fa-chevron-right text-[9px] mr-2 text-slate-600"></i> Prestasi Siswa & Guru</a></li>
                    <li><a href="<?= base_url('berita') ?>" class="hover:text-blue-400 transition flex items-center"><i class="fas fa-chevron-right text-[9px] mr-2 text-slate-600"></i> Kabar & Berita Terbaru</a></li>
                    <li><a href="<?= base_url('galeri') ?>" class="hover:text-blue-400 transition flex items-center"><i class="fas fa-chevron-right text-[9px] mr-2 text-slate-600"></i> Galeri Dokumentasi</a></li>
                    <li><a href="<?= base_url('#aplikasi-sekolah') ?>" class="hover:text-blue-400 transition flex items-center"><i class="fas fa-chevron-right text-[9px] mr-2 text-slate-600"></i> Portal Aplikasi Sekolah</a></li>
                </ul>
            </div>

            <!-- Col 3: Contact Info -->
            <div>
                <h4 class="text-white text-sm font-bold tracking-wider uppercase mb-4 flex items-center">
                    <span class="w-2 h-4 bg-cyan-500 rounded-sm mr-2.5"></span> Kontak & Layanan
                </h4>
                <ul class="space-y-3 text-xs">
                    <?php if (!empty($profile['address'])): ?>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-cyan-400 mt-0.5 flex-shrink-0"></i>
                            <span class="leading-relaxed"><?= esc($profile['address']) ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile['phone'])): ?>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone-alt text-cyan-400 flex-shrink-0"></i>
                            <span><?= esc($profile['phone']) ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile['email'])): ?>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-cyan-400 flex-shrink-0"></i>
                            <span><?= esc($profile['email']) ?></span>
                        </li>
                    <?php endif; ?>
                    <li class="flex items-center space-x-3 text-amber-300 font-medium">
                        <i class="fas fa-clock text-amber-400 flex-shrink-0"></i>
                        <span>Senin - Jumat: 07.00 - 16.00 WITA</span>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Akreditasi & Lokasi -->
            <div>
                <h4 class="text-white text-sm font-bold tracking-wider uppercase mb-4 flex items-center">
                    <span class="w-2 h-4 bg-amber-500 rounded-sm mr-2.5"></span> Identitas & Peta
                </h4>
                <div class="bg-slate-900/90 p-4 rounded-2xl border border-slate-800 space-y-3 shadow-inner">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400">Status Akreditasi</span>
                        <span class="text-xs font-black text-amber-300 bg-amber-400/10 px-2.5 py-0.5 rounded-full border border-amber-400/20">
                            <?= esc($profile['accreditation'] ?? 'A (Unggul)') ?>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400">Tahun Berdiri</span>
                        <span class="text-xs font-bold text-slate-200"><?= esc($profile['established_year'] ?? '1984') ?></span>
                    </div>
                    <div class="pt-2 border-t border-slate-800/80">
                        <a href="<?= base_url('kontak') ?>" class="flex items-center justify-center w-full py-2.5 rounded-xl bg-blue-600/20 text-blue-300 hover:bg-blue-600 hover:text-white text-xs font-bold transition border border-blue-500/20">
                            <i class="fas fa-map-marked-alt mr-1.5"></i> Buka Petunjuk Arah Peta
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright Bar -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 space-y-4 sm:space-y-0">
            <p>&copy; <?= date('Y') ?> <strong><?= esc($profile['school_name'] ?? 'SMP Negeri 3 Abiansemal') ?></strong>. Hak Cipta Dilindungi Undang-Undang.</p>
            <div class="flex items-center space-x-4">
                <a href="<?= base_url('profil/tata-tertib') ?>" class="hover:text-slate-300 transition">Tata Tertib & Kode Etik</a>
                <span>&bull;</span>
                <a href="<?= base_url('kontak') ?>" class="hover:text-slate-300 transition">Bantuan & Kontak</a>
                <span>&bull;</span>
                <a href="<?= base_url('login') ?>" class="hover:text-slate-300 transition">Login Administrator</a>
            </div>
        </div>
    </div>
</footer>
