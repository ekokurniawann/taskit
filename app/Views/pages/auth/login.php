<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Task-IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#F9FAFB] h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[400px]">
        <div class="mb-10 text-center">
            <span class="text-2xl font-bold tracking-tight text-slate-900">TASK<span class="text-blue-600">IT</span></span>
        </div>

        <div class="bg-white p-10 rounded-2xl border border-slate-200 shadow-sm">
            <h1 class="text-xl font-bold text-slate-900 mb-2">Selamat datang kembali</h1>
            <p class="text-sm text-slate-500 mb-8 font-medium">Masuk untuk mengelola tugas Anda.</p>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="mb-6 p-4 bg-red-50 text-red-700 text-xs font-bold rounded-lg border border-red-100 uppercase tracking-wider">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-2">Alamat Email</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-50/50 outline-none transition-all text-sm font-medium">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-2">Kata Sandi</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-50/50 outline-none transition-all text-sm font-medium">
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-xs text-slate-400 font-medium tracking-tight">
            &copy; 2025 Task-IT Engineering Team
        </p>
    </div>

</body>
</html>