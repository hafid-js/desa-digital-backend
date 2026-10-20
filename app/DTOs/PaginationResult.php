<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

/**
 * Hasil paginasi untuk view, menggantikan object anonim yang dibuat manual.
 */
final readonly class PaginationResult
{
    /**
     * @param  Collection<int, mixed>  $items
     */
    public function __construct(
        public Collection $items,
        public int $total,
        public int $perPage,
        public int $currentPage,
        public int $lastPage,
        public int $firstItem,
        public int $lastItem,
    ) {}

    /**
     * @param  Collection<int, mixed>  $items
     */
    public static function fromCollection(Collection $items, int $perPage, int $currentPage): self
    {
        $total = $items->count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $currentPage = max(1, min($currentPage, $lastPage));
        $offset = ($currentPage - 1) * $perPage;
        $page = $items->slice($offset, $perPage);

        return new self(
            items: $page->values(),
            total: $total,
            perPage: $perPage,
            currentPage: $currentPage,
            lastPage: $lastPage,
            firstItem: $page->isEmpty() ? 0 : $offset + 1,
            lastItem: $page->isEmpty() ? 0 : $offset + $page->count(),
        );
    }

    public function hasMorePages(): bool
    {
        return $this->currentPage < $this->lastPage;
    }
}
