<?php if (!empty($breadcrumbs)): ?>
<nav class="flex text-sm text-slate-500 py-3" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center">
            <a href="<?= base_url('/') ?>" class="inline-flex items-center hover:text-blue-600 font-medium">
                <i class="fas fa-home mr-1.5 text-xs text-slate-400"></i> Beranda
            </a>
        </li>
        <?php foreach ($breadcrumbs as $crumb): ?>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-xs text-slate-400 mx-1"></i>
                    <?php if (!empty($crumb['url'])): ?>
                        <a href="<?= esc($crumb['url']) ?>" class="hover:text-blue-600 font-medium ml-1">
                            <?= esc($crumb['title']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-slate-800 font-semibold ml-1 truncate max-w-xs sm:max-w-md">
                            <?= esc($crumb['title']) ?>
                        </span>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
