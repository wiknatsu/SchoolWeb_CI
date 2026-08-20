<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use App\Models\VisitorModel;

class NewsApi extends BaseController
{
    public function search()
    {
        $keyword = $this->request->getGet('q');
        if (empty($keyword) || mb_strlen($keyword) < 2) {
            return $this->response->setJSON([]);
        }

        $newsModel = new NewsModel();
        $results = $newsModel->select('id, title, slug, featured_image, published_at')
            ->where('status', 'published')
            ->where('deleted_at', null)
            ->like('title', $keyword)
            ->limit(5)
            ->findAll();

        foreach ($results as &$item) {
            $item['url'] = base_url('berita/' . $item['slug']);
            $item['image_url'] = get_image_url($item['featured_image'], 'news');
            $item['date'] = format_date_indo($item['published_at']);
        }

        return $this->response->setJSON($results);
    }

    public function trafficStats()
    {
        $visitorModel = new VisitorModel();
        return $this->response->setJSON($visitorModel->getWeeklyTraffic());
    }
}
