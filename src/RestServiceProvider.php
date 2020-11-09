<?php

namespace ItsRennyMan\RestFilters;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

use ItsRennyMan\RestFilters\Helpers\Attribute;

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
            // Model Instance
            $model = $this->getModel();
            // Filtering
            $query = request()->query->all();

            // Needs to exclude key items like "sort"
            collect($query)->except(['sort', 'fields', 'embed', 'page'])
                ->except($model->bannedFields ?: [])
                ->each(function ($value, $field) use ($model) {
                    // Check has Multiple Filters
                    if (Str::contains($value, ',')) {
                        $this->whereIn($field, Str::of($value)->explode(','));
                    } else {
                        // Empty value. Skip.
                        if (empty($value)) {
                            return true;
                        }

                        // Check has an extra attribute
                        if (Str::contains($value, ':')) {
                            $attributeAndValue = Str::of($value)->explode(':');
                           
                            // Check Banned Attributes
                            if ($model->bannedAttributes && in_array($attributeAndValue[0], $model->bannedAttributes)) {
                                return true;
                            }

                            // Replace Attribute
                            $replacedAttribute = Attribute::sobstitute($attributeAndValue[0]);

                            // If not exists returns false, so not considered.
                            if (! $replacedAttribute) {
                                return true;
                            }

                            $this->where($field, $replacedAttribute, $attributeAndValue[1]);
                        } else {
                            $this->where($field, '=', $value);
                        }
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

            // Embedding (Needs to add id field if filtered.)
            if (request()->filled('embed')) {
                $fields = Str::of(request()->embed)->explode(',');

                $fields->each(function ($field) {
                    $this->with($field);
                });
            }

            return $this;
        });
    }
}