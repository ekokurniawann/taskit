<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto py-8 px-4">
    <a href="<?= base_url('manager/users') ?>" class="text-sm text-slate-500 hover:text-slate-800 mb-4 inline-block">
        &larr; Kembali ke Daftar Karyawan
    </a>

    <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800 mb-6"><?= $title ?></h1>

        <form action="<?= base_url('manager/users/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Nama Lengkap" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-1 focus:ring-slate-800">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" required placeholder="email@perusahaan.com" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-1 focus:ring-slate-800">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nomor WhatsApp/HP</label>
                        <input type="text" name="phone" placeholder="0812xxxx" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-1 focus:ring-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-1 focus:ring-slate-800">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                        <select name="role_id" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none bg-slate-50">
                            <?php foreach($roles as $role): ?>
                                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Departemen Utama</label>
                        <select name="department_id" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none bg-slate-50">
                            <?php foreach($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan (Position)</label>
                    <input type="text" name="position" required placeholder="Contoh: Senior Programmer" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:ring-1 focus:ring-slate-800">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-lg hover:bg-black transition-colors font-bold shadow-lg">
                        Simpan & Daftarkan User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>