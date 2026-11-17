<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class Slug
{
    public static function unique(string $base, string $table, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $base = trim($base) !== '' ? $base : 'item';
        $slug = $base;
        $i = 1;

        while (
            DB::table($table)
                ->where($column, $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
