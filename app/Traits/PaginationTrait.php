<?php

namespace App\Traits;

trait PaginationTrait
{
    /**
     * Get standardized pagination parameters
     * 
     * @param Request $request
     * @param int $defaultPerPage
     * @param int $maxPerPage
     * @return int
     */
    protected function getPerPage($request, $defaultPerPage = 10, $maxPerPage = 100)
    {
        $perPage = $request->get('per_page', $defaultPerPage);
        
        // Ensure per page is within valid range
        $perPage = max(1, min($perPage, $maxPerPage));
        
        return (int) $perPage;
    }

    /**
     * Apply standard pagination with search and filters
     * 
     * @param Builder $query
     * @param array $searchableFields
     * @param array $filterableFields
     * @param Request $request
     * @param string $defaultSortColumn
     * @param string $defaultSortDirection
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginateWithSearchAndFilters(
        $query, 
        array $searchableFields = [], 
        array $filterableFields = [],
        $request = null,
        string $defaultSortColumn = 'created_at',
        string $defaultSortDirection = 'desc'
    ) {
        // Apply search filter if request and searchable fields are provided
        if ($request && !empty($searchableFields) && $request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search, $searchableFields) {
                foreach ($searchableFields as $field) {
                    $q->orWhere($field, 'LIKE', "%{$search}%");
                }
            });
        }

        // Apply filters if filterable fields are provided
        if ($request && !empty($filterableFields)) {
            foreach ($filterableFields as $field) {
                if ($request->filled($field)) {
                    $query->where($field, $request->$field);
                }
            }
        }

        // Apply date range filter if date_from and date_to are provided
        if ($request && ($request->filled('date_from') || $request->filled('date_to'))) {
            if ($request->filled('date_from')) {
                $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
            }
            if ($request->filled('date_to')) {
                $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
            }
        }

        // Apply sorting
        $sortColumn = $request && $request->filled('sort_by') ? $request->sort_by : $defaultSortColumn;
        $sortDirection = $request && $request->filled('sort_dir') ? $request->sort_dir : $defaultSortDirection;
        
        $query->orderBy($sortColumn, $sortDirection);

        // Apply pagination
        $perPage = $this->getPerPage($request, 10, 100);

        return $query->paginate($perPage)->appends($request ? $request->query() : []);
    }
}