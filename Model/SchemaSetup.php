<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model;

use Magento\Catalog\Setup\CategorySetup;
use Magento\Framework\Exception\LocalizedException;
use Mygento\Attribute\Api\ConverterInterface;

class SchemaSetup
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Mygento\Attribute\Model\Config\SchemaConfig
     */
    private $data;

    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Mygento\Attribute\Model\Config\SchemaConfig $data,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->data = $data;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->logger = $logger;
    }

    public function update()
    {
        $eavSetup = $this->eavSetupFactory->create();
        $products = $this->data->get('catalog_product') ?? [];

        if (isset($products[ConverterInterface::ATTR])
            && !empty($products[ConverterInterface::ATTR])) {
            $this->createAttributes($eavSetup, $products[ConverterInterface::ATTR]);
        }

        if (isset($products[ConverterInterface::SET])
            && !empty($products[ConverterInterface::SET])) {
            $this->createAttributeSets($eavSetup, $products[ConverterInterface::SET]);
        }
    }

    private function createAttributes(\Magento\Eav\Setup\EavSetup $eavSetup, array $config)
    {
        foreach ($config as $key => $params) {
            $params['user_defined'] = $params['user_defined'] ?? 1;

            try {
                $eavSetup->addAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $key,
                    $params
                );
            } catch (LocalizedException $e) {
                echo $e->getMessage();
                $this->logger->error($e->getMessage(), ['exception' => $e]);
            }
        }
    }

    private function createAttributeSets(\Magento\Eav\Setup\EavSetup $eavSetup, array $config)
    {
        $entity = CategorySetup::CATALOG_PRODUCT_ENTITY_TYPE_ID;
        foreach ($config as $set => $list) {
            if (!$eavSetup->getAttributeSet($entity, $set)) {
                $eavSetup->addAttributeSet($entity, $set);
            }
            $setId = $eavSetup->getAttributeSet($entity, $set, 'attribute_set_id');
            foreach ($list as $code) {
                $eavSetup->addAttributeToSet($entity, $setId, 'General', $code);
            }
        }
    }
}
