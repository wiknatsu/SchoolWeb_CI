<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Pengaturan Profil Sekolah</h2>
        <p class="text-xs text-slate-500 mt-1">Konfigurasi informasi institusi, logo, sambutan kepala sekolah, visi misi, kontak dan media sosial.</p>
    </div>
    <div>
        <a href="<?= base_url('/') ?>" target="_blank" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition">
            <i class="fas fa-eye mr-1.5"></i> Lihat Website
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100" x-data="{ tab: 'identity' }">
    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 pb-6 border-b border-slate-100 text-xs font-bold">
        <button type="button" @click="tab = 'identity'" :class="tab === 'identity' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl transition flex items-center">
            <i class="fas fa-university mr-2"></i> Identitas Sekolah
        </button>
        <button type="button" @click="tab = 'vision'" :class="tab === 'vision' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl transition flex items-center">
            <i class="fas fa-bullseye mr-2"></i> Visi & Misi
        </button>
        <button type="button" @click="tab = 'principal'" :class="tab === 'principal' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl transition flex items-center">
            <i class="fas fa-user-tie mr-2"></i> Kepala Sekolah
        </button>
        <button type="button" @click="tab = 'contact'" :class="tab === 'contact' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl transition flex items-center">
            <i class="fas fa-map-marker-alt mr-2"></i> Kontak & Peta
        </button>
        <button type="button" @click="tab = 'social'" :class="tab === 'social' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl transition flex items-center">
            <i class="fas fa-share-alt mr-2"></i> Media Sosial
        </button>
        <button type="button" @click="tab = 'seo'" :class="tab === 'seo' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl transition flex items-center">
            <i class="fas fa-search mr-2"></i> SEO Default
        </button>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/profil-sekolah/update') ?>" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
        <?= csrf_field() ?>

        <!-- 1. Tab Identitas Sekolah -->
        <div x-show="tab === 'identity'" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="school_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Sekolah <span class="text-rose-500">*</span></label>
                    <input type="text" name="school_name" id="school_name" value="<?= old('school_name', $profile['school_name'] ?? '') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white">
                </div>

                <div>
                    <label for="slogan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Slogan / Tagline</label>
                    <input type="text" name="slogan" id="slogan" value="<?= old('slogan', $profile['slogan'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white">
                </div>
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Ringkas Sekolah</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 focus:bg-white"><?= old('description', $profile['description'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="established_year" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Berdiri</label>
                    <input type="text" name="established_year" id="established_year" value="<?= old('established_year', $profile['established_year'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs" placeholder="Contoh: 1985">
                </div>

                <div>
                    <label for="accreditation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status Akreditasi</label>
                    <input type="text" name="accreditation" id="accreditation" value="<?= old('accreditation', $profile['accreditation'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs" placeholder="Contoh: A (Unggul)">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                <!-- Logo -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Logo Sekolah</label>
                    <?php if (!empty($profile['logo'])): ?>
                        <div class="h-16 w-32 p-2 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-center">
                            <img src="<?= base_url('uploads/profiles/' . $profile['logo']) ?>" alt="Logo" class="max-h-full max-w-full object-contain">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="logo" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>

                <!-- Favicon -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Favicon Icon (Browser Tab)</label>
                    <?php if (!empty($profile['favicon'])): ?>
                        <div class="h-12 w-12 p-2 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-center">
                            <img src="<?= base_url('uploads/profiles/' . $profile['favicon']) ?>" alt="Favicon" class="max-h-full max-w-full object-contain">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="favicon" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>
            </div>
        </div>

        <!-- 2. Tab Visi & Misi -->
        <div x-show="tab === 'vision'" class="space-y-6" style="display: none;">
            <!-- Section Visi Input -->
            <div class="p-5 rounded-2xl bg-blue-50/50 border border-blue-100 space-y-3">
                <div class="flex items-center space-x-2">
                    <span class="w-2.5 h-5 bg-blue-600 rounded"></span>
                    <label for="vision" class="block text-xs font-bold text-blue-950 uppercase tracking-wider">Visi Sekolah</label>
                </div>
                <textarea name="vision" id="vision" rows="3" class="w-full px-4 py-2.5 bg-white border border-blue-200 rounded-xl text-sm leading-relaxed focus:ring-2 focus:ring-blue-500" placeholder="Masukkan visi resmi satuan pendidikan..."><?= old('vision', $profile['vision'] ?? '') ?></textarea>
                <p class="text-[11px] text-blue-600/80">Cita-cita dan pandangan masa depan yang ingin dicapai sekolah.</p>
            </div>

            <!-- Section Misi Input -->
            <div class="p-5 rounded-2xl bg-indigo-50/50 border border-indigo-100 space-y-3">
                <div class="flex items-center space-x-2">
                    <span class="w-2.5 h-5 bg-indigo-600 rounded"></span>
                    <label for="mission" class="block text-xs font-bold text-indigo-950 uppercase tracking-wider">Misi Satuan Pendidikan</label>
                </div>
                <textarea name="mission" id="mission" rows="6" class="w-full px-4 py-2.5 bg-white border border-indigo-200 rounded-xl text-sm leading-relaxed font-sans focus:ring-2 focus:ring-indigo-500" placeholder="1. Mengembangkan...&#10;2. Melaksanakan..."><?= old('mission', $profile['mission'] ?? '') ?></textarea>
                <p class="text-[11px] text-indigo-600/80">Tuliskan butir-butir misi dengan nomor baris atau baris baru terpisah.</p>
            </div>
        </div>

        <!-- 3. Tab Kepala Sekolah -->
        <div x-show="tab === 'principal'" class="space-y-5" style="display: none;">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="principal_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap & Gelar Kepala Sekolah</label>
                    <input type="text" name="principal_name" id="principal_name" value="<?= old('principal_name', $profile['principal_name'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" placeholder="Drs. H. Nama Kepala, M.Pd.">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Resmi Kepala Sekolah</label>
                    <?php if (!empty($profile['principal_photo'])): ?>
                        <div class="h-20 w-20 rounded-xl overflow-hidden mb-2 border border-slate-200">
                            <img src="<?= get_image_url($profile['principal_photo'], 'principal') ?>" alt="Kepsek" class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="principal_photo" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>
            </div>

            <div>
                <label for="principal_welcome" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teks Sambutan Kepala Sekolah</label>
                <textarea name="principal_welcome" id="principal_welcome" class="summernote"><?= old('principal_welcome', $profile['principal_welcome'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- 4. Tab Kontak & Lokasi -->
        <div x-show="tab === 'contact'" class="space-y-5" style="display: none;">
            <div>
                <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                <textarea name="address" id="address" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs"><?= old('address', $profile['address'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Telepon / WA</label>
                    <input type="text" name="phone" id="phone" value="<?= old('phone', $profile['phone'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" value="<?= old('email', $profile['email'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div>
                    <label for="website" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Website URL</label>
                    <input type="text" name="website" id="website" value="<?= old('website', $profile['website'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>

            <div>
                <label for="map_embed" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Google Maps Embed IFrame</label>
                <textarea name="map_embed" id="map_embed" rows="3" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono"><?= old('map_embed', $profile['map_embed'] ?? '') ?></textarea>
                <p class="text-[11px] text-slate-400 mt-1">Salin kode embed HTML (iframe) dari Google Maps.</p>
            </div>
        </div>

        <!-- 5. Tab Media Sosial -->
        <div x-show="tab === 'social'" class="space-y-4" style="display: none;">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label for="facebook" class="block font-bold text-slate-700 mb-1.5"><i class="fab fa-facebook-f text-blue-600 mr-1.5"></i> Facebook URL</label>
                    <input type="url" name="facebook" id="facebook" value="<?= old('facebook', $socialMedia['facebook'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="https://facebook.com/namasekolah">
                </div>

                <div>
                    <label for="instagram" class="block font-bold text-slate-700 mb-1.5"><i class="fab fa-instagram text-pink-600 mr-1.5"></i> Instagram URL</label>
                    <input type="url" name="instagram" id="instagram" value="<?= old('instagram', $socialMedia['instagram'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="https://instagram.com/namasekolah">
                </div>

                <div>
                    <label for="youtube" class="block font-bold text-slate-700 mb-1.5"><i class="fab fa-youtube text-red-600 mr-1.5"></i> YouTube Channel</label>
                    <input type="url" name="youtube" id="youtube" value="<?= old('youtube', $socialMedia['youtube'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="https://youtube.com/@namasekolah">
                </div>

                <div>
                    <label for="tiktok" class="block font-bold text-slate-700 mb-1.5"><i class="fab fa-tiktok text-slate-900 mr-1.5"></i> TikTok URL</label>
                    <input type="url" name="tiktok" id="tiktok" value="<?= old('tiktok', $socialMedia['tiktok'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="https://tiktok.com/@namasekolah">
                </div>

                <div>
                    <label for="twitter" class="block font-bold text-slate-700 mb-1.5"><i class="fab fa-x-twitter text-slate-900 mr-1.5"></i> Twitter / X</label>
                    <input type="url" name="twitter" id="twitter" value="<?= old('twitter', $socialMedia['twitter'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="https://twitter.com/namasekolah">
                </div>
            </div>
        </div>

        <!-- 6. Tab SEO Default -->
        <div x-show="tab === 'seo'" class="space-y-4 text-xs" style="display: none;">
            <div>
                <label for="meta_keywords" class="block font-bold text-slate-700 mb-1.5">Default Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="<?= old('meta_keywords', $profile['meta_keywords'] ?? '') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="sma unggulan, ppdb sma, sekolah terbaik">
            </div>

            <div>
                <label for="meta_description" class="block font-bold text-slate-700 mb-1.5">Default Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl" placeholder="Deskripsi meta bawaan untuk landing page sekolah..."><?= old('meta_description', $profile['meta_description'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end">
            <button type="submit" class="px-8 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 transition">
                <i class="fas fa-save mr-2"></i> Simpan Seluruh Pengaturan Profil
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
