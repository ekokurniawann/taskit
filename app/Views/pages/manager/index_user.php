<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800"><?= $title ?></h1>
        <p class="text-sm text-slate-500 mt-1">Kelola akses dan profil seluruh karyawan.</p>
    </div>
    <a href="<?= base_url('manager/users/register') ?>" class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-800 transition-all">
        + Tambah User
    </a>
</div>

<div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
    <form action="" method="GET" class="flex w-full md:w-1/2 gap-2">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" 
                   placeholder="Cari nama, email, atau jabatan..." 
                   class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-1 focus:ring-slate-800 outline-none transition-all bg-white">
        </div>
        <button type="submit" class="bg-slate-800 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-black transition-all">
            Cari
        </button>
        <?php if(!empty($keyword)): ?>
            <a href="<?= base_url('manager/users') ?>" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-slate-200 flex items-center">
                Reset
            </a>
        <?php endif; ?>
    </form>
    
    <!-- <div class="text-sm text-slate-500">
        Total: <span class="font-bold text-slate-800"><?= count($users) ?></span> Karyawan
    </div> -->
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm rounded-lg shadow-sm">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Nama & Jabatan</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Email & Dept</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php if(empty($users)): ?>
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm italic">
                        Data karyawan tidak ditemukan.
                    </td>
                </tr>
            <?php endif; ?>
            
            <?php foreach ($users as $u) : ?>
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-slate-900"><?= $u['name'] ?></p>
                    <p class="text-[11px] text-slate-500 font-medium uppercase"><?= $u['position'] ?></p>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm text-slate-600"><?= $u['email'] ?></p>
                    <p class="text-[11px] text-blue-600 font-bold uppercase"><?= $u['dept_name'] ?></p>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="px-2 py-1 text-[10px] font-bold rounded-full border 
                        <?php if($u['status'] === 'active'): ?>
                            bg-emerald-50 text-emerald-600 border-emerald-100
                        <?php elseif($u['status'] === 'inactive'): ?>
                            bg-amber-50 text-amber-600 border-amber-100
                        <?php else: ?>
                            bg-red-50 text-red-600 border-red-100
                        <?php endif; ?>">
                        <?= strtoupper($u['status']) ?>
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-x-3 text-sm font-bold uppercase tracking-tighter">
                    <a href="<?= base_url('manager/users/edit/' . $u['id']) ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                    
                    <?php if($u['id'] != session()->get('user_id')): ?>
                        <a href="<?= base_url('manager/users/delete/' . $u['id']) ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" 
                           class="text-red-400 hover:text-red-700">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>