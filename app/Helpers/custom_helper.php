<?php

use App\Models\SchoolProfileModel;

if (!function_exists('format_date_indo')) {
    /**
     * Format datetime to Indonesian date format (e.g. 20 Agustus 2026)
     */
    function format_date_indo($datetime): string
    {
        if (empty($datetime)) {
            return '-';
        }

        $months = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $time = strtotime($datetime);
        $day = date('d', $time);
        $month = (int) date('m', $time);
        $year = date('Y', $time);

        return ltrim($day, '0') . ' ' . ($months[$month] ?? '') . ' ' . $year;
    }
}

if (!function_exists('format_datetime_indo')) {
    /**
     * Format datetime to Indonesian full format with time
     */
    function format_datetime_indo($datetime): string
    {
        if (empty($datetime)) {
            return '-';
        }

        $date = format_date_indo($datetime);
        $time = date('H:i', strtotime($datetime));

        return "{$date}, {$time} WIB";
    }
}

if (!function_exists('time_ago_indo')) {
    /**
     * Relative time in Indonesian
     */
    function time_ago_indo($datetime): string
    {
        if (empty($datetime)) {
            return '-';
        }

        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            $mins = floor($diff / 60);
            return "{$mins} menit lalu";
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return "{$hours} jam lalu";
        } elseif ($diff < 2592000) {
            $days = floor($diff / 86400);
            return "{$days} hari lalu";
        } else {
            return format_date_indo($datetime);
        }
    }
}

if (!function_exists('reading_time')) {
    /**
     * Estimate reading time
     */
    function reading_time(string $content): string
    {
        $words = str_word_count(strip_tags($content));
        $minutes = ceil($words / 200);
        return "{$minutes} mnt baca";
    }
}

if (!function_exists('excerpt_words')) {
    /**
     * Excerpt text safely
     */
    function excerpt_words(?string $text, int $limit = 25, string $end = '...'): string
    {
        if (empty($text)) {
            return '';
        }

        $cleanText = strip_tags($text);
        $words = preg_split('/\s+/', $cleanText);

        if (count($words) <= $limit) {
            return $cleanText;
        }

        return implode(' ', array_slice($words, 0, $limit)) . $end;
    }
}

if (!function_exists('get_school_profile')) {
    /**
     * Get cached school profile
     */
    function get_school_profile(): array
    {
        $cache = \Config\Services::cache();
        $cacheKey = 'school_profile_active';

        $profile = $cache->get($cacheKey);
        if (!$profile) {
            $model = new SchoolProfileModel();
            $profile = $model->where('is_active', 1)->first();

            if (!$profile) {
                $profile = [
                    'id'                => 1,
                    'school_name'       => 'SMP Negeri 3 Abiansemal',
                    'slogan'            => 'Mendidik dengan Hati, Memimpin dengan Cerdas | Unggul dalam Mutu, Berkarakter dalam Prestasi',
                    'description'       => 'SMP Negeri 3 Abiansemal adalah sekolah menengah pertama negeri di Kabupaten Badung, Bali yang berkomitmen mendidik murid berkarakter CEMPAKA berlandaskan Tri Hita Karana.',
                    'logo'              => null,
                    'favicon'           => null,
                    'address'           => 'Br. Sintrig, Sibangkaja, Kec. Abiansemal, Kabupaten Badung, Bali 80352',
                    'phone'             => '(0361) 469338',
                    'email'             => 'smpn3abs@yahoo.co.id',
                    'website'           => base_url(),
                    'social_media'      => '{}',
                    'vision'            => 'Terwujudnya murid yang "CEMPAKA" (Cerdas, EMPAti, berKArakter) berlandaskan Tri Hita Karana.',
                    'mission'           => 'Mengembangkan kecerdasan holistik dan karakter luhur murid berlandaskan Tri Hita Karana.',
                    'principal_name'    => 'I Nyoman Budiasa, S.Pd., M.M.',
                    'principal_photo'   => null,
                    'principal_welcome' => 'Selamat datang di website resmi SMP Negeri 3 Abiansemal.',
                    'established_year'  => '1984',
                    'accreditation'     => 'A (Unggul)',
                    'map_embed'         => '',
                    'meta_keywords'     => 'SMP Negeri 3 Abiansemal, SMP Badung, SMP Bali, Sekolah Penggerak',
                    'meta_description'  => 'Website resmi SMP Negeri 3 Abiansemal Badung Bali',
                ];
            }

            // Cache for 1 hour
            $cache->save($cacheKey, $profile, 3600);
        }

        return $profile;
    }
}

if (!function_exists('get_image_url')) {
    /**
     * Safe image URL helper with fallback
     */
    function get_image_url(?string $filename, string $type = 'news'): string
    {
        if (!empty($filename)) {
            // Check if it's already an absolute external URL (e.g. from Unsplash or CDN)
            if (filter_var($filename, FILTER_VALIDATE_URL)) {
                return $filename;
            }

            $localPath = FCPATH . 'uploads/' . $type . '/' . $filename;
            if (file_exists($localPath)) {
                return base_url('uploads/' . $type . '/' . $filename);
            }
        }

        // Use the supplied school identity assets when no uploaded image exists.
        switch ($type) {
            case 'profiles':
            case 'logo':
                return base_url('assets/images/Logo Sekolah.png');
            case 'principal':
            case 'users':
                return base_url('assets/images/kepsek.jpeg');
            case 'gallery':
                return 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80';
            case 'news':
            default:
                return 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1000&q=80';
        }
    }
}

if (!function_exists('app_category_badge')) {
    /**
     * Category badge for School Apps
     */
    function app_category_badge(string $category): string
    {
        switch ($category) {
            case 'academic':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><i class="fas fa-graduation-cap mr-1"></i> Akademik</span>';
            case 'library':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><i class="fas fa-book mr-1"></i> Perpustakaan</span>';
            case 'exam':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800"><i class="fas fa-edit mr-1"></i> Ujian / CBT</span>';
            case 'finance':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800"><i class="fas fa-wallet mr-1"></i> Keuangan</span>';
            case 'alumni':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800"><i class="fas fa-users mr-1"></i> Alumni</span>';
            default:
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800"><i class="fas fa-link mr-1"></i> Lainnya</span>';
        }
    }
}

if (!function_exists('user_role_badge')) {
    /**
     * User role badge helper
     */
    function user_role_badge(string $role): string
    {
        switch ($role) {
            case 'superadmin':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800"><i class="fas fa-shield-alt mr-1"></i> Super Admin</span>';
            case 'admin':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800"><i class="fas fa-user-shield mr-1"></i> Admin</span>';
            case 'editor':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800"><i class="fas fa-pen-nib mr-1"></i> Editor</span>';
            default:
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">' . esc($role) . '</span>';
        }
    }
}
