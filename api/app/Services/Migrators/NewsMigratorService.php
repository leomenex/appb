<?php

namespace App\Services\Migrators;

use App\Core\AbstractDataMigrator;
use App\Enums\AppExternal;
use App\Models\News;
use App\Models\NewsCategory;

class NewsMigratorService extends AbstractDataMigrator
{
    public function __construct()
    {
        $this->appExternal = AppExternal::PORTAL_PMBV;
    }

    /**
     * @override
     */
    public function import(): void
    {
        $params = [
            'token' => 'JzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6Ikpva',
        ];

        $data = $this->execute(
            method: 'get',
            endpoint: 'api/noticias',
            params: $params
        );

        foreach ($data['noticias'] as $item) {
            dump("importando noticia {$item['id']}");
            if (empty($item['categoria_id']) || empty($item['categoria'])) {
                continue;
            }

            $this->updateOrCreate($item);
        }
    }

    public function updateOrCreate(array $data): News
    {
        $category = NewsCategory::updateOrCreate(
            [
                'external_id' => $data['categoria']['id']
            ],
            [
                'name' => $data['categoria']['nome'],
                'description' => $data['categoria']['descricao'],
                'sort_order' => $data['categoria']['ordem'],
                'color' => $data['categoria']['cor'],
                'text_color' => $data['categoria']['cor_texto'],
                'status' => $data['categoria']['status'],
            ]
        );

        $news = News::updateOrCreate(
            [
                'external_id' => $data['id'],
            ],
            [
                'category_id' => $category?->id ?? $data['categoria_id'],
                'title' => $data['titulo'],
                'description' => $data['resumo'],
                'content' => $data['corpo'],
                'slug' => $data['slug'],
                'show_in_slide' => $data['exibir_slide'],
                'path_image' => $this->appExternal->getBaseURL() . '/storage' . $data['imagem'],
                'path_image_thumbnail' => $this->appExternal->getBaseURL() . '/storage' . $data['thumb'],
                'is_published' => strtolower($data['status']) === 'ativo' ? true : false,
                'date_published' => $data['data_publicacao'],
                'start_time' => $data['data_inicio_exibicao'],
                'end_time' => $data['data_fim_exibicao'],
                'external_created_at' => $data['created_at'],
                'external_updated_at' => $data['updated_at'],
            ]
        );

        return $news->refresh();
    }
}
