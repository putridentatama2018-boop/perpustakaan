<?php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$iconMap = [
    'success' => 'bi-check-circle-fill',
    'danger'  => 'bi-exclamation-triangle-fill',
    'warning' => 'bi-exclamation-circle-fill',
    'info'    => 'bi-info-circle-fill',
];
?>
<?php if ($flash): 
    $type = htmlspecialchars($flash['type'] ?? 'info');
    $icon = $iconMap[$type] ?? 'bi-info-circle-fill';
?>
<div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
    <i class="bi <?= $icon ?> fs-5"></i>
    <div class="flex-grow-1">
        <?= htmlspecialchars($flash['message'] ?? '') ?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
