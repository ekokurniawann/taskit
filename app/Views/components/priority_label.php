<?php
$priority = strtolower($priority ?? 'medium');
$colors = [
    'high'   => 'text-red-600 font-bold',
    'medium' => 'text-slate-900 font-semibold',
    'low'    => 'text-slate-400 font-medium',
];
$class = $colors[$priority] ?? 'text-slate-600';
?>
<span class="text-[11px] uppercase tracking-tighter <?= $class ?>">
    <?= $priority ?>
</span>