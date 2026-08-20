<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit Pengguna</h2>
        <p class="text-xs text-slate-500 mt-1">Perbarui data nama, email, hak akses, atau kata sandi pengguna.</p>
    </div>
    <a href="<?= base_url('admin/pengguna') ?>" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-200 transition">
        <i class="fas fa-arrow-left mr-1.5"></i> Kembali
    </a>
</div>

<div class="max-w-2xl bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100">
    <form action="<?= base_url('admin/pengguna/update/' . $user['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
        <?= csrf_field() ?>

        <div>
            <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
            <input type="text" name="full_name" id="full_name" value="<?= old('full_name', $user['full_name']) ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username <span class="text-rose-500">*</span></label>
                <input type="text" name="username" id="username" value="<?= old('username', $user['username']) ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:ring-2 focus:ring-blue-500 focus:bg-white">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email <span class="text-rose-500">*</span></label>
                <input type="email" name="email" id="email" value="<?= old('email', $user['email']) ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password Baru (Opsional)</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Kosongkan jika tidak diubah">
            </div>

            <div>
                <label for="role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Role / Hak Akses <span class="text-rose-500">*</span></label>
                <select name="role" id="role" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                    <option value="editor" <?= old('role', $user['role']) === 'editor' ? 'selected' : '' ?>>Editor</option>
                    <option value="admin" <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="superadmin" <?= old('role', $user['role']) === 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Avatar</label>
            <?php if (!empty($user['avatar'])): ?>
                <div class="w-12 h-12 rounded-full overflow-hidden mb-2 border border-slate-200">
                    <img src="<?= base_url('uploads/users/' . $user['avatar']) ?>" alt="Avatar" class="w-full h-full object-cover">
                </div>
            <?php endif; ?>
            <input type="file" name="avatar" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
        </div>

        <div class="flex items-center space-x-2 pt-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" <?= old('is_active', $user['is_active']) ? 'checked' : '' ?> class="w-4 h-4 text-blue-600 rounded border-slate-300">
            <label for="is_active" class="text-xs font-bold text-slate-700">Akun Aktif</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md shadow-blue-600/20 transition">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan Pengguna
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
