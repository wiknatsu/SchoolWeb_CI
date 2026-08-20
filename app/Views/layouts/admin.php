<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Dashboard') ?> - Panel Administrator</title>

    <!-- Tailwind CSS CDN with Typography & Forms -->
    <script src="https://cdn.tailwindcss.com?plugins=typography,forms,aspect-ratio"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a5f',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- jQuery (Needed for DataTables & Summernote) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>

    <!-- Summernote Lite CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Summernote Tailwind override */
        .note-editor {
            border-radius: 1rem !important;
            border-color: #e2e8f0 !important;
            background: white !important;
            overflow: hidden;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .note-toolbar {
            background-color: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.5rem 0.75rem !important;
        }
        .note-editable {
            background-color: white !important;
            min-height: 260px;
            padding: 1.25rem !important;
            font-size: 0.875rem !important;
            line-height: 1.625 !important;
        }

        /* Modern DataTables UI Styling */
        .dataTables_wrapper {
            font-size: 0.8125rem;
            color: #475569;
        }
        .dataTables_wrapper .dataTables_length {
            display: flex;
            align-items: center;
            font-weight: 500;
            color: #64748b;
        }
        .dataTables_wrapper .dataTables_length select {
            padding: 0.4rem 2rem 0.4rem 0.85rem !important;
            margin: 0 0.5rem !important;
            font-size: 0.8125rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #3b82f6 !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
        }

        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .dataTables_wrapper .dataTables_filter label {
            display: inline-flex;
            align-items: center;
            margin: 0;
            font-weight: 500;
            color: #64748b;
        }
        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5rem !important;
            padding: 0.45rem 1rem !important;
            font-size: 0.8125rem !important;
            color: #0f172a !important;
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            outline: none !important;
            min-width: 220px;
            transition: all 0.2s ease;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #2563eb !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
            min-width: 260px;
        }

        /* Table Structure & Headers */
        table.dataTable {
            width: 100% !important;
            margin: 1rem 0 !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }
        table.dataTable thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.06em !important;
            padding: 0.85rem 1rem !important;
            border-top: 1px solid #f1f5f9 !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td {
            padding: 0.85rem 1rem !important;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        table.dataTable tbody tr:hover td {
            background-color: #f8fafc;
        }

        /* Footer & Pagination Styling */
        .dataTables_wrapper .dataTables_info {
            font-size: 0.8125rem;
            color: #64748b;
            font-weight: 500;
            padding: 0.5rem 0;
        }
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.5rem 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            min-width: 2.125rem;
            height: 2.125rem;
            padding: 0 0.75rem !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            color: #475569 !important;
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.625rem !important;
            cursor: pointer !important;
            transition: all 0.15s ease !important;
            text-decoration: none !important;
            user-select: none;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #1d4ed8 !important;
            background: #eff6ff !important;
            border-color: #bfdbfe !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #ffffff !important;
            background: #2563eb !important;
            border-color: #2563eb !important;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: #94a3b8 !important;
            background: #f8fafc !important;
            border-color: #f1f5f9 !important;
            cursor: not-allowed !important;
            opacity: 0.6;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased flex min-h-screen">

    <!-- Sidebar Partial -->
    <?= $this->include('partials/sidebar') ?>

    <!-- Main Content Container -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Topbar / Admin Header -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between shadow-sm z-10">
            <div class="flex items-center space-x-4">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">Panel Admin</span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="text-xs text-slate-500 font-medium"><?= esc($profile['school_name'] ?? 'SMP Negeri 3 Abiansemal') ?></span>
                    </div>
                    <h1 class="text-lg sm:text-xl font-black text-slate-900 leading-tight mt-0.5"><?= esc($title ?? 'Dashboard') ?></h1>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Clock Badge -->
                <div class="hidden md:flex items-center space-x-2 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-600">
                    <i class="far fa-calendar-alt text-blue-600"></i>
                    <span><?= format_date_indo(date('Y-m-d')) ?></span>
                    <span class="text-slate-300">|</span>
                    <i class="far fa-clock text-blue-600"></i>
                    <span id="realtimeClock" class="font-bold text-slate-800"><?= date('H:i') ?> WITA</span>
                </div>

                <a href="<?= base_url('/') ?>" target="_blank" class="hidden sm:inline-flex items-center px-3.5 py-2 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition shadow-sm">
                    <i class="fas fa-external-link-alt mr-1.5 text-[11px]"></i> Lihat Website
                </a>

                <div class="h-6 w-px bg-slate-200"></div>

                <!-- User dropdown pill -->
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-900 leading-tight"><?= esc(session()->get('full_name') ?? 'Administrator') ?></p>
                        <p class="text-[10px] text-blue-600 font-bold uppercase mt-0.5 tracking-wider"><?= esc(session()->get('user_role') ?? 'editor') ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-blue-500/20">
                        <?= strtoupper(substr(session()->get('full_name') ?? 'A', 0, 1)) ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-8">
            <!-- Flash Message Alerts -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-sm font-bold shadow-sm">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="text-xs sm:text-sm font-bold text-emerald-900"><?= esc(session()->getFlashdata('success')) ?></p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1"><i class="fas fa-times"></i></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 bg-rose-50 border border-rose-200 p-4 rounded-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center text-sm font-bold shadow-sm">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <p class="text-xs sm:text-sm font-bold text-rose-900"><?= esc(session()->getFlashdata('error')) ?></p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1"><i class="fas fa-times"></i></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="mb-6 bg-rose-50 border border-rose-200 p-4 rounded-2xl shadow-sm">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center text-sm font-bold shadow-sm mt-0.5">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm font-bold text-rose-900">Terdapat beberapa kesalahan pengisian form:</p>
                            <ul class="list-disc list-inside text-xs text-rose-700 mt-1 space-y-0.5">
                                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Global Admin Scripts -->
    <script>
        // Init professional modern DataTable configuration
        $(document).ready(function() {
            $('.datatable').DataTable({
                responsive: true,
                dom: '<"flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100"lf>rt<"flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 border-t border-slate-100"ip>',
                language: {
                    search: "Cari Data:",
                    searchPlaceholder: "Ketik kata kunci...",
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    zeroRecords: "Tidak ada data yang cocok ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        previous: '<i class="fas fa-chevron-left mr-1"></i> Prev',
                        next: 'Next <i class="fas fa-chevron-right ml-1"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>'
                    }
                }
            });

            // Init Summernote
            $('.summernote').summernote({
                placeholder: 'Tuliskan isi artikel / konten secara lengkap...',
                tabsize: 2,
                height: 320,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i], this);
                        }
                    }
                }
            });

            // Update realtime clock
            setInterval(function() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                $('#realtimeClock').text(hours + ':' + minutes + ' WITA');
            }, 1000);
        });

        // AJAX Image Uploader for Summernote
        function uploadSummernoteImage(file, editor) {
            let data = new FormData();
            data.append("file", file);
            data.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");

            $.ajax({
                url: "<?= base_url('admin/berita/upload-editor') ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(response) {
                    $(editor).summernote('insertImage', response.url);
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengunggah Gambar',
                        text: 'Pastikan format gambar valid (JPG, PNG, WebP) dan ukuran maksimal 3MB.'
                    });
                }
            });
        }

        // Generic Delete Confirmation with SweetAlert2
        function confirmDelete(url, itemName = 'data ini') {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus ${itemName}? Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus Sekarang!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl p-6 font-sans'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
            return false;
        }
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
