<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit Berita</h2>
        <p class="text-xs text-slate-500 mt-1">Perbarui konten artikel, thumbnail, atau kategori berita.</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('berita/' . $news['slug']) ?>" target="_blank" class="inline-flex items-center px-3.5 py-2 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 transition">
            <i class="fas fa-external-link-alt mr-1.5"></i> Lihat di Web
        </a>
        <a href="<?= base_url('admin/berita') ?>" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-200 transition">
            <i class="fas fa-arrow-left mr-1.5"></i> Kembali
        </a>
    </div>
</div>

<form action="<?= base_url('admin/berita/update/' . $news['id']) ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Form Left (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-5">
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Berita <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="<?= old('title', $news['title']) ?>" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Slug URL (Permalink)</label>
                    <input type="text" name="slug" id="slug" value="<?= old('slug', $news['slug']) ?>" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono text-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="excerpt" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ringkasan Berita (Excerpt)</label>
                    <textarea name="excerpt" id="excerpt" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"><?= old('excerpt', $news['excerpt']) ?></textarea>
                </div>

                <div>
                    <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Berita Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="content" id="content" class="summernote"><?= old('content', $news['content']) ?></textarea>
                </div>
            </div>

            <!-- SEO Meta Card -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-search text-blue-500 mr-2"></i> Pengaturan SEO (Search Engine)
                </h3>
                <div class="space-y-4 text-xs">
                    <div>
                        <label for="meta_keywords" class="block font-bold text-slate-700 mb-1">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="<?= old('meta_keywords', $news['meta_keywords']) ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="meta_description" class="block font-bold text-slate-700 mb-1">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"><?= old('meta_description', $news['meta_description']) ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Right Settings (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Publish Settings Card -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-5">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-cog text-blue-500 mr-2"></i> Pengaturan Publikasi
                </h3>

                <div>
                    <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori <span class="text-rose-500">*</span></label>
                    <select name="category_id" id="category_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= old('category_id', $news['category_id']) == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status Publikasi <span class="text-rose-500">*</span></label>
                    <select name="status" id="status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="published" <?= old('status', $news['status']) === 'published' ? 'selected' : '' ?>>Published (Langsung Tayang)</option>
                        <option value="draft" <?= old('status', $news['status']) === 'draft' ? 'selected' : '' ?>>Draft (Simpan Konsep)</option>
                        <option value="archived" <?= old('status', $news['status']) === 'archived' ? 'selected' : '' ?>>Archived (Arsip)</option>
                    </select>
                </div>

                <div>
                    <label for="published_at" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" id="published_at" value="<?= old('published_at', !empty($news['published_at']) ? date('Y-m-d\TH:i', strtotime($news['published_at'])) : date('Y-m-d\TH:i')) ?>" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div class="pt-2 flex items-center space-x-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <input type="checkbox" name="is_highlighted" id="is_highlighted" value="1" <?= old('is_highlighted', $news['is_highlighted']) ? 'checked' : '' ?> class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border-slate-300">
                    <label for="is_highlighted" class="text-xs font-bold text-slate-700 cursor-pointer">
                        <i class="fas fa-star text-amber-400 mr-1"></i> Tampilkan di Sorotan Utama
                    </label>
                </div>
            </div>

            <!-- Featured Image Upload -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <i class="fas fa-image text-blue-500 mr-2"></i> Gambar Utama (Thumbnail)
                </h3>

                <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center relative">
                    <img id="imagePreview" src="<?= get_image_url($news['featured_image'], 'news') ?>" alt="Preview" class="w-full h-full object-cover">
                </div>

                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(this)" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="text-[11px] text-slate-400">Pilih berkas baru jika ingin mengganti gambar sebelumnya.</p>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan Berita
                </button>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?= $this->endSection() ?>
