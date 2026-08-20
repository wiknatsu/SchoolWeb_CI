<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Galeri & Media Dokumentasi</h2>
        <p class="text-xs text-slate-500 mt-1">Unggah foto kegiatan atau tautkan video dokumentasi sekolah.</p>
    </div>
    <div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-md shadow-blue-600/20 transition">
            <i class="fas fa-upload mr-1.5"></i> Tambah Media Galeri
        </button>
    </div>
</div>

<div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
    <div class="overflow-x-auto">
        <table class="datatable w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Preview</th>
                    <th class="pb-3">Judul Media</th>
                    <th class="pb-3">Tipe</th>
                    <th class="pb-3">Kategori</th>
                    <th class="pb-3">Tampil di Beranda</th>
                    <th class="pb-3">Tanggal Unggah</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (!empty($galleries)): ?>
                    <?php foreach ($galleries as $idx => $gal): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 font-semibold text-slate-400"><?= $idx + 1 ?></td>
                            <td class="py-3">
                                <div class="w-16 h-12 rounded-xl overflow-hidden bg-slate-100 relative group flex-shrink-0">
                                    <img src="<?= $gal['type'] === 'video' ? 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=300&q=80' : esc($gal['file_url']) ?>" alt="Preview" class="w-full h-full object-cover">
                                    <a href="<?= esc($gal['file_url']) ?>" target="_blank" class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white">
                                        <i class="fas <?= $gal['type'] === 'video' ? 'fa-play' : 'fa-search' ?> text-xs"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="font-bold text-slate-900 block"><?= esc($gal['title']) ?></span>
                                <span class="text-[11px] text-slate-400 line-clamp-1 max-w-xs"><?= esc($gal['description'] ?? '-') ?></span>
                            </td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase <?= $gal['type'] === 'video' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' ?>">
                                    <?= esc($gal['type']) ?>
                                </span>
                            </td>
                            <td class="py-3 font-semibold text-slate-700"><?= esc($gal['category']) ?></td>
                            <td class="py-3">
                                <?php if ($gal['is_featured'] == 1): ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800"><i class="fas fa-star mr-1"></i> Ya</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Tidak</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 text-slate-500 whitespace-nowrap">
                                <?= format_date_indo($gal['created_at']) ?>
                            </td>
                            <td class="py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <button type="button" onclick="openEditModal(<?= htmlspecialchars(json_encode($gal)) ?>)" class="p-1.5 rounded-lg text-indigo-600 hover:bg-indigo-50 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('admin/galeri/hapus/' . $gal['id']) ?>" onclick="return confirmDelete('<?= base_url('admin/galeri/hapus/' . $gal['id']) ?>', 'media <?= esc($gal['title']) ?>')" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
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

<!-- Modal Create / Edit Gallery -->
<div id="galleryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden" x-data="{ mediaType: 'image' }">
    <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 id="modalTitle" class="text-base font-bold text-slate-900">Tambah Media Galeri</h3>
            <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times text-lg"></i></button>
        </div>

        <form id="galleryForm" action="<?= base_url('admin/galeri/simpan') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="galleryId">

            <div>
                <label for="galleryTitle" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Media / Foto <span class="text-rose-500">*</span></label>
                <input type="text" name="title" id="galleryTitle" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" placeholder="Contoh: Upacara Bendera HUT RI">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="galleryType" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tipe Media</label>
                    <select name="type" id="galleryType" x-model="mediaType" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                        <option value="image">Foto / Gambar</option>
                        <option value="video">Video (YouTube / Embed)</option>
                    </select>
                </div>

                <div>
                    <label for="galleryCategory" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori Album</label>
                    <input type="text" name="category" id="galleryCategory" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kegiatan / Akademik / Prestasi">
                </div>
            </div>

            <!-- Image Upload Mode -->
            <div x-show="mediaType === 'image'" class="space-y-3">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Berkas Gambar</label>
                <input type="file" name="file" id="galleryFile" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                <p class="text-[11px] text-slate-400">Atau masukkan URL Gambar Eksternal di bawah ini (opsional):</p>
                <input type="url" name="file_url" id="galleryImageUrl" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono" placeholder="https://domain.com/foto.jpg">
            </div>

            <!-- Video Embed Mode -->
            <div x-show="mediaType === 'video'" class="space-y-3" style="display: none;">
                <label for="galleryVideoUrl" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">URL Video YouTube / Embed <span class="text-rose-500">*</span></label>
                <input type="url" name="file_url" id="galleryVideoUrl" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono" placeholder="https://www.youtube.com/embed/VIDEO_ID">
            </div>

            <div>
                <label for="galleryDescription" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Keterangan / Caption</label>
                <textarea name="description" id="galleryDescription" rows="2" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs" placeholder="Keterangan singkat momen dokumentasi..."></textarea>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_featured" id="galleryFeatured" value="1" checked class="w-4 h-4 text-blue-600 rounded border-slate-300">
                <label for="galleryFeatured" class="text-xs font-bold text-slate-700">Tampilkan di Beranda Website (Featured)</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 transition">Simpan Media</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openCreateModal() {
    $('#modalTitle').text('Tambah Media Galeri');
    $('#galleryForm').attr('action', '<?= base_url('admin/galeri/simpan') ?>');
    $('#galleryId').val('');
    $('#galleryTitle').val('');
    $('#galleryType').val('image').trigger('change');
    $('#galleryCategory').val('Kegiatan');
    $('#galleryImageUrl').val('');
    $('#galleryVideoUrl').val('');
    $('#galleryDescription').val('');
    $('#galleryFeatured').prop('checked', true);
    $('#galleryModal').removeClass('hidden');
}

function openEditModal(gal) {
    $('#modalTitle').text('Edit Media: ' + gal.title);
    $('#galleryForm').attr('action', '<?= base_url('admin/galeri/update/') ?>' + gal.id);
    $('#galleryId').val(gal.id);
    $('#galleryTitle').val(gal.title);
    $('#galleryType').val(gal.type).trigger('change');
    $('#galleryCategory').val(gal.category);
    if (gal.type === 'video') {
        $('#galleryVideoUrl').val(gal.file_url);
    } else {
        $('#galleryImageUrl').val(gal.file_url);
    }
    $('#galleryDescription').val(gal.description);
    $('#galleryFeatured').prop('checked', gal.is_featured == 1);
    $('#galleryModal').removeClass('hidden');
}

function closeModal() {
    $('#galleryModal').addClass('hidden');
}
</script>
<?= $this->endSection() ?>
