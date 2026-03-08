<?php
/**
 * Language Switcher Component
 * Include this in the navbar to allow users to switch languages
 */
$current = current_lang();
$current_page = basename($_SERVER['PHP_SELF']);
$query_string = $_SERVER['QUERY_STRING'] ?? '';

// Remove existing lang parameter
$query_string = preg_replace('/(&?lang=[a-z]{2})/', '', $query_string);
$query_string = ltrim($query_string, '&');
$separator = $query_string ? '&' : '';

$langs = [
    'vi' => ['label' => 'VI', 'flag' => '🇻🇳', 'name' => 'Tiếng Việt'],
    'en' => ['label' => 'EN', 'flag' => '🇬🇧', 'name' => 'English'],
];
?>
<div class="dropdown lang-switcher ms-2">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle shadow-none d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span><?php echo $langs[$current]['flag'] ?></span>
        <span class="d-none d-md-inline"><?php echo $langs[$current]['label'] ?></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="min-width:140px;">
        <?php foreach ($langs as $code => $info): ?>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 <?php echo $code === $current ? 'active' : '' ?>"
               href="<?php echo $current_page . '?' . $query_string . $separator . 'lang=' . $code ?>">
                <span><?php echo $info['flag'] ?></span>
                <span><?php echo $info['name'] ?></span>
                <?php if ($code === $current): ?>
                    <i class="bi bi-check-lg ms-auto"></i>
                <?php endif; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<style>
.lang-switcher .btn {
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 13px;
    font-weight: 600;
}
.lang-switcher .dropdown-menu {
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    padding: 6px;
}
.lang-switcher .dropdown-item {
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 13px;
    font-weight: 500;
}
.lang-switcher .dropdown-item.active {
    background: #2D6A4F;
    color: #fff;
}
.lang-switcher .dropdown-item:hover:not(.active) {
    background: #f0f7f4;
}
</style>
