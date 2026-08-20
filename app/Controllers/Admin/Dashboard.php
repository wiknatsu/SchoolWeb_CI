<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use App\Models\NewsCategoryModel;
use App\Models\SchoolAppModel;
use App\Models\PageModel;
use App\Models\GalleryModel;
use App\Models\UserModel;
use App\Models\VisitorModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $newsModel    = new NewsModel();
        $visitorModel = new VisitorModel();
        $appModel     = new SchoolAppModel();
        $pageModel    = new PageModel();
        $galleryModel = new GalleryModel();
        $userModel    = new UserModel();

        // Statistics
        $totalNews       = $newsModel->where('status', 'published')->countAllResults();
        $totalViewsQuery = $newsModel->selectSum('view_count')->first();
        $totalViews      = (int) ($totalViewsQuery['view_count'] ?? 0);
        $totalApps       = $appModel->countAllResults();
        $totalGalleries  = $galleryModel->countAllResults();
        $totalUsers      = $userModel->countAllResults();

        // Visitors
        $todayVisitors   = $visitorModel->getTodayCount();
        $monthVisitors   = $visitorModel->getThisMonthCount();
        $totalVisitors   = $visitorModel->getTotalCount();
        $weeklyTraffic   = $visitorModel->getWeeklyTraffic();

        // Recent items
        $recentNews = $newsModel->select('news.*, news_categories.name as category_name')
            ->join('news_categories', 'news_categories.id = news.category_id', 'left')
            ->orderBy('news.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $recentVisitors = $visitorModel->orderBy('visited_at', 'DESC')
            ->limit(8)
            ->findAll();

        $data = [
            'title'          => 'Dashboard Administrator - ' . $this->schoolProfile['school_name'],
            'profile'        => $this->schoolProfile,
            'stats'          => [
                'total_news'      => $totalNews,
                'total_views'     => $totalViews,
                'total_apps'      => $totalApps,
                'total_galleries' => $totalGalleries,
                'total_users'     => $totalUsers,
                'today_visitors'  => $todayVisitors,
                'month_visitors'  => $monthVisitors,
                'total_visitors'  => $totalVisitors,
            ],
            'weeklyTraffic'  => $weeklyTraffic,
            'recentNews'     => $recentNews,
            'recentVisitors' => $recentVisitors,
        ];

        return view('admin/dashboard', $data);
    }
}
