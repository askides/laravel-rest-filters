<?php

namespace ItsRennyMan\RestFilters;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('withRestFilters', function () {
            // Filtering
            $query = request()->query->all();

            // Needs to exclude key items like "sort"
            $fields = collect($query)->except(['sort', 'fields', 'embed'])->filter(function ($value, $field) {
                // Check has Multiple Filters
                if (Str::contains($value, ',')) {
                    $this->whereIn($field, Str::of($value)->explode(','));
                } else {
                    empty($value) ?:
                        $this->where($field, '=', $value);
                }
            });

            // Selecting Fields
            if (request()->filled('fields')) {
                $fields = Str::of(request()->fields)->explode(',');

                $fields->each(function ($field) {
                    $this->addSelect($field);
                });
            }

            // Sorting
            if (request()->filled('sort')) {
                $fields = Str::of(request()->sort)->explode(',');

                $fields->each(function ($field) {
                    $sortDirection = Str::startsWith($field, '-') ? 'DESC' : 'ASC';

                    $this->orderBy(Str::replaceFirst('-', '', $field), $sortDirection);
                });
            }

            // Embedding
            if (request()->filled('embed')) {
                $fields = Str::of(request()->sort)->explode(',');

                $fields->each(function ($field) {
                    $this->with($field);
                });
            }

            return $this;
        });
    }
}