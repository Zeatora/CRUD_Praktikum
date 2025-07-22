<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    public function index()
    {
        $nama = $this->request->getGet('nama');
        $jurusan = $this->request->getGet('jurusan');

        $model = new MahasiswaModel();

        $builder = $model;

        if ($nama) {
            $builder = $builder->like('nama', $nama);
        }

        if ($jurusan) {
            $builder = $builder->where('jurusan', $jurusan);
        }

        $data['mahasiswa'] = $builder->paginate(5, 'default');
        $data['pager'] = $model->pager;

        $data['nama'] = $nama;
        $data['jurusan'] = $jurusan;
        $data['judul'] = 'List Mahasiswa By Salman Al Farizi | Hoho';

        return view('index', $data);
    }


    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $validationRule = [
            'nama' => 'required|min_length[3]',
            'jurusan' => 'required|min_length[3]',
            'nim' => 'required|numeric',
            'email' => 'required|valid_email',
            'file_upload' => [
                'uploaded[file_upload]',
                'mime_in[file_upload,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'max_size[file_upload,2048]',
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $file = $this->request->getFile('file_upload');
        $fileName = $file->getRandomName();
        $file->move('uploads/', $fileName);

        $model = new MahasiswaModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan'),
            'email' => $this->request->getPost('email'),
            'file_upload' => $fileName,
        ]);

        return redirect()->to(base_url('MahasiswaController/index'));
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $data['mhs'] = $model->find($id);

        if (!$data['mhs']) {
            return redirect()->to(base_url('MahasiswaController/index'))->with('error', 'Data tidak ditemukan.');
        }

        return view('edit', $data);
    }

    public function update($id)
    {
        $validationRule = [
            'nama' => 'required|min_length[3]',
            'jurusan' => 'required|min_length[3]',
            'nim' => 'required|numeric|min_length[3]',
            'email' => 'required|valid_email',
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $model = new MahasiswaModel();

        // Cek apakah ada file baru diupload
        $file = $this->request->getFile('file_upload');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan'),
            'email' => $this->request->getPost('email'),
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/', $fileName);
            $data['file_upload'] = $fileName;
        }

        $model->update($id, $data);

        return redirect()->to(base_url('MahasiswaController/index'))->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);
        return redirect()->to(base_url('MahasiswaController/index'))->with('success', 'Data berhasil dihapus');
    }
}
