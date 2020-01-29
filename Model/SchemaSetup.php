<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model;

use Magento\Framework\Exception\LocalizedException;

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
        $products = $this->data->get('catalog_product');

        foreach ($products as $key => $params) {
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
}
