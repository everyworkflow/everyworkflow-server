<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\PageBundle\Migration;

use EveryWorkflow\EavBundle\Document\EntityDocument;
use EveryWorkflow\EavBundle\Repository\AttributeRepositoryInterface;
use EveryWorkflow\EavBundle\Repository\EntityRepositoryInterface;
use EveryWorkflow\MongoBundle\Support\MigrationInterface;
use EveryWorkflow\PageBundle\Entity\PageEntity;
use EveryWorkflow\PageBundle\Repository\PageRepositoryInterface;

class Mongo_2021_01_03_02_00_00_Page_Migration implements MigrationInterface
{
    public function __construct(
        protected EntityRepositoryInterface $entityRepository,
        protected AttributeRepositoryInterface $attributeRepository,
        protected PageRepositoryInterface $pageRepository
    ) {
    }

    public function migrate(): bool
    {
        /** @var EntityDocument $pageEntity */
        $pageEntity = $this->entityRepository->create();
        $pageEntity
            ->setName('Page')
            ->setCode($this->pageRepository->getEntityCode())
            ->setClass(PageEntity::class)
            ->setStatus(EntityDocument::STATUS_ENABLE);
        $this->entityRepository->saveOne($pageEntity);

        $attributeData = [
            [
                'code' => 'title',
                'name' => 'Title',
                'entity_code' => $this->pageRepository->getEntityCode(),
                'type' => 'text_attribute',
                'is_used_in_grid' => true,
                'is_used_in_form' => true,
                'is_required' => true,
                'sort_order' => 10,
            ],
            [
                'code' => 'url_path',
                'name' => 'Url path',
                'entity_code' => $this->pageRepository->getEntityCode(),
                'type' => 'text_attribute',
                'is_used_in_grid' => true,
                'is_used_in_form' => true,
                'is_required' => true,
                'sort_order' => 20,
            ],
            [
                'code' => 'meta_title',
                'name' => 'Meta title',
                'entity_code' => $this->pageRepository->getEntityCode(),
                'type' => 'text_attribute',
                'is_used_in_form' => true,
                'is_required' => false,
                'sort_order' => 9000,
            ],
            [
                'code' => 'meta_description',
                'name' => 'Meta description',
                'entity_code' => $this->pageRepository->getEntityCode(),
                'type' => 'long_text_attribute',
                'is_used_in_form' => true,
                'is_required' => false,
                'sort_order' => 9101,
            ],
            [
                'code' => 'meta_keyword',
                'name' => 'Meta keyword',
                'entity_code' => $this->pageRepository->getEntityCode(),
                'type' => 'long_text_attribute',
                'is_used_in_form' => true,
                'is_required' => false,
                'sort_order' => 9102,
            ],
        ];

        foreach ($attributeData as $item) {
            $item['status'] = 'enable';
            $attribute = $this->attributeRepository->create($item);
            $this->attributeRepository->saveOne($attribute);
        }

        return self::SUCCESS;
    }

    public function rollback(): bool
    {
        $this->attributeRepository->deleteByFilter(['entity_code' => $this->pageRepository->getEntityCode()]);
        $this->entityRepository->deleteByCode($this->pageRepository->getEntityCode());
        $this->pageRepository->getCollection()->drop();

        return self::SUCCESS;
    }
}
