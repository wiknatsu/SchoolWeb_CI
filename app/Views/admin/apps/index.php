<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Link Aplikasi Sekolah</h2>
        <p class="text-xs text-slate-500 mt-1">Kelola tautan portal layanan digital sekolah (E-Learning, Perpustakaan, CBT, PPDB, dll).</p>
    </div>
    <div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-plus mr-1.5"></i> Tambah Aplikasi Baru
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
                    <th class="pb-3">Nama Aplikasi</th>
                    <th class="pb-3">Kategori</th>
                    <th class="pb-3">URL Tujuan</th>
                    <th class="pb-3">Urutan</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (!empty($apps)): ?>
                    <?php foreach ($apps as $idx => $app): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 font-semibold text-slate-400"><?= $idx + 1 ?></td>
                            <td class="py-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg shadow-sm">
                                    <i class="<?= esc($app['icon'] ?: 'fas fa-laptop-code') ?>"></i>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="font-bold text-slate-900 block"><?= esc($app['name']) ?></span>
                                <span class="text-[11px] text-slate-400 line-clamp-1 max-w-xs"><?= esc($app['description'] ?? '-') ?></span>
                            </td>
                            <td class="py-3">
                                <?= app_category_badge($app['category']) ?>
                            </td>
                            <td class="py-3">
                                <a href="<?= esc($app['url']) ?>" target="_blank" class="text-blue-600 hover:text-blue-800 font-mono text-[11px] flex items-center">
                                    <span class="truncate max-w-[150px]"><?= esc($app['url']) ?></span>
                                    <i class="fas fa-external-link-alt ml-1 text-[9px]"></i>
                                </a>
                            </td>
                            <td class="py-3 font-semibold text-slate-700"><?= $app['display_order'] ?></td>
                            <td class="py-3">
                                <?php if ($app['is_active'] == 1): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Aktif</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <button type="button" onclick="openEditModal(<?= htmlspecialchars(json_encode($app)) ?>)" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('admin/aplikasi/hapus/' . $app['id']) ?>" onclick="return confirmDelete('<?= base_url('admin/aplikasi/hapus/' . $app['id']) ?>', 'aplikasi <?= esc($app['name']) ?>')" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
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

<!-- Modal Create / Edit App -->
<div id="appModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
    <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 id="modalTitle" class="text-base font-bold text-slate-900">Tambah Aplikasi Baru</h3>
            <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times text-lg"></i></button>
        </div>

        <form id="appForm" action="<?= base_url('admin/aplikasi/simpan') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="appId">

            <div>
                <label for="appName" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Aplikasi <span class="text-rose-500">*</span></label>
                <input type="text" name="name" id="appName" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Contoh: E-Learning LMS">
            </div>

            <div>
                <label for="appUrl" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL / Link Aplikasi <span class="text-rose-500">*</span></label>
                <input type="url" name="url" id="appUrl" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="https://elearning.sekolah.sch.id">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="appCategory" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori</label>
                    <select name="category" id="appCategory" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                        <option value="academic">Akademik</option>
                        <option value="library">Perpustakaan</option>
                        <option value="exam">Ujian / CBT</option>
                        <option value="finance">Keuangan</option>
                        <option value="alumni">Alumni</option>
                        <option value="etc">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="appIcon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">FontAwesome Icon</label>
                    <input type="text" name="icon" id="appIcon" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="fas fa-laptop-code">
                </div>
            </div>

            <div>
                <label for="appDescription" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Singkat</label>
                <textarea name="description" id="appDescription" rows="2" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Keterangan singkat fungsi aplikasi ini..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label for="appOrder" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Urutan Tampilan</label>
                    <input type="number" name="display_order" id="appOrder" value="0" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div class="pt-5 flex items-center space-x-2">
                    <input type="checkbox" name="is_active" id="appActive" value="1" checked class="w-4 h-4 text-blue-600 rounded border-slate-300">
                    <label for="appActive" class="text-xs font-semibold text-slate-700">Aktifkan Link</label>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 transition">Simpan Aplikasi</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openCreateModal() {
    $('#modalTitle').text('Tambah Link Aplikasi Baru');
    $('#appForm').attr('action', '<?= base_url('admin/aplikasi/simpan') ?>');
    $('#appId').val('');
    $('#appName').val('');
    $('#appUrl').val('');
    $('#appCategory').val('academic');
    $('#appIcon').val('fas fa-laptop-code');
    $('#appDescription').val('');
    $('#appOrder').val('0');
    $('#appActive').prop('checked', true);
    $('#appModal').removeClass('hidden');
}

function openEditModal(app) {
    $('#modalTitle').text('Edit Aplikasi: ' + app.name);
    $('#appForm').attr('action', '<?= base_url('admin/aplikasi/update/') ?>' + app.id);
    $('#appId').val(app.id);
    $('#appName').val(app.name);
    $('#appUrl').val(app.url);
    $('#appCategory').val(app.category);
    $('#appIcon').val(app.icon);
    $('#appDescription').val(app.description);
    $('#appOrder').val(app.display_order);
    $('#appActive').prop('checked', app.is_active == 1);
    $('#appModal').removeClass('hidden');
}

function closeModal() {
    $('#appModal').addClass('hidden');
}
</script>
<?= $this->endSection() ?>
