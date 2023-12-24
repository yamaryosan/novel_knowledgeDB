<?php

declare(strict_types=1);

namespace App\Services;
use App\Models\Trivium;

class SearchService
{
    protected string $keyword = "";
    protected string $target = "";

    public function __construct(string $keyword, string $target)
    {
        if (empty($keyword)) {
            throw new \Exception('キーワードが空です');
        }
        if (mb_strlen($keyword) > env('MAX_SEARCH_KEYWORD_LENGTH')) {
            throw new \Exception('キーワードが長すぎます');
        }
        if ($target !== 'title' && $target !== 'detail' && $target !== 'both') {
            throw new \Exception('検索対象が不正です');
        }

        $this->keyword = $keyword;
    }

    public function search(): array
    {
        if ($this->target === 'title') {
            return $this->searchByTitle();
        } elseif ($this->target === 'detail') {
            return $this->searchByDetail();
        } elseif ($this->target === 'both') {
            return $this->searchByBoth();
        }
    }

    public function searchByTitle(): array
    {
        $trivia = Trivium::where('title', 'like', '%'.$this->keyword.'%')->get();
        return $trivia;
    }

    public function searchByDetail(): array
    {
        $trivia = Trivium::where('detail', 'like', '%'.$this->keyword.'%')->get();
        return $trivia;
    }

    public function searchByBoth(): array
    {
        $trivia = Trivium::where('title', 'like', '%'.$this->keyword.'%')
            ->orWhere('detail', 'like', '%'.$this->keyword.'%')
            ->get();
        return $trivia;
    }
}
