<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryModel;

class Gallery extends BaseController
{
    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    public function index()
    {
        $galleries = $this->galleryModel->orderBy('display_order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'title'     => 'Manajemen Galeri Media & Dokumentasi',
            'profile'   => $this->schoolProfile,
            'galleries' => $galleries,
        ];

        return view('admin/gallery/index', $data);
    }

    public function store()
    {
        $type = $this->request->getPost('type') ?: 'image';

        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'type'     => 'required|in_list[image,video]',
        ];

        if ($type === 'image' && empty($this->request->getPost('external_url'))) {
            $rules['file'] = 'uploaded[file]|is_image[file]|max_size[file,5120]|mime_in[file,image/jpg,image/jpeg,image/png,image/webp]';
        } else {
            $rules['file_url'] = 'permit_empty';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileUrl = $this->request->getPost('file_url');

        // Handle image upload
        $imageFile = $this->request->getFile('file');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $fileName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/gallery', $fileName);
            $fileUrl = base_url('uploads/gallery/' . $fileName);
        }

        if (empty($fileUrl)) {
            return redirect()->back()->withInput()->with('error', 'URL berkas atau unggahan gambar wajib diisi.');
        }

        $this->galleryModel->insert([
            'title'         => $this->request->getPost('title'),
            'description'   => $this->request->getPost('description'),
            'type'          => $type,
            'file_url'      => $fileUrl,
            'category'      => $this->request->getPost('category') ?: 'Kegiatan',
            'is_featured'   => $this->request->getPost('is_featured') ? 1 : 0,
            'display_order' => (int) $this->request->getPost('display_order'),
        ]);

        return redirect()->to(base_url('admin/galeri'))->with('success', 'Media baru berhasil ditambahkan ke galeri.');
    }

    public function update($id = null)
    {
        $gallery = $this->galleryModel->find($id);
        if (!$gallery) {
            return redirect()->to(base_url('admin/galeri'))->with('error', 'Item galeri tidak ditemukan.');
        }

        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'type'     => 'required|in_list[image,video]',
            'file'     => 'permit_empty|is_image[file]|max_size[file,5120]|mime_in[file,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileUrl = $this->request->getPost('file_url') ?: $gallery['file_url'];

        // Handle new file upload
        $imageFile = $this->request->getFile('file');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $fileName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/gallery', $fileName);
            $fileUrl = base_url('uploads/gallery/' . $fileName);
        }

        $this->galleryModel->update($id, [
            'title'         => $this->request->getPost('title'),
            'description'   => $this->request->getPost('description'),
            'type'          => $this->request->getPost('type'),
            'file_url'      => $fileUrl,
            'category'      => $this->request->getPost('category'),
            'is_featured'   => $this->request->getPost('is_featured') ? 1 : 0,
            'display_order' => (int) $this->request->getPost('display_order'),
        ]);

        return redirect()->to(base_url('admin/galeri'))->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $gallery = $this->galleryModel->find($id);
        if (!$gallery) {
            return redirect()->to(base_url('admin/galeri'))->with('error', 'Item galeri tidak ditemukan.');
        }

        // Remove local file if exists
        if (strpos($gallery['file_url'], base_url('uploads/gallery/')) !== false) {
            $filename = str_replace(base_url('uploads/gallery/'), '', $gallery['file_url']);
            if (file_exists(FCPATH . 'uploads/gallery/' . $filename)) {
                @unlink(FCPATH . 'uploads/gallery/' . $filename);
            }
        }

        $this->galleryModel->delete($id);
        return redirect()->to(base_url('admin/galeri'))->with('success', 'Item galeri berhasil dihapus.');
    }
}
