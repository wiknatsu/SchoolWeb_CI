<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen Pengguna & Hak Akses</h2>
        <p class="text-xs text-slate-500 mt-1">Kelola akun administrator, redaksi, dan peran pengguna sistem (Superadmin Only).</p>
    </div>
    <div>
        <a href="<?= base_url('admin/pengguna/tambah') ?>" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-user-plus mr-1.5"></i> Tambah Pengguna Baru
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
    <div class="overflow-x-auto">
        <table class="datatable w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Pengguna</th>
                    <th class="pb-3">Username</th>
                    <th class="pb-3">Email</th>
                    <th class="pb-3">Role / Peran</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3">Dibuat Pada</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $idx => $user): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 font-semibold text-slate-400"><?= $idx + 1 ?></td>
                            <td class="py-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                        <?php if (!empty($user['avatar'])): ?>
                                            <img src="<?= base_url('uploads/users/' . $user['avatar']) ?>" alt="Avatar" class="w-full h-full rounded-full object-cover">
                                        <?php else: ?>
                                            <?= strtoupper(substr($user['full_name'], 0, 1)) ?>
                                        <?php endif; ?>
                                    </div>
                                    <span class="font-bold text-slate-900"><?= esc($user['full_name']) ?></span>
                                </div>
                            </td>
                            <td class="py-3 font-mono text-slate-600"><?= esc($user['username']) ?></td>
                            <td class="py-3 text-slate-600"><?= esc($user['email']) ?></td>
                            <td class="py-3">
                                <?= user_role_badge($user['role']) ?>
                            </td>
                            <td class="py-3">
                                <?php if ($user['is_active'] == 1): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Aktif</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 text-slate-500 whitespace-nowrap">
                                <?= format_date_indo($user['created_at']) ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="<?= base_url('admin/pengguna/edit/' . $user['id']) ?>" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php if ($user['id'] != session('user_id')): ?>
                                        <a href="<?= base_url('admin/pengguna/hapus/' . $user['id']) ?>" onclick="return confirmDelete('<?= base_url('admin/pengguna/hapus/' . $user['id']) ?>', 'pengguna <?= esc($user['full_name']) ?>')" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
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
