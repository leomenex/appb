<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Traits\Stringable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    use Stringable;

    public function index(Request $request): AnonymousResourceCollection
    {
        $builder = News::query()->with('category');

        foreach ($request->all() as $key => $value) {
            $term = $this->sanitize($value);

            if (Schema::hasColumn('news', $key)) {
                $builder->when(
                    $value,
                    fn ($query) => $query->whereRaw("unaccent(lower($key)) ILIKE ?", ["%$term%"])
                );
            }

            $builder->when(
                $key === 'category' && $value,
                fn ($query) => $query->whereHas('category', function ($query) use ($term) {
                    $query->whereRaw("unaccent(lower(name)) ILIKE ?", ["%$term%"]);
                })
            );
        }

        return NewsResource::collection($builder->paginate(10));
    }

    public function show(string|int $id): Response
    {
        return response(new NewsResource(News::find($id)), 200);
    }
}
