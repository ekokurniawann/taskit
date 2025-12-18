<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0">
    <div>
        <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wider"><?= $title ?? 'Dashboard' ?></h2>
    </div>
    
    <div class="flex items-center gap-6">
        <div class="flex flex-col text-right">
            <span class="text-sm font-bold text-slate-900 leading-none"><?= session()->get('name') ?></span>
            <span class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-tighter"><?= session()->get('role_name') ?></span>
        </div>
        
        <div class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-[11px] font-bold text-white uppercase tracking-tighter">
            <?= substr(session()->get('name') ?? 'U', 0, 1) ?>
        </div>
    </div>
</header>