<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit Halaman Statis</h2>
        <p class="text-xs text-slate-500 mt-1">Perbarui judul, tata letak, atau isi dari halaman statis.</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('profil/' . $page['slug']) ?>" target="_blank" class="inline-flex items-center px-3.5 py-2 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 transition">
            <i class="fas fa-external-link-alt mr-1.5"></i> Lihat di Web
        </a>
        <a href="<?= base_url('admin/halaman') ?>" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-200 transition">
            <i class="fas fa-arrow-left mr-1.5"></i> Kembali
        </a>
    </div>
</div>

<form action="<?= base_url('admin/halaman/update/' . $page['id']) ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-5">
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Halaman <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="<?= old('title', $page['title']) ?>" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Slug URL (Permalink)</label>
                    <input type="text" name="slug" id="slug" value="<?= old('slug', $page['slug']) ?>" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono text-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Konten Halaman Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="content" id="content" class="summernote"><?= old('content', $page['content']) ?></textarea>
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
                        <input type="text" name="meta_keywords" id="meta_keywords" value="<?= old('meta_keywords', $page['meta_keywords']) ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="meta_description" class="block font-bold text-slate-700 mb-1">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('meta_description', $page['meta_description']) ?></textarea>
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
                        <option value="default" <?= old('template', $page['template']) === 'default' ? 'selected' : '' ?>>Default Template</option>
                        <option value="about" <?= old('template', $page['template']) === 'about' ? 'selected' : '' ?>>About / Profil</option>
                        <option value="facilities" <?= old('template', $page['template']) === 'facilities' ? 'selected' : '' ?>>Facilities / Sarana</option>
                        <option value="achievements" <?= old('template', $page['template']) === 'achievements' ? 'selected' : '' ?>>Achievements / Prestasi</option>
                    </select>
                </div>

                <div>
                    <label for="display_order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Urutan Tampilan</label>
                    <input type="number" name="display_order" id="display_order" value="<?= old('display_order', $page['display_order']) ?>" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?= old('is_active', $page['is_active']) ? 'checked' : '' ?> class="w-4 h-4 text-blue-600 rounded border-slate-300">
                    <label for="is_active" class="text-xs font-bold text-slate-700">Aktifkan Halaman</label>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-image text-blue-500 mr-2"></i> Banner / Gambar Header
                </h3>
                <?php if (!empty($page['featured_image'])): ?>
                    <div class="aspect-[16/10] rounded-xl overflow-hidden bg-slate-100 mb-2">
                        <img src="<?= get_image_url($page['featured_image'], 'profiles') ?>" alt="Banner" class="w-full h-full object-cover">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            </div>

            <div>
                <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan Halaman
                </button>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
