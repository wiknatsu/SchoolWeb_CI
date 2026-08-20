<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'view_count',
        'is_highlighted',
        'meta_keywords',
        'meta_description',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'title'   => 'required|min_length[5]|max_length[255]',
        'slug'    => 'required|alpha_dash|is_unique[news.slug,id,{id}]',
        'content' => 'required',
        'status'  => 'required|in_list[draft,published,archived]',
    ];

    /**
     * Get published news with category and author relations
     */
    public function getPublished(int $limit = 6, ?int $categoryId = null, ?string $keyword = null)
    {
        $builder = $this->select('news.*, news_categories.name as category_name, news_categories.slug as category_slug, news_categories.icon as category_icon, users.full_name as author_name')
            ->join('news_categories', 'news_categories.id = news.category_id', 'left')
            ->join('users', 'users.id = news.author_id', 'left')
            ->where('news.status', 'published')
            ->where('news.deleted_at', null);

        if (!empty($categoryId)) {
            $builder->where('news.category_id', $categoryId);
        }

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('news.title', $keyword)
                ->orLike('news.excerpt', $keyword)
                ->orLike('news.content', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('news.published_at', 'DESC')->paginate($limit, 'news');
    }

    /**
     * Get highlighted news for hero or featured section
     */
    public function getHighlighted(int $limit = 3): array
    {
        return $this->select('news.*, news_categories.name as category_name, news_categories.slug as category_slug, users.full_name as author_name')
            ->join('news_categories', 'news_categories.id = news.category_id', 'left')
            ->join('users', 'users.id = news.author_id', 'left')
            ->where('news.status', 'published')
            ->where('news.is_highlighted', 1)
            ->where('news.deleted_at', null)
            ->orderBy('news.published_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get popular news by views
     */
    public function getPopular(int $limit = 5): array
    {
        return $this->select('news.*, news_categories.name as category_name, news_categories.slug as category_slug')
            ->join('news_categories', 'news_categories.id = news.category_id', 'left')
            ->where('news.status', 'published')
            ->where('news.deleted_at', null)
            ->orderBy('news.view_count', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get detailed news by slug
     */
    public function getBySlug(string $slug)
    {
        return $this->select('news.*, news_categories.name as category_name, news_categories.slug as category_slug, news_categories.icon as category_icon, users.full_name as author_name, users.avatar as author_avatar')
            ->join('news_categories', 'news_categories.id = news.category_id', 'left')
            ->join('users', 'users.id = news.author_id', 'left')
            ->where('news.slug', $slug)
            ->where('news.status', 'published')
            ->where('news.deleted_at', null)
            ->first();
    }

    /**
     * Increment view count
     */
    public function incrementViews(int $id): bool
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->increment('view_count', 1);
    }
}
