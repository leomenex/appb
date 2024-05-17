<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Traits\Stringable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NewsController extends Controller
{
    use Stringable;

    public function index(Request $request)
    {
        $query = News::query();

        foreach ($request->all() as $key => $value) {
            $term = $this->sanitize($value);

            if (Schema::hasColumn('news', $key)) {
                $query->when(
                    $value,
                    fn ($query) => $query->whereRaw("unaccent(lower($key)) ILIKE ?", ["%$term%"])
                );
            }

            $query->when(
                $key === 'category' && $value,
                fn ($query) => $query->whereHas('category', function ($query) use ($term) {
                    $query->whereRaw("unaccent(lower(name)) ILIKE ?", ["%$term%"]);
                })
            );
        }

        $paginator = $query->with('category')->paginate(1);

        return new NewsCollection($paginator);
    }

    public function show(News $news)
    {
        return new NewsResource($news);
    }
}
