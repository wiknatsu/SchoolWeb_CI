<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title><?= esc($title ?? ($profile['school_name'] ?? 'Portal Sekolah')) ?></title>

<!-- Primary Meta Tags -->
<meta name="title" content="<?= esc($title ?? ($profile['school_name'] ?? 'Portal Sekolah')) ?>">
<meta name="description" content="<?= esc($meta['description'] ?? ($profile['meta_description'] ?? ($profile['description'] ?? ''))) ?>">
<meta name="keywords" content="<?= esc($meta['keywords'] ?? ($profile['meta_keywords'] ?? 'sekolah, pendidikan')) ?>">
<meta name="author" content="<?= esc($profile['school_name'] ?? 'Sekolah') ?>">
<meta name="robots" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?= current_url() ?>">
<meta property="og:title" content="<?= esc($title ?? ($profile['school_name'] ?? 'Portal Sekolah')) ?>">
<meta property="og:description" content="<?= esc($meta['description'] ?? ($profile['meta_description'] ?? ($profile['description'] ?? ''))) ?>">
<meta property="og:image" content="<?= esc($meta['image'] ?? get_image_url($profile['logo'] ?? null, 'logo')) ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= current_url() ?>">
<meta property="twitter:title" content="<?= esc($title ?? ($profile['school_name'] ?? 'Portal Sekolah')) ?>">
<meta property="twitter:description" content="<?= esc($meta['description'] ?? ($profile['meta_description'] ?? ($profile['description'] ?? ''))) ?>">
<meta property="twitter:image" content="<?= esc($meta['image'] ?? get_image_url($profile['logo'] ?? null, 'logo')) ?>">

<!-- Favicon -->
<?php if (!empty($profile['favicon'])): ?>
    <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/profiles/' . $profile['favicon']) ?>">
<?php else: ?>
    <link rel="icon" type="image/png" href="https://img.icons8.com/color/48/school.png">
<?php endif; ?>
