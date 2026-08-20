<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Tambah Halaman Statis</h2>
        <p class="text-xs text-slate-500 mt-1">Buat halaman informasi baru seperti Fasilitas, Prestasi, dsb.</p>
    </div>
    <a href="<?= base_url('admin/halaman') ?>" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-200 transition">
        <i class="fas fa-arrow-left mr-1.5"></i> Kembali
    </a>
</div>

<form action="<?= base_url('admin/halaman/simpan') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-5">
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Halaman <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="<?= old('title') ?>" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Contoh: Fasilitas & Laboratorium">
                </div>

                <div>
                    <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Konten Halaman Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="content" id="content" class="summernote"><?= old('content') ?></textarea>
                </div>
            </div>

            <!-- SEO Meta -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-search text-blue-500 mr-2"></i> Pengaturan SEO
                </h3>
                <div class="space-y-4 text-xs">
                    <div>
                        <label for="meta_keywords" class="block font-bold text-slate-700 mb-1">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="<?= old('meta_keywords') ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="fasilitas sekolah, laboratorium komputer">
                    </div>
                    <div>
                        <label for="meta_description" class="block font-bold text-slate-700 mb-1">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi meta untuk halaman ini..."><?= old('meta_description') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-5">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-cog text-blue-500 mr-2"></i> Konfigurasi
                </h3>

                <div>
                    <label for="template" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilihan Template Layout</label>
                    <select name="template" id="template" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                        <option value="default" <?= old('template') === 'default' ? 'selected' : '' ?>>Default Template</option>
                        <option value="about" <?= old('template') === 'about' ? 'selected' : '' ?>>About / Profil</option>
                        <option value="facilities" <?= old('template') === 'facilities' ? 'selected' : '' ?>>Facilities / Sarana</option>
                        <option value="achievements" <?= old('template') === 'achievements' ? 'selected' : '' ?>>Achievements / Prestasi</option>
                    </select>
                </div>

                <div>
                    <label for="display_order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Urutan Tampilan (Nomor)</label>
                    <input type="number" name="display_order" id="display_order" value="<?= old('display_order', 0) ?>" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-blue-600 rounded border-slate-300">
                    <label for="is_active" class="text-xs font-bold text-slate-700">Aktifkan Halaman</label>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-image text-blue-500 mr-2"></i> Banner / Gambar Header
                </h3>
                <input type="file" name="image" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            </div>

            <div>
                <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fas fa-save mr-2"></i> Simpan Halaman
                </button>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
