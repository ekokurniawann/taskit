<?php
$status = strtolower($status ?? 'pending');
$styles = [
    'pending'     => 'bg-amber-50 text-amber-700 border-amber-200',
    'in_progress' => 'bg-blue-50 text-blue-700 border-blue-200',
    'done'        => 'bg-slate-100 text-slate-700 border-slate-300',
];
$class = $styles[$status] ?? 'bg-gray-50 text-gray-600 border-gray-200';
?>
<span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-widest border rounded <?= $class ?>">
    <?= str_replace('_', ' ', $status) ?>
</span>