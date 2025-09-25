<?php

namespace Tests\Unit;

use App\Traits\PaginationTrait;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Mockery;

class PaginationTraitTest extends TestCase
{
    use PaginationTrait;

    public function test_get_per_page_returns_default()
    {
        $request = new Request();
        $perPage = $this->getPerPage($request);
        
        $this->assertEquals(10, $perPage);
    }

    public function test_get_per_page_returns_custom_value()
    {
        $request = new Request(['per_page' => 25]);
        $perPage = $this->getPerPage($request);
        
        $this->assertEquals(25, $perPage);
    }

    public function test_get_per_page_respects_max_limit()
    {
        $request = new Request(['per_page' => 150]); // Above max of 100
        $perPage = $this->getPerPage($request, 10, 100);
        
        $this->assertEquals(100, $perPage);
    }

    public function test_get_per_page_respects_min_limit()
    {
        $request = new Request(['per_page' => 0]); // Below min of 1
        $perPage = $this->getPerPage($request);
        
        $this->assertEquals(1, $perPage);
    }
}