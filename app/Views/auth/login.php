<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="w-full max-w-md">
    <!-- Back to Public Link -->
    <div class="mb-6 text-center">
        <a href="<?= base_url('/') ?>" class="inline-flex items-center text-xs font-semibold text-blue-400 hover:text-blue-300 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda Website
        </a>
    </div>

    <!-- Login Card -->
    <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-700/60 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        <!-- Decorative Glow -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Header -->
        <div class="text-center mb-8 relative z-10">
            <?php if (!empty($profile['logo'])): ?>
                <img src="<?= base_url('uploads/profiles/' . $profile['logo']) ?>" alt="Logo" class="h-16 w-auto mx-auto object-contain mb-3 drop-shadow">
            <?php else: ?>
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white mx-auto shadow-lg shadow-blue-500/30 mb-4">
                    <i class="fas fa-school text-3xl"></i>
                </div>
            <?php endif; ?>
            <h1 class="text-2xl font-black text-white tracking-tight">Panel Administrator</h1>
            <p class="text-xs text-slate-400 mt-1"><?= esc($profile['school_name'] ?? 'Portal Sekolah') ?></p>
        </div>

        <!-- Form -->
        <form action="<?= base_url('login') ?>" method="POST" class="space-y-5 relative z-10">
            <?= csrf_field() ?>

            <div>
                <label for="login" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Username atau Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" name="login" id="login" value="<?= old('login') ?>" required
                           class="w-full pl-10 pr-4 py-3 bg-slate-800/80 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="superadmin / email sekolah">
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="password" id="password" required
                           class="w-full pl-10 pr-12 py-3 bg-slate-800/80 border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300">
                        <i class="far fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-500 hover:from-blue-700 hover:to-indigo-600 text-white font-bold text-sm shadow-lg shadow-blue-500/25 transition transform active:scale-95">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Panel
                </button>
            </div>
        </form>

        <!-- Demo Accounts Hint -->
        <div class="mt-8 pt-6 border-t border-slate-800 relative z-10">
            <p class="text-[11px] font-semibold uppercase text-slate-400 text-center tracking-wider mb-3">Akun Demo Default</p>
            <div class="grid grid-cols-3 gap-2 text-center">
                <button type="button" onclick="fillDemo('superadmin', 'admin123')" class="p-2 rounded-lg bg-slate-800/60 hover:bg-slate-800 text-[11px] text-slate-300 border border-slate-700 transition">
                    <span class="block font-bold text-rose-400">Superadmin</span>
                    <span class="text-[10px] text-slate-500">admin123</span>
                </button>
                <button type="button" onclick="fillDemo('admin', 'admin123')" class="p-2 rounded-lg bg-slate-800/60 hover:bg-slate-800 text-[11px] text-slate-300 border border-slate-700 transition">
                    <span class="block font-bold text-indigo-400">Admin</span>
                    <span class="text-[10px] text-slate-500">admin123</span>
                </button>
                <button type="button" onclick="fillDemo('editor', 'admin123')" class="p-2 rounded-lg bg-slate-800/60 hover:bg-slate-800 text-[11px] text-slate-300 border border-slate-700 transition">
                    <span class="block font-bold text-cyan-400">Editor</span>
                    <span class="text-[10px] text-slate-500">admin123</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        pwd.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function fillDemo(username, password) {
    document.getElementById('login').value = username;
    document.getElementById('password').value = password;
}
</script>
<?= $this->endSection() ?>
