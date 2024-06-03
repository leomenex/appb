<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\IptuService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IptuController extends Controller
{
    public function __construct(private IptuService $service)
    {
    }

    public function properties(Request $request): Response
    {
        $request->validate([
            'cpfCnpj' => 'required|string',
        ]);

        $content = $this->service->getProperties($request->all());

        return response($content);
    }

    public function iptus(Request $request, string $property_id): Response
    {
        $content = $this->service->getIptus($property_id);

        return response($content);
    }

    public function iptuBillet(Request $request): Response
    {
        $request->validate(['url' => 'required|string']);

        $content = $this->service->iptuBillet($request->url);

        return response(['url' => $content]);
    }
}
