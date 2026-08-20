<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Kategori Berita</h2>
        <p class="text-xs text-slate-500 mt-1">Kelola kategori topik untuk pengelompokan artikel dan warta sekolah.</p>
    </div>
    <div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-plus mr-1.5"></i> Tambah Kategori Baru
        </button>
    </div>
</div>

<div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
    <div class="overflow-x-auto">
        <table class="datatable w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Ikon</th>
                    <th class="pb-3">Nama Kategori</th>
                    <th class="pb-3">Slug</th>
                    <th class="pb-3">Deskripsi</th>
                    <th class="pb-3">Jumlah Berita</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $idx => $cat): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 font-semibold text-slate-400"><?= $idx + 1 ?></td>
                            <td class="py-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm">
                                    <i class="<?= esc($cat['icon'] ?: 'fas fa-tag') ?>"></i>
                                </div>
                            </td>
                            <td class="py-3 font-bold text-slate-900"><?= esc($cat['name']) ?></td>
                            <td class="py-3 font-mono text-slate-500 text-[11px]"><?= esc($cat['slug']) ?></td>
                            <td class="py-3 text-slate-500 max-w-xs truncate"><?= esc($cat['description'] ?? '-') ?></td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-800 text-[10px] font-bold">
                                    <?= $cat['news_count'] ?? 0 ?> Berita
                                </span>
                            </td>
                            <td class="py-3">
                                <?php if ($cat['is_active'] == 1): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Aktif</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <button type="button" onclick="openEditModal(<?= htmlspecialchars(json_encode($cat)) ?>)" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('admin/kategori/hapus/' . $cat['id']) ?>" onclick="return confirmDelete('<?= base_url('admin/kategori/hapus/' . $cat['id']) ?>', 'kategori <?= esc($cat['name']) ?>')" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
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

<!-- Modal Create / Edit Category -->
<div id="categoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
    <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 id="modalTitle" class="text-base font-bold text-slate-900">Tambah Kategori Baru</h3>
            <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times text-lg"></i></button>
        </div>

        <form id="categoryForm" action="<?= base_url('admin/kategori/simpan') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="categoryId">

            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" name="name" id="categoryName" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Contoh: Prestasi Siswa">
            </div>

            <div>
                <label for="slug" id="slugGroup" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Slug URL (Opsional)</label>
                <input type="text" name="slug" id="categorySlug" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono text-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="prestasi-siswa">
            </div>

            <div>
                <label for="icon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">FontAwesome Icon Class</label>
                <input type="text" name="icon" id="categoryIcon" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="fas fa-trophy">
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Singkat</label>
                <textarea name="description" id="categoryDescription" rows="2" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Penjelasan singkat mengenai kategori ini..."></textarea>
            </div>

            <div class="flex items-center space-x-2 pt-1">
                <input type="checkbox" name="is_active" id="categoryActive" value="1" checked class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                <label for="categoryActive" class="text-xs font-semibold text-slate-700">Aktifkan Kategori</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 transition">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openCreateModal() {
    $('#modalTitle').text('Tambah Kategori Baru');
    $('#categoryForm').attr('action', '<?= base_url('admin/kategori/simpan') ?>');
    $('#categoryId').val('');
    $('#categoryName').val('');
    $('#categorySlug').val('');
    $('#categoryIcon').val('fas fa-tag');
    $('#categoryDescription').val('');
    $('#categoryActive').prop('checked', true);
    $('#categoryModal').removeClass('hidden');
}

function openEditModal(cat) {
    $('#modalTitle').text('Edit Kategori: ' + cat.name);
    $('#categoryForm').attr('action', '<?= base_url('admin/kategori/update/') ?>' + cat.id);
    $('#categoryId').val(cat.id);
    $('#categoryName').val(cat.name);
    $('#categorySlug').val(cat.slug);
    $('#categoryIcon').val(cat.icon);
    $('#categoryDescription').val(cat.description);
    $('#categoryActive').prop('checked', cat.is_active == 1);
    $('#categoryModal').removeClass('hidden');
}

function closeModal() {
    $('#categoryModal').addClass('hidden');
}
</script>
<?= $this->endSection() ?>
