<aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col flex-shrink-0">
    <div class="h-16 flex items-center px-8 border-b border-slate-100">
        <span class="text-lg font-bold tracking-tight text-slate-900">TASK<span class="text-blue-600">IT</span></span>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-1">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] px-4 mb-4">Workspace</p>
        
        <a href="<?= base_url('dashboard') ?>" 
           class="block px-4 py-2 text-sm font-medium rounded-md transition-colors 
           <?= url_is('dashboard*') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' ?>">
            Dashboard
        </a>

        <?php if (session()->get('role_name') === 'Manager'): ?>
            <a href="<?= base_url('manager/users') ?>" 
               class="block px-4 py-2 text-sm font-medium rounded-md transition-colors 
               <?= url_is('manager/users*') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' ?>">
                User Management
            </a>
            
            <a href="<?= base_url('manager/departments') ?>" 
               class="block px-4 py-2 text-sm font-medium rounded-md transition-colors 
               <?= url_is('manager/departments*') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' ?>">
                Departments
            </a>
        <?php endif; ?>

        <a href="<?= base_url('tasks') ?>" 
           class="block px-4 py-2 text-sm font-medium rounded-md transition-colors 
           <?= url_is('tasks*') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' ?>">
            My Tasks
        </a>
    </nav>

    <div class="p-4 border-t border-slate-100">
        <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-sm font-medium text-red-500 hover:bg-red-50 rounded-md transition-colors">
            Keluar
        </a>
    </div>
</aside>