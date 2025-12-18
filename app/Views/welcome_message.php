<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="bg-white p-8 shadow-sm rounded-2xl border border-gray-100">
        <h1 class="text-3xl font-bold text-blue-600">
            Tailwind Berhasil Terpasang!
        </h1>
        <p class="text-gray-600 mt-2">
            Sekarang file ini menggunakan layout <code class="bg-gray-100 px-1 rounded text-red-500">main.php</code>.
        </p>
        
        <div class="mt-6 flex gap-4">
            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all duration-300">
                Action Button
            </button>
            <button class="px-6 py-2 bg-white text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                Secondary
            </button>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        <div class="p-4 bg-white rounded-xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Tasks</p>
            <p class="text-2xl font-bold text-gray-800">24</p>
        </div>
    </div>
<?= $this->endSection() ?>