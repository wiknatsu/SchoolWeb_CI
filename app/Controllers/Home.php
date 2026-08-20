<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\NewsCategoryModel;
use App\Models\SchoolAppModel;
use App\Models\PageModel;
use App\Models\GalleryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    protected $newsModel;
    protected $categoryModel;
    protected $appModel;
    protected $pageModel;
    protected $galleryModel;

    public function __construct()
    {
        $this->newsModel     = new NewsModel();
        $this->categoryModel = new NewsCategoryModel();
        $this->appModel      = new SchoolAppModel();
        $this->pageModel     = new PageModel();
        $this->galleryModel  = new GalleryModel();
    }

    /**
     * Landing Page
     */
    public function index()
    {
        $this->logVisitor('/');

        $data = [
            'title'           => $this->schoolProfile['school_name'] . ' - ' . ($this->schoolProfile['slogan'] ?? 'Website Resmi'),
            'profile'         => $this->schoolProfile,
            'highlightedNews' => $this->newsModel->getHighlighted(3),
            'latestNews'      => $this->newsModel->getPublished(6),
            'schoolApps'      => $this->appModel->getActiveApps(),
            'galleries'       => $this->galleryModel->where('is_featured', 1)->orderBy('display_order', 'ASC')->limit(6)->findAll(),
            'categories'      => $this->categoryModel->where('is_active', 1)->findAll(),
            'meta'            => [
                'description' => $this->schoolProfile['meta_description'] ?? $this->schoolProfile['description'],
                'keywords'    => $this->schoolProfile['meta_keywords'] ?? 'sekolah, pendidikan',
                'image'       => get_image_url($this->schoolProfile['logo'], 'logo'),
            ],
        ];

        return view('home/index', $data);
    }

    /**
     * Tentang Sekolah
     */
    public function about()
    {
        $this->logVisitor('/profil/tentang');

        $data = [
            'title'      => 'Profil & Tentang Sekolah - ' . $this->schoolProfile['school_name'],
            'profile'    => $this->schoolProfile,
            'categories' => $this->categoryModel->where('is_active', 1)->findAll(),
            'meta'       => [
                'description' => 'Mengenal profil, visi misi, dan sejarah ' . $this->schoolProfile['school_name'],
                'keywords'    => 'profil sekolah, visi misi, sejarah sekolah',
            ],
        ];

        return view('home/about', $data);
    }

    /**
     * List Berita / Arsip Berita
     */
    public function news()
    {
        $keyword = $this->request->getGet('q');
        $categorySlug = $this->request->getGet('kategori');
        $categoryId = null;
        $activeCategory = null;

        if (!empty($categorySlug)) {
            $activeCategory = $this->categoryModel->where('slug', $categorySlug)->first();
            if ($activeCategory) {
                $categoryId = $activeCategory['id'];
            }
        }

        $this->logVisitor('/berita' . (!empty($categorySlug) ? '?kategori=' . $categorySlug : ''));

        $data = [
            'title'          => (!empty($activeCategory) ? 'Berita: ' . $activeCategory['name'] : 'Kabar & Berita Terkini') . ' - ' . $this->schoolProfile['school_name'],
            'profile'        => $this->schoolProfile,
            'newsList'       => $this->newsModel->getPublished(9, $categoryId, $keyword),
            'pager'          => $this->newsModel->pager,
            'categories'     => $this->categoryModel->where('is_active', 1)->findAll(),
            'popularNews'    => $this->newsModel->getPopular(5),
            'activeCategory' => $activeCategory,
            'keyword'        => $keyword,
            'meta'           => [
                'description' => 'Kumpulan berita, artikel pendidikan, dan kabar prestasi terbaru ' . $this->schoolProfile['school_name'],
                'keywords'    => 'berita sekolah, prestasi siswa, pengumuman sekolah',
            ],
        ];

        return view('home/news_list', $data);
    }

    /**
     * Berita berdasarkan kategori
     */
    public function newsByCategory(string $slug)
    {
        $category = $this->categoryModel->where('slug', $slug)->first();
        if (!$category) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }

        $this->logVisitor('/berita/kategori/' . $slug);

        $data = [
            'title'          => 'Kategori: ' . $category['name'] . ' - ' . $this->schoolProfile['school_name'],
            'profile'        => $this->schoolProfile,
            'newsList'       => $this->newsModel->getPublished(9, $category['id']),
            'pager'          => $this->newsModel->pager,
            'categories'     => $this->categoryModel->where('is_active', 1)->findAll(),
            'popularNews'    => $this->newsModel->getPopular(5),
            'activeCategory' => $category,
            'keyword'        => null,
            'meta'           => [
                'description' => $category['description'] ?? 'Berita kategori ' . $category['name'],
                'keywords'    => $category['name'] . ', berita sekolah',
            ],
        ];

        return view('home/news_list', $data);
    }

    /**
     * Detail Berita
     */
    public function newsDetail(string $slug)
    {
        $news = $this->newsModel->getBySlug($slug);
        if (!$news) {
            throw PageNotFoundException::forPageNotFound('Berita yang Anda cari tidak ditemukan atau telah dihapus.');
        }

        // Increment views
        $this->newsModel->incrementViews($news['id']);
        $this->logVisitor('/berita/' . $slug);

        // Related news
        $relatedNews = $this->newsModel->where('category_id', $news['category_id'])
            ->where('id !=', $news['id'])
            ->where('status', 'published')
            ->orderBy('published_at', 'DESC')
            ->limit(3)
            ->findAll();

        $data = [
            'title'       => $news['title'] . ' - ' . $this->schoolProfile['school_name'],
            'profile'     => $this->schoolProfile,
            'news'        => $news,
            'relatedNews' => $relatedNews,
            'popularNews' => $this->newsModel->getPopular(5),
            'categories'  => $this->categoryModel->where('is_active', 1)->findAll(),
            'meta'        => [
                'description' => !empty($news['meta_description']) ? $news['meta_description'] : excerpt_words($news['excerpt'] ?? $news['content'], 30),
                'keywords'    => $news['meta_keywords'] ?? 'berita sekolah',
                'image'       => get_image_url($news['featured_image'], 'news'),
            ],
        ];

        return view('home/news_detail', $data);
    }

    /**
     * Galeri Foto & Video
     */
    public function gallery()
    {
        $this->logVisitor('/galeri');

        $galleries = $this->galleryModel->orderBy('display_order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Extract distinct categories
        $galleryCategories = array_unique(array_filter(array_column($galleries, 'category')));

        $data = [
            'title'             => 'Galeri Kegiatan & Dokumentasi - ' . $this->schoolProfile['school_name'],
            'profile'           => $this->schoolProfile,
            'galleries'         => $galleries,
            'galleryCategories' => $galleryCategories,
            'meta'              => [
                'description' => 'Dokumentasi foto dan video kegiatan, sarana, dan event di ' . $this->schoolProfile['school_name'],
                'keywords'    => 'galeri sekolah, foto kegiatan, video sekolah',
            ],
        ];

        return view('home/gallery', $data);
    }

    /**
     * Halaman Statis Dinamis
     */
    public function page(string $slug)
    {
        $page = $this->pageModel->where('slug', $slug)
            ->where('is_active', 1)
            ->first();

        if (!$page) {
            throw PageNotFoundException::forPageNotFound('Halaman tidak ditemukan.');
        }

        $this->logVisitor('/profil/' . $slug);

        // Sidebar other static pages
        $otherPages = $this->pageModel->where('is_active', 1)
            ->where('id !=', $page['id'])
            ->orderBy('display_order', 'ASC')
            ->findAll();

        $data = [
            'title'      => $page['title'] . ' - ' . $this->schoolProfile['school_name'],
            'profile'    => $this->schoolProfile,
            'page'       => $page,
            'otherPages' => $otherPages,
            'categories' => $this->categoryModel->where('is_active', 1)->findAll(),
            'meta'       => [
                'description' => $page['meta_description'] ?? excerpt_words($page['content'], 30),
                'keywords'    => $page['meta_keywords'] ?? 'informasi sekolah',
                'image'       => get_image_url($page['featured_image'], 'profiles'),
            ],
        ];

        return view('home/page', $data);
    }

    /**
     * Kontak & Lokasi
     */
    public function contact()
    {
        $this->logVisitor('/kontak');

        $data = [
            'title'   => 'Hubungi Kami & Lokasi - ' . $this->schoolProfile['school_name'],
            'profile' => $this->schoolProfile,
            'meta'    => [
                'description' => 'Informasi kontak resmi, alamat, email, nomor telepon, dan lokasi peta ' . $this->schoolProfile['school_name'],
                'keywords'    => 'kontak sekolah, lokasi sekolah, alamat sma',
            ],
        ];

        return view('home/contact', $data);
    }

    /**
     * Kirim Pesan Kontak
     */
    public function sendContact()
    {
        $rules = [
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[3]|max_length[150]',
            'message' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return redirect()->to(base_url('kontak'))->with('success', 'Terima kasih! Pesan dan pertanyaan Anda telah berhasil dikirimkan ke tim kami.');
    }
}
