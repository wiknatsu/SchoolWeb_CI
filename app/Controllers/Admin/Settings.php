<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Settings extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $dbVersion = $db->getVersion();

        $data = [
            'title'        => 'Pengaturan Sistem & Utilitas',
            'profile'      => $this->schoolProfile,
            'phpVersion'   => phpversion(),
            'ciVersion'    => \CodeIgniter\CodeIgniter::CI_VERSION,
            'dbVersion'    => $dbVersion,
            'serverTime'   => Time::now()->toDateTimeString(),
            'timezone'     => date_default_timezone_get(),
        ];

        return view('admin/settings/index', $data);
    }

    public function clearCache()
    {
        $cache = \Config\Services::cache();
        $cache->clean();

        return redirect()->to(base_url('admin/pengaturan'))->with('success', 'Semua cache aplikasi dan profil berhasil dibersihkan.');
    }
}
