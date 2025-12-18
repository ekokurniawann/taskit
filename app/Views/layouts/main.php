<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Task-IT' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F9FAFB] text-slate-900 antialiased">

    <div class="flex h-screen overflow-hidden">
        <?= $this->include('partials/sidebar') ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= $this->include('partials/header') ?>

            <main class="flex-1 overflow-y-auto">
                <div class="p-8 max-w-7xl mx-auto">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>
        </div>
    </div>

</body>
</html>