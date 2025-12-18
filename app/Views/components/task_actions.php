<div class="flex items-center justify-end gap-4">
    <a href="<?= base_url('tasks/view/'.$task_id) ?>" class="text-[11px] font-bold text-slate-400 hover:text-slate-900 transition-colors uppercase">
        Detail
    </a>

    <?php if (in_array(session()->get('role_name'), ['Manager', 'Supervisor', 'Leader', 'Programmer'])): ?>
        <a href="<?= base_url('tasks/edit/'.$task_id) ?>" class="text-[11px] font-bold text-blue-600 hover:text-blue-800 transition-colors uppercase">
            Update
        </a>
    <?php endif; ?>

    <?php if (session()->get('role_name') === 'Manager'): ?>
        <button onclick="confirmDelete(<?= $task_id ?>)" class="text-[11px] font-bold text-red-400 hover:text-red-700 transition-colors uppercase">
            Delete
        </button>
    <?php endif; ?>
</div>