<?php

namespace App\Models\Traits;

use Illuminate\Http\Request;

trait Searchable
{
    public function scopeSearch($query, Request $request)
    {
        $searchTerm = $request->input('search');

        return $query->when($searchTerm, function ($q, $term) {
            
            $q->where(function ($subQuery) use ($term) {
                foreach ($this->searchable as $column) {
                    $subQuery->orWhere($column, 'like', "%{$term}%");
                }
            });

            if (property_exists($this, 'searchableRelations')) {
                foreach ($this->searchableRelations as $relation => $columns) {
                    $q->orWhereHas($relation, function ($relQuery) use ($term, $columns) {
                        foreach ($columns as $col) {
                            $relQuery->orWhere($col, 'like', "%{$term}%");
                        }
                    });
                }
            }
        });
    }
}