<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen Berita & Artikel</h2>
        <p class="text-xs text-slate-500 mt-1">Kelola seluruh publikasi berita, artikel, prestasi, dan pengumuman sekolah.</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('admin/berita/tambah') ?>" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-plus mr-1.5"></i> Tulis Berita Baru
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
    <div class="overflow-x-auto">
        <table class="datatable w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Gambar</th>
                    <th class="pb-3">Judul Berita</th>
                    <th class="pb-3">Kategori</th>
                    <th class="pb-3">Penulis</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3">Sorotan</th>
                    <th class="pb-3">Views</th>
                    <th class="pb-3">Tanggal</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (!empty($newsList)): ?>
                    <?php foreach ($newsList as $idx => $news): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 font-semibold text-slate-400"><?= $idx + 1 ?></td>
                            <td class="py-3">
                                <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0">
                                    <img src="<?= get_image_url($news['featured_image'], 'news') ?>" alt="Thumbnail" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3">
                                <a href="<?= base_url('berita/' . $news['slug']) ?>" target="_blank" class="font-bold text-slate-900 hover:text-blue-600 transition line-clamp-2 max-w-xs">
                                    <?= esc($news['title']) ?>
                                </a>
                                <span class="text-[10px] text-slate-400 font-mono">/berita/<?= esc($news['slug']) ?></span>
                            </td>
                            <td class="py-3 text-slate-600 font-medium">
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold">
                                    <?= esc($news['category_name'] ?? 'Umum') ?>
                                </span>
                            </td>
                            <td class="py-3 text-slate-600 font-medium whitespace-nowrap">
                                <?= esc($news['author_name'] ?? 'Admin') ?>
                            </td>
                            <td class="py-3 whitespace-nowrap">
                                <?php if ($news['status'] === 'published'): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Published</span>
                                <?php elseif ($news['status'] === 'draft'): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Draft</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-800">Archived</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <button type="button" onclick="toggleHighlight(<?= $news['id'] ?>, this)" class="p-1 rounded-lg transition <?= $news['is_highlighted'] == 1 ? 'text-amber-500 hover:text-amber-600' : 'text-slate-300 hover:text-slate-500' ?>" title="Toggle Sorotan">
                                    <i class="fas fa-star text-base"></i>
                                </button>
                            </td>
                            <td class="py-3 text-slate-500 font-medium whitespace-nowrap">
                                <?= number_format($news['view_count']) ?>
                            </td>
                            <td class="py-3 text-slate-500 whitespace-nowrap">
                                <?= format_date_indo($news['published_at'] ?: $news['created_at']) ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="<?= base_url('berita/' . $news['slug']) ?>" target="_blank" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Lihat di Website">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="<?= base_url('admin/berita/edit/' . $news['id']) ?>" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/berita/hapus/' . $news['id']) ?>" onclick="return confirmDelete('<?= base_url('admin/berita/hapus/' . $news['id']) ?>', 'berita ini')" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function toggleHighlight(id, btn) {
    $.post("<?= base_url('admin/berita/highlight/') ?>" + id, {
        "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
    }, function(res) {
        if (res.status === 'success') {
            if (res.is_highlighted == 1) {
                $(btn).removeClass('text-slate-300 hover:text-slate-500').addClass('text-amber-500 hover:text-amber-600');
            } else {
                $(btn).removeClass('text-amber-500 hover:text-amber-600').addClass('text-slate-300 hover:text-slate-500');
            }
        }
    });
}
</script>
<?= $this->endSection() ?>
