<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <div class="mb-8">
        <h1 class="text-xl font-bold text-slate-900">Ringkasan Tugas</h1>
        <p class="text-sm text-slate-500">Pantau progres pengerjaan tim Anda.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full">
            <tbody class="divide-y divide-slate-100">
                <?php if (!empty($tasks)) : ?>
                    <?php foreach ($tasks as $task) : ?>
                        <tr class="group hover:bg-slate-50/50 transition-all">
                            <td class="px-8 py-4">
                                <p class="text-sm font-semibold text-slate-900"><?= $task['title'] ?></p>
                                <p class="text-[10px] text-slate-400 uppercase mt-1">Due: <?= $task['deadline'] ?></p>
                            </td>
                            <td class="px-8 py-4">
                                <?= view('components/priority_label', ['priority' => $task['priority']]) ?>
                            </td>
                            <td class="px-8 py-4">
                                <?= view('components/status_badge', ['status' => $task['status']]) ?>
                            </td>
                            <td class="px-8 py-4">
                                <?= view('components/task_actions', ['task_id' => $task['id']]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-slate-400 text-sm">
                            Tidak ada tugas untuk saat ini.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>