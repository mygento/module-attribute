<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model\Config;

class SchemaConfig extends \Magento\Framework\Config\Data
{
    public function __construct(
        \Mygento\Attribute\Model\Config\Reader $reader,
        \Magento\Framework\Config\CacheInterface $cache,
        $cacheId = 'attribute_schema_config',
        \Magento\Framework\Serialize\SerializerInterface $serializer = null
    ) {
        parent::__construct($reader, $cache, $cacheId, $serializer);
    }
}
