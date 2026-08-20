<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class VisitorModel extends Model
{
    protected $table            = 'visitors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ip_address',
        'user_agent',
        'page_visited',
        'referrer',
        'session_id',
        'visited_at',
    ];

    /**
     * Record visitor
     */
    public function logVisit(string $pageVisited = '/'): void
    {
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $ip = $request->getIPAddress();
        $userAgent = $request->getUserAgent()->getAgentString();
        $referrer = $request->getServer('HTTP_REFERER') ?? '';
        $sessionId = $session->session_id ?? session_id();

        // Avoid duplicate logging within 5 minutes for the same session and page
        $recent = $this->where('session_id', $sessionId)
            ->where('page_visited', $pageVisited)
            ->where('visited_at >=', Time::now()->subMinutes(5)->toDateTimeString())
            ->first();

        if (!$recent) {
            $this->insert([
                'ip_address'   => $ip,
                'user_agent'   => mb_substr($userAgent, 0, 500),
                'page_visited' => $pageVisited,
                'referrer'     => mb_substr($referrer, 0, 255),
                'session_id'   => $sessionId,
                'visited_at'   => Time::now()->toDateTimeString(),
            ]);
        }
    }

    /**
     * Get counts
     */
    public function getTodayCount(): int
    {
        return $this->where('visited_at >=', Time::today()->toDateTimeString())->countAllResults();
    }

    public function getThisMonthCount(): int
    {
        $startOfMonth = Time::now()->setDay(1)->setTime(0, 0, 0)->toDateTimeString();
        return $this->where('visited_at >=', $startOfMonth)->countAllResults();
    }

    public function getTotalCount(): int
    {
        return $this->countAllResults();
    }

    /**
     * Get 7-day traffic dataset for Chart.js
     */
    public function getWeeklyTraffic(): array
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Time::today()->subDays($i);
            $dateStr = $date->toDateString();
            $labels[] = $date->toLocalizedString('EEE, d MMM');

            $start = $date->setTime(0, 0, 0)->toDateTimeString();
            $end = $date->setTime(23, 59, 59)->toDateTimeString();

            $count = $this->where('visited_at >=', $start)
                ->where('visited_at <=', $end)
                ->countAllResults();

            $data[] = $count;
        }

        return [
            'labels' => $labels,
            'data'   => $data,
        ];
    }
}
