<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use App\Traits\Stringable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NewsController extends Controller
{
    use Stringable;

    public function __construct(private NewsService $service)
    {
    }

    public function index(Request $request)
    {
        $content = $this->service->index($request->all());

        return response($content);
    }

    public function show(News $news)
    {
        return new NewsResource($news);
    }
}
