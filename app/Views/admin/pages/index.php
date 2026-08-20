<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen Halaman Statis</h2>
        <p class="text-xs text-slate-500 mt-1">Kelola halaman statis seperti Sejarah, Fasilitas, Prestasi, Tata Tertib, dsb.</p>
    </div>
    <div>
        <a href="<?= base_url('admin/halaman/tambah') ?>" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-plus mr-1.5"></i> Tambah Halaman Baru
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
    <div class="overflow-x-auto">
        <table class="datatable w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Judul Halaman</th>
                    <th class="pb-3">Slug URL</th>
                    <th class="pb-3">Template</th>
                    <th class="pb-3">Urutan</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3">Terakhir Diperbarui</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (!empty($pages)): ?>
                    <?php foreach ($pages as $idx => $p): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 font-semibold text-slate-400"><?= $idx + 1 ?></td>
                            <td class="py-3 font-bold text-slate-900">
                                <a href="<?= base_url('profil/' . $p['slug']) ?>" target="_blank" class="hover:text-blue-600 transition">
                                    <?= esc($p['title']) ?>
                                </a>
                            </td>
                            <td class="py-3 font-mono text-slate-500 text-[11px]">/profil/<?= esc($p['slug']) ?></td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold uppercase">
                                    <?= esc($p['template']) ?>
                                </span>
                            </td>
                            <td class="py-3 font-semibold text-slate-700"><?= $p['display_order'] ?></td>
                            <td class="py-3">
                                <?php if ($p['is_active'] == 1): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Aktif</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 text-slate-500 whitespace-nowrap">
                                <?= format_date_indo($p['updated_at'] ?: $p['created_at']) ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="<?= base_url('profil/' . $p['slug']) ?>" target="_blank" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Lihat di Web">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="<?= base_url('admin/halaman/edit/' . $p['id']) ?>" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/halaman/hapus/' . $p['id']) ?>" onclick="return confirmDelete('<?= base_url('admin/halaman/hapus/' . $p['id']) ?>', 'halaman <?= esc($p['title']) ?>')" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
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
