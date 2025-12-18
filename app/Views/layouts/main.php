<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Task App' ?></title>
    
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.min.js"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-slate-900 text-white hidden md:block flex-shrink-0">
            <div class="p-6 text-2xl font-bold border-b border-slate-800 text-blue-400">Task-IT</div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="#" class="block px-4 py-2 rounded bg-slate-800 text-white">Dashboard</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-slate-800 transition">My Tasks</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-slate-800 transition">User Management</a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
                <h2 class="font-semibold text-xl text-gray-800"><?= $title ?? 'Overview' ?></h2>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500 font-medium"><?= session()->get('user_role') ?? 'Programmer' ?></span>
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold shadow-md">
                        E
                    </div>
                </div>
            </header>

            <div class="p-6">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

</body>
</html>