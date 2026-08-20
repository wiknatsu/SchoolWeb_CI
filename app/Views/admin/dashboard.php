<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Overview Header Greeting -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Halo, <?= esc(session()->get('full_name') ?? 'Administrator') ?>! 👋</h2>
        <p class="text-xs text-slate-500 mt-1">Berikut ringkasan statistik dan aktivitas terbaru pada portal web sekolah.</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="<?= base_url('admin/berita/tambah') ?>" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-plus mr-1.5"></i> Tulis Berita Baru
        </a>
    </div>
</div>

<!-- 1. Stats Counter Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Total Berita -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Berita</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1"><?= number_format($stats['total_news']) ?></h3>
            <p class="text-[11px] text-blue-600 font-semibold mt-1"><i class="fas fa-check-circle mr-1"></i> Terpublikasi</p>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
            <i class="fas fa-newspaper"></i>
        </div>
    </div>

    <!-- Card 2: Total Pembaca / Views -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Pembaca</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1"><?= number_format($stats['total_views']) ?></h3>
            <p class="text-[11px] text-blue-600 font-semibold mt-1"><i class="fas fa-eye mr-1"></i> Seluruh Berita</p>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
            <i class="fas fa-chart-line"></i>
        </div>
    </div>

    <!-- Card 3: Pengunjung Hari Ini -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Visitor Hari Ini</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1"><?= number_format($stats['today_visitors']) ?></h3>
            <p class="text-[11px] text-purple-600 font-semibold mt-1"><i class="fas fa-users mr-1"></i> Bulan ini: <?= number_format($stats['month_visitors']) ?></p>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl">
            <i class="fas fa-user-friends"></i>
        </div>
    </div>

    <!-- Card 4: Aplikasi & Galeri -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Aplikasi & Galeri</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1"><?= $stats['total_apps'] + $stats['total_galleries'] ?></h3>
            <p class="text-[11px] text-amber-600 font-semibold mt-1"><i class="fas fa-th mr-1"></i> <?= $stats['total_apps'] ?> Apps &bull; <?= $stats['total_galleries'] ?> Galeri</p>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
            <i class="fas fa-layer-group"></i>
        </div>
    </div>
</div>

<!-- 2. Chart Section & Quick Shortcuts -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
    <!-- Traffic Chart (8 cols) -->
    <div class="lg:col-span-8 bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900">Grafik Kunjungan 7 Hari Terakhir</h3>
                <p class="text-xs text-slate-400">Statistik pengunjung unik harian ke website</p>
            </div>
            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Realtime Log</span>
        </div>
        <div class="h-72 w-full pt-4">
            <canvas id="visitorTrafficChart"></canvas>
        </div>
    </div>

    <!-- Quick Shortcuts & School Info (4 cols) -->
    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
            <h3 class="text-base font-bold text-slate-900">Aksi Cepat</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="<?= base_url('admin/berita/tambah') ?>" class="p-3.5 rounded-2xl bg-blue-50 hover:bg-blue-100 text-blue-800 transition text-center flex flex-col items-center">
                    <i class="fas fa-pen-nib text-lg mb-1 text-blue-600"></i>
                    <span class="text-xs font-bold">Tulis Berita</span>
                </a>
                <a href="<?= base_url('admin/galeri') ?>" class="p-3.5 rounded-2xl bg-teal-50 hover:bg-indigo-100 text-teal-800 transition text-center flex flex-col items-center">
                    <i class="fas fa-camera text-lg mb-1 text-indigo-600"></i>
                    <span class="text-xs font-bold">Upload Galeri</span>
                </a>
                <a href="<?= base_url('admin/profil-sekolah') ?>" class="p-3.5 rounded-2xl bg-blue-50 hover:bg-blue-100 text-blue-800 transition text-center flex flex-col items-center">
                    <i class="fas fa-university text-lg mb-1 text-blue-600"></i>
                    <span class="text-xs font-bold">Profil Sekolah</span>
                </a>
                <a href="<?= base_url('admin/pengaturan/clear-cache') ?>" class="p-3.5 rounded-2xl bg-rose-50 hover:bg-rose-100 text-rose-800 transition text-center flex flex-col items-center">
                    <i class="fas fa-broom text-lg mb-1 text-rose-600"></i>
                    <span class="text-xs font-bold">Bersihkan Cache</span>
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-900 to-blue-950 rounded-3xl p-6 text-white shadow-sm space-y-3">
            <div class="flex items-center space-x-2">
                <i class="fas fa-shield-alt text-blue-400"></i>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Status Sistem</span>
            </div>
            <p class="text-xs text-slate-300 leading-relaxed">CodeIgniter <?= \CodeIgniter\CodeIgniter::CI_VERSION ?> &bull; PHP <?= phpversion() ?></p>
            <p class="text-[11px] text-slate-400">Database MySQL terhubung aman dengan proteksi CSRF dan XSS Filtering.</p>
        </div>
    </div>
</div>

<!-- 3. Tables: Recent News & Recent Visitors -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Recent News Table (7 cols) -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-900">Berita Terbaru Ditambahkan</h3>
            <a href="<?= base_url('admin/berita') ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700">Lihat Semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                        <th class="pb-3 font-bold">Judul Berita</th>
                        <th class="pb-3 font-bold">Kategori</th>
                        <th class="pb-3 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if (!empty($recentNews)): ?>
                        <?php foreach ($recentNews as $rNews): ?>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3">
                                    <a href="<?= base_url('berita/' . $rNews['slug']) ?>" target="_blank" class="font-bold text-slate-800 hover:text-blue-600 line-clamp-1">
                                        <?= esc($rNews['title']) ?>
                                    </a>
                                    <span class="text-[10px] text-slate-400"><?= format_date_indo($rNews['created_at']) ?></span>
                                </td>
                                <td class="py-3 text-slate-600 font-medium">
                                    <?= esc($rNews['category_name'] ?? 'Umum') ?>
                                </td>
                                <td class="py-3 text-right">
                                    <a href="<?= base_url('admin/berita/edit/' . $rNews['id']) ?>" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Visitors (5 cols) -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-900">Aktivitas Pengunjung</h3>
            <span class="text-xs text-slate-400">Total: <?= number_format($stats['total_visitors']) ?></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                        <th class="pb-3 font-bold">IP & Halaman</th>
                        <th class="pb-3 font-bold text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if (!empty($recentVisitors)): ?>
                        <?php foreach ($recentVisitors as $rVis): ?>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3">
                                    <span class="font-bold text-slate-800 block truncate max-w-[160px]"><?= esc($rVis['page_visited']) ?></span>
                                    <span class="text-[10px] text-slate-400"><?= esc($rVis['ip_address']) ?></span>
                                </td>
                                <td class="py-3 text-right text-slate-500 font-medium whitespace-nowrap">
                                    <?= time_ago_indo($rVis['visited_at']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('visitorTrafficChart').getContext('2d');
    const chartLabels = <?= json_encode($weeklyTraffic['labels']) ?>;
    const chartData = <?= json_encode($weeklyTraffic['data']) ?>;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Kunjungan Pengunjung',
                data: chartData,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                tension: 0.35,
                fill: true,
                pointBackgroundColor: '#2563eb',
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9',
                    },
                    ticks: {
                        font: { size: 11 },
                        color: '#94a3b8',
                    }
                },
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        font: { size: 11 },
                        color: '#94a3b8',
                    }
                }
            }
        }
    });
});
</script>
<?= $this->endSection() ?>
