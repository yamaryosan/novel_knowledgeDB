<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\SearchService;

class SearchServiceTest extends TestCase
{
    public function testSearchServiceThrowsExceptionWhenKeywordIsEmpty()
    {
        $this->expectException(\Exception::class);
        $searchService = new SearchService("", "title");
    }

    public function testSearchServiceThrowsExceptionWhenKeywordIsTooLong()
    {
        $this->expectException(\Exception::class);
        $tooLongKeyword = str_repeat("a", env('MAX_SEARCH_KEYWORD_LENGTH') + 1);
        $searchService = new SearchService($tooLongKeyword, "title");
    }

    public function testSearchServiceThrowsExceptionWhenTargetIsInvalid()
    {
        $this->expectException(\Exception::class);
        $searchService = new SearchService("keyword", "invalid");
    }
}
