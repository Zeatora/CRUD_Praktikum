<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $judul ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6 font-sans">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-3xl font-bold text-gray-800 mb-6"><?= $judul ?></h2>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
            <a href="<?= base_url('MahasiswaController/create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                + Tambah Data
            </a>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-4">
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 border border-red-300" role="alert">
                        <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.054 0 1.918-.816 1.994-1.85L21 18V6a2 2 0 00-1.85-1.995L19 4H5a2 2 0 00-1.995 1.85L3 6v12c0 1.054.816 1.918 1.85 1.994L5 20z" />
                        </svg>
                        <div>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form method="get" action="<?= base_url('MahasiswaController/index') ?>" class="flex flex-wrap gap-3 md:gap-4">
                <input type="text" name="nama" placeholder="Cari Nama"
                    value="<?= esc($nama ?? '') ?>"
                    class="border border-gray-300 px-4 py-2 rounded-lg w-40 md:w-52">

                <select name="jurusan" class="border border-gray-300 px-4 py-2 rounded-lg w-40 md:w-52">
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Teknik Informatika" <?= ($jurusan ?? '') == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Manajemen" <?= ($jurusan ?? '') == 'Manajemen' ? 'selected' : '' ?>>Manajemen</option>
                    <option value="Akuntansi" <?= ($jurusan ?? '') == 'Akuntansi' ? 'selected' : '' ?>>Akuntansi</option>
                </select>

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-sm text-left table-auto">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border">No</th>
                        <th class="px-4 py-3 border">Nama</th>
                        <th class="px-4 py-3 border">NIM</th>
                        <th class="px-4 py-3 border">Jurusan</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">File</th>
                        <th class="px-4 py-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($mahasiswa as $m): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3"><?= ++$start ?></td>
                            <td class="px-4 py-3"><?= $m['nama'] ?></td>
                            <td class="px-4 py-3"><?= $m['nim'] ?></td>
                            <td class="px-4 py-3"><?= $m['jurusan'] ?></td>
                            <td class="px-4 py-3"><?= $m['email'] ?></td>
                            <td class="px-4 py-3">
                                <?php if (!empty($m['file_upload'])): ?>
                                    <a href="<?= base_url('uploads/' . $m['file_upload']) ?>"
                                        class="text-blue-600 hover:underline"
                                        target="_blank">Lihat File</a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="<?= base_url('MahasiswaController/edit/' . $m['id']) ?>"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                |
                                <a href="<?= base_url('MahasiswaController/delete/' . $m['id']) ?>"
                                    onclick="return confirm('Yakin ingin menghapus?')"
                                    class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
            <div class="flex justify-center mt-4 space-x-1">
                <?= $pager->links('default', 'tailwind_pager') ?>
            </div>
        </div>
    </div>
</body>

</html>