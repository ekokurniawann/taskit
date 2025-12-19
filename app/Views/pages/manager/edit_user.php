<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto py-8 px-4">
    <a href="<?= base_url('manager/users') ?>" class="text-sm text-slate-500 hover:text-slate-800 mb-4 inline-block transition-colors">
        &larr; Batal & Kembali
    </a>
    
    <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800"><?= $title ?></h1>
                <p class="text-sm text-slate-400">ID Karyawan: #<?= $user['id'] ?></p>
            </div>
            <span class="px-3 py-1 text-[10px] font-bold rounded-full border <?= $user['status'] === 'active' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' ?>">
                <?= strtoupper($user['status']) ?>
            </span>
        </div>

        <form action="<?= base_url('manager/users/update/' . $user['id']) ?>" method="POST">
            <?= csrf_field() ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="<?= old('name', $user['name']) ?>" required 
                           class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-1 focus:ring-slate-800 outline-none transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email Kerja</label>
                        <input type="email" name="email" value="<?= old('email', $user['email']) ?>" required 
                               class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-1 focus:ring-slate-800 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nomor WhatsApp/HP</label>
                        <input type="text" name="phone" value="<?= old('phone', $user['phone'] ?? '') ?>" 
                               placeholder="0812xxxx" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-1 focus:ring-slate-800 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-1 focus:ring-slate-800 outline-none transition-all" 
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role Akses</label>
                        <select name="role_id" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none bg-slate-50 focus:bg-white transition-all">
                            <?php foreach($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= (old('role_id', $user['role_id']) == $role['id']) ? 'selected' : '' ?>><?= $role['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Departemen</label>
                        <select name="department_id" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none bg-slate-50 focus:bg-white transition-all">
                            <?php foreach($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= (old('department_id', $user['department_id']) == $dept['id']) ? 'selected' : '' ?>><?= $dept['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan (Position)</label>
                        <input type="text" name="position" value="<?= old('position', $user['position']) ?>" 
                               class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-1 focus:ring-slate-800 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status Akun</label>
                        <select name="status" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none bg-slate-50 focus:bg-white transition-all">
                            <option value="active" <?= (old('status', $user['status']) == 'active') ? 'selected' : '' ?>>ACTIVE</option>
                            <option value="inactive" <?= (old('status', $user['status']) == 'inactive') ? 'selected' : '' ?>>INACTIVE</option>
                            <option value="resigned" <?= (old('status', $user['status']) == 'resigned') ? 'selected' : '' ?>>RESIGNED</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-lg hover:bg-black transition-all font-bold shadow-lg shadow-slate-200">
                        Update Data Karyawan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>