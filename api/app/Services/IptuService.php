<?php

namespace App\Services;

use App\Enums\AppExternal;
use Illuminate\Http\Client\Response as HttpResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class IptuService
{
    private string $baseURL;
    private string $cacheKeyAccessToken = 'iptu_access_token';
    private string $token;

    /**
     * integracao de iptu com adm tributos
     * O Swagger para desenvolvimento está em https://desenv-api.admsistemas.srv.br/index.html
     * O Swagger de produção da API é o https://api.admsistemas.srv.br/index.html
     */
    public function __construct()
    {
        $this->baseURL = AppExternal::SAATRI->getDevelopBaseURL();

        if (in_array(env('APP_ENV'), ['prod', 'production'])) {
            $this->baseURL = AppExternal::SAATRI->getBaseURL();
        }

        $this->token = $this->authenticate();
    }

    public function authenticate(?bool $refreshToken = false): string
    {
        if (Cache::has($this->cacheKeyAccessToken) && !$refreshToken) {
            return json_decode(Cache::get($this->cacheKeyAccessToken))->accessToken;
        }

        Artisan::call('optimize:clear');

        $params = [
            "host" => env('IPTU_PMBV_HOST'),
            "login" => env('IPTU_PMBV_LOGIN'),
            "password" => env('IPTU_PMBV_PASSWORD')
        ];

        $response = Http::post("{$this->baseURL}/accessToken", $params);

        if ($response->failed()) {
            return '';
        }

        Cache::put(
            key: $this->cacheKeyAccessToken,
            value: json_encode([
                'userId' => $response->json()['userId'],
                'accessToken' => $response->json()['accessToken'],
                'refreshToken' => $response->json()['refreshToken'],
            ], true),
            ttl: now()->addHours(24)
        );

        return $response->json()['accessToken'];
    }

    public function getProperties(array $params = []): array
    {
        $params = array_merge([
            'limit' => 10,
            'page' => isset($params['page']) ? $params['page'] : 1
        ], $params);

        $url = "{$this->baseURL}/tributos/v1/imoveis";

        $response = Http::withHeader('Authorization', "Bearer {$this->token}")
            ->get($url, $params);

        if ($response->failed()) {

            return [];
        }

        return $response->json()['results'];
    }

    public function getIptus(string $property_id): array
    {
        $response = Http::withHeader('Authorization', "Bearer {$this->token}")
            ->get("{$this->baseURL}/tributos/v1/imoveis/$property_id/iptus");

        if ($response->failed()) {
            return [];
        }

        return $response->json();
    }

    public function iptuBillet(string $url): string
    {
        $response = Http::withHeader('Authorization', "Bearer {$this->token}")->get($url);

        if ($response->failed()) {
            return '';
        }

        return $response->json();
    }

    private function handleUnauthenticatedError(
        string $url,
        string $method,
        ?array $params = [],
        int $statusCode
    ): HttpResponse|null {

        if ($statusCode !== Response::HTTP_UNAUTHORIZED) {
            return null;
        }

        $this->token = $this->authenticate(refreshToken: true);

        return Http::withHeader('Authorization', "Bearer {$this->token}")
            ->$method($url, $params);
    }
}
