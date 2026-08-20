<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SchoolProfileModel;

class Profile extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new SchoolProfileModel();
    }

    public function index()
    {
        $profile = $this->profileModel->where('is_active', 1)->first() ?: $this->schoolProfile;

        // Decode social media JSON
        $socialMedia = [];
        if (!empty($profile['social_media'])) {
            $socialMedia = is_string($profile['social_media']) ? json_decode($profile['social_media'], true) : $profile['social_media'];
        }

        $data = [
            'title'       => 'Pengaturan Profil Sekolah',
            'profile'     => $profile,
            'socialMedia' => $socialMedia ?: [],
        ];

        return view('admin/profile/index', $data);
    }

    public function update()
    {
        $rules = [
            'school_name'      => 'required|min_length[3]|max_length[255]',
            'email'            => 'permit_empty|valid_email',
            'logo'             => 'permit_empty|is_image[logo]|max_size[logo,2048]|mime_in[logo,image/jpg,image/jpeg,image/png,image/webp,image/svg+xml]',
            'favicon'          => 'permit_empty|max_size[favicon,1024]',
            'principal_photo'  => 'permit_empty|is_image[principal_photo]|max_size[principal_photo,3072]|mime_in[principal_photo,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $profile = $this->profileModel->where('is_active', 1)->first();
        $profileId = $profile ? $profile['id'] : 1;

        // Handle uploads
        $logoName = $profile['logo'] ?? null;
        $logoFile = $this->request->getFile('logo');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            if (!empty($logoName) && file_exists(FCPATH . 'uploads/profiles/' . $logoName)) {
                @unlink(FCPATH . 'uploads/profiles/' . $logoName);
            }
            $logoName = $logoFile->getRandomName();
            $logoFile->move(FCPATH . 'uploads/profiles', $logoName);
        }

        $faviconName = $profile['favicon'] ?? null;
        $faviconFile = $this->request->getFile('favicon');
        if ($faviconFile && $faviconFile->isValid() && !$faviconFile->hasMoved()) {
            if (!empty($faviconName) && file_exists(FCPATH . 'uploads/profiles/' . $faviconName)) {
                @unlink(FCPATH . 'uploads/profiles/' . $faviconName);
            }
            $faviconName = $faviconFile->getRandomName();
            $faviconFile->move(FCPATH . 'uploads/profiles', $faviconName);
        }

        $principalPhotoName = $profile['principal_photo'] ?? null;
        $principalPhotoFile = $this->request->getFile('principal_photo');
        if ($principalPhotoFile && $principalPhotoFile->isValid() && !$principalPhotoFile->hasMoved()) {
            if (!empty($principalPhotoName) && file_exists(FCPATH . 'uploads/profiles/' . $principalPhotoName)) {
                @unlink(FCPATH . 'uploads/profiles/' . $principalPhotoName);
            }
            $principalPhotoName = $principalPhotoFile->getRandomName();
            $principalPhotoFile->move(FCPATH . 'uploads/profiles', $principalPhotoName);
        }

        // Prepare social media JSON
        $socialMedia = json_encode([
            'facebook'  => $this->request->getPost('facebook'),
            'instagram' => $this->request->getPost('instagram'),
            'youtube'   => $this->request->getPost('youtube'),
            'tiktok'    => $this->request->getPost('tiktok'),
            'twitter'   => $this->request->getPost('twitter'),
        ]);

        $updateData = [
            'school_name'       => $this->request->getPost('school_name'),
            'slogan'            => $this->request->getPost('slogan'),
            'description'       => $this->request->getPost('description'),
            'logo'              => $logoName,
            'favicon'           => $faviconName,
            'address'           => $this->request->getPost('address'),
            'phone'             => $this->request->getPost('phone'),
            'email'             => $this->request->getPost('email'),
            'website'           => $this->request->getPost('website'),
            'social_media'      => $socialMedia,
            'vision'            => $this->request->getPost('vision'),
            'mission'           => $this->request->getPost('mission'),
            'principal_name'    => $this->request->getPost('principal_name'),
            'principal_photo'   => $principalPhotoName,
            'principal_welcome' => $this->request->getPost('principal_welcome'),
            'established_year'  => $this->request->getPost('established_year'),
            'accreditation'     => $this->request->getPost('accreditation'),
            'map_embed'         => $this->request->getPost('map_embed'),
            'meta_keywords'     => $this->request->getPost('meta_keywords'),
            'meta_description'  => $this->request->getPost('meta_description'),
            'is_active'         => 1,
        ];

        if ($profile) {
            $this->profileModel->update($profileId, $updateData);
        } else {
            $this->profileModel->insert($updateData);
        }

        // Clear cache
        \Config\Services::cache()->delete('school_profile_active');

        return redirect()->to(base_url('admin/profil-sekolah'))->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
