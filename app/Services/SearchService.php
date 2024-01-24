<?php

declare(strict_types=1);

namespace App\Services;
use App\Models\Trivium;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class SearchService
{
    protected string $keyword = "";
    protected string $target = "";
    private int $maxPaginate = 50;

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
        $this->target = $target;

        $this->emptyTrivium = collect();
        $dummyData = new stdClass();
        $dummyData->id = 0;
        $dummyData->title = '検索結果がありません';
        $dummyData->summary = '検索結果がありません';
        $dummyData->detail = '検索結果がありません';
        $dummyData->created_at = '検索結果がありません';
        $dummyData->updated_at = '検索結果がありません';
        $this->emptyTrivium->push($dummyData);

        // ダミー用のインスタンスをLengthAwarePaginatorにする
        $this->emptyTrivium = new LengthAwarePaginator(
            $this->emptyTrivium,
            $this->emptyTrivium->count(),
            $this->maxPaginate,
            1
        );
    }

    public function search(): LengthAwarePaginator
    {
        if ($this->target === 'title') {
            return $this->searchByTitle();
        } elseif ($this->target === 'detail') {
            return $this->searchByDetail();
        } elseif ($this->target === 'both') {
            return $this->searchByBoth();
        }
    }

    private function searchByTitle(): LengthAwarePaginator
    {
        $trivia = Trivium::where('title', 'like', '%'.$this->keyword.'%')
        ->paginate($this->maxPaginate)
        ->appends(['target' => $this->target, 'keyword' => $this->keyword]);
        // 結果が空の場合はダミーの配列を返す
        return $trivia->isEmpty() ? $this->emptyTrivium : $trivia;
    }

    private function searchByDetail(): LengthAwarePaginator
    {
        $trivia = Trivium::where('detail', 'like', '%'.$this->keyword.'%')
        ->paginate($this->maxPaginate)
        ->appends(['target' => $this->target, 'keyword' => $this->keyword]);
        return $trivia->isEmpty() ? $this->emptyTrivium : $trivia;
    }

    private function searchByBoth(): LengthAwarePaginator
    {
        $trivia = Trivium::where('title', 'like', '%'.$this->keyword.'%')
            ->orWhere('detail', 'like', '%'.$this->keyword.'%')
            ->paginate($this->maxPaginate)
            ->appends(['target' => $this->target, 'keyword' => $this->keyword]);
        return $trivia->isEmpty() ? $this->emptyTrivium : $trivia;
    }
}
