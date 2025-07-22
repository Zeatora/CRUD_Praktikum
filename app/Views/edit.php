<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Mahasiswa</h2>

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

        <form method="post" action="<?= base_url('MahasiswaController/update/' . $mhs['id']) ?>" class="space-y-5">
            <div>
                <label class="block text-gray-700 font-medium">Nama</label>
                <input type="text" name="nama" value="<?= esc($mhs['nama']) ?>" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">NIM</label>
                <input type="text" name="nim" value="<?= esc($mhs['nim']) ?>" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Jurusan</label>
                <input type="text" name="jurusan" value="<?= esc($mhs['jurusan']) ?>" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" value="<?= esc($mhs['email']) ?>" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html>