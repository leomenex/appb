<?php

namespace App\Services;

use App\Enums\AppExternal;
use Illuminate\Support\Facades\Http;

class NewsService
{
    private string $baseURL;
    private string $token = 'JzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6Ikpva';

    /**
     * requisicao a api de noticias do portal boavista
     * translate das keys dos dados para request e response
     */
    public function __construct()
    {
        $this->baseURL = AppExternal::PORTAL_PMBV->getBaseURL();
    }

    public function index(array $filters): array
    {
        $response = Http::get(
            "{$this->baseURL}/api/noticias",
            array_merge(
                $this->translateKeys($filters),
                ['token' => $this->token]
            )
        );

        if ($response->failed()) {
            return [];
        }

        $result = [];
        foreach ($response->json()['noticias']['data'] as $key => $news) {
            $result[] = $this->serialize($news);
        }

        return [
            ...$response->json()['noticias'],
            'data' => $result
        ];
    }

    private function serialize(array $data)
    {
        $baseUrlStorage = "{$this->baseURL}/storage";
        return [
            'id' => $data['id'],
            'category_id' => $data['categoria_id'],
            'title' => $data['titulo'],
            'description' => $data['resumo'],
            'content' => $data['corpo'],
            'slug' => $data['slug'],
            'show_in_slide' => $data['exibir_slide'],
            'path_image' => $baseUrlStorage . $data['imagem'],
            'path_image_thumbnail' => $baseUrlStorage . $data['thumb'],
            'is_published' => strtolower($data['status']) === 'ativo' ? true : false,
            'date_published' => $data['data_publicacao'],
            'start_time' => $data['data_inicio_exibicao'],
            'end_time' => $data['data_fim_exibicao'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
            'category' => [
                'id' => $data['categoria']['id'],
                'name' => $data['categoria']['nome'],
                'description' => $data['categoria']['descricao'],
                'sort_order' => $data['categoria']['ordem'],
                'color' => $data['categoria']['cor'],
                'text_color' => $data['categoria']['cor_texto'],
                'status' => $data['categoria']['status'],
            ]
        ];
    }

    private function translateKeys(array $filters): array
    {
        $translate = [
            'category_id' => 'categoria_id',
            'title' => 'titulo',
            'description' => 'resumo',
            'content' => 'corpo',
            'slug' => 'slug',
            'show_in_slide' => 'exibir_slide',
            'path_image' => 'imagem',
            'path_image_thumbnail' => 'thumb',
            'is_published' => 'status',
            'date_published' => 'data_publicacao',
            'start_time' => 'data_inicio_exibicao',
            'end_time' => 'data_fim_exibicao'
        ];

        $newFilters = [];
        foreach ($filters as $key => $value) {
            if (array_key_exists($key, $translate)) {
                $newFilters[$translate[$key]] = $value;
            }
        }

        return $newFilters;
    }
}
