<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Tambah Pengguna Baru</h2>
        <p class="text-xs text-slate-500 mt-1">Daftarkan akun administrator atau redaksi baru.</p>
    </div>
    <a href="<?= base_url('admin/pengguna') ?>" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-200 transition">
        <i class="fas fa-arrow-left mr-1.5"></i> Kembali
    </a>
</div>

<div class="max-w-2xl bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100">
    <form action="<?= base_url('admin/pengguna/simpan') ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
        <?= csrf_field() ?>

        <div>
            <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
            <input type="text" name="full_name" id="full_name" value="<?= old('full_name') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Contoh: Budi Santoso, S.Pd.">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username <span class="text-rose-500">*</span></label>
                <input type="text" name="username" id="username" value="<?= old('username') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="budisantoso">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email <span class="text-rose-500">*</span></label>
                <input type="email" name="email" id="email" value="<?= old('email') ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="budi@school.sch.id">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password <span class="text-rose-500">*</span></label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Minimal 6 karakter">
            </div>

            <div>
                <label for="role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Role / Hak Akses <span class="text-rose-500">*</span></label>
                <select name="role" id="role" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                    <option value="editor" <?= old('role') === 'editor' ? 'selected' : '' ?>>Editor (Kelola Berita & Galeri)</option>
                    <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin (Kelola Konten & Profil)</option>
                    <option value="superadmin" <?= old('role') === 'superadmin' ? 'selected' : '' ?>>Superadmin (Akses Penuh Sistem)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Avatar (Opsional)</label>
            <input type="file" name="avatar" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
        </div>

        <div class="flex items-center space-x-2 pt-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-blue-600 rounded border-slate-300">
            <label for="is_active" class="text-xs font-bold text-slate-700">Akun Aktif (Dapat Login)</label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md shadow-blue-600/20 transition">
                <i class="fas fa-user-check mr-2"></i> Daftarkan Pengguna
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
