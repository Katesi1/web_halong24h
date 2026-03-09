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
<div class="dropdown lang-switcher me-3">
    <button class="lang-switcher-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="lang-flag"><?php echo $langs[$current]['flag'] ?></span>
        <span class="lang-code"><?php echo $langs[$current]['label'] ?></span>
        <i class="bi bi-chevron-down lang-chevron"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end lang-dd-menu">
        <div class="lang-dd-header">
            <i class="bi bi-translate"></i>
            <span><?php _e('nav_language') ?></span>
        </div>
        <?php foreach ($langs as $code => $info): ?>
        <a class="lang-dd-item <?php echo $code === $current ? 'active' : '' ?>"
           href="<?php echo $current_page . '?' . $query_string . $separator . 'lang=' . $code ?>">
            <span class="lang-dd-flag"><?php echo $info['flag'] ?></span>
            <div class="lang-dd-text">
                <span class="lang-dd-name"><?php echo $info['name'] ?></span>
                <span class="lang-dd-code"><?php echo $info['label'] ?></span>
            </div>
            <?php if ($code === $current): ?>
                <span class="lang-dd-check"><i class="bi bi-check-circle-fill"></i></span>
            <?php endif; ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<style>
/* Language Switcher Button */
.lang-switcher-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: #f5f9f7;
    border: 1.5px solid #e0ebe5;
    border-radius: 50px;
    cursor: pointer;
    font-size: 0.82rem;
    font-weight: 600;
    color: #2D6A4F;
    transition: all 0.25s ease;
    line-height: 1;
}
.lang-switcher-btn:hover {
    background: #e8f5ee;
    border-color: #2D6A4F;
    box-shadow: 0 2px 8px rgba(45, 106, 79, 0.12);
}
.lang-switcher-btn::after { display: none; } /* remove bootstrap caret */

.lang-flag {
    font-size: 16px;
    line-height: 1;
}
.lang-code {
    letter-spacing: 0.5px;
}
.lang-chevron {
    font-size: 10px;
    color: #7fad97;
    transition: transform 0.2s;
}
.lang-switcher.show .lang-chevron {
    transform: rotate(180deg);
}

/* Dropdown Menu */
.lang-dd-menu {
    min-width: 200px;
    padding: 0;
    border: none;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.14);
    margin-top: 10px !important;
    overflow: hidden;
    animation: langDdIn 0.2s ease;
}
@keyframes langDdIn {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Header */
.lang-dd-header {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 18px 10px;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #9ab5a8;
    border-bottom: 1px solid #f0f0f0;
}
.lang-dd-header i {
    font-size: 13px;
}

/* Items */
.lang-dd-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    text-decoration: none;
    color: #444;
    font-size: 0.88rem;
    font-weight: 500;
    transition: all 0.15s ease;
    position: relative;
}
.lang-dd-item:not(:last-child) {
    border-bottom: 1px solid #f5f5f5;
}
.lang-dd-item:hover:not(.active) {
    background: #f0f7f4;
    color: #2D6A4F;
}
.lang-dd-item.active {
    background: linear-gradient(135deg, #2D6A4F 0%, #40916C 100%);
    color: #fff;
}

.lang-dd-flag {
    font-size: 22px;
    line-height: 1;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.04);
    border-radius: 8px;
    flex-shrink: 0;
}
.lang-dd-item.active .lang-dd-flag {
    background: rgba(255,255,255,0.18);
}

.lang-dd-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 1px;
}
.lang-dd-name {
    font-weight: 600;
    font-size: 0.86rem;
}
.lang-dd-code {
    font-size: 0.72rem;
    color: #999;
    font-weight: 500;
    letter-spacing: 0.5px;
}
.lang-dd-item.active .lang-dd-code {
    color: rgba(255,255,255,0.7);
}

.lang-dd-check {
    color: rgba(255,255,255,0.9);
    font-size: 16px;
    flex-shrink: 0;
}
</style>
