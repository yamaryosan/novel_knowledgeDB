<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DummyArticle;

class DummyArticleService
{
    protected array $dummy_articles = [];

    public function __construct(array $dummy_articles)
    {
        $this->dummy_articles = $dummy_articles;
    }

    public function save(): void
    {
        foreach ($this->dummy_articles as $dummy_article) {
            $model = new DummyArticle();
            $model->title = $dummy_article['title'];
            $model->summary = $dummy_article['summary'];
            $model->detail = $dummy_article['detail'];
            $model->save();
        }
    }
}
