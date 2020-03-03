<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model\Config;

class Reader extends \Magento\Framework\Config\Reader\Filesystem
{
    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        \Mygento\Attribute\Model\Config\Converter $converter,
        \Mygento\Attribute\Model\Config\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        $fileName = 'attribute_schema.xml',
        $idAttributes = [
            '/config/entity/attribute' => 'code',
            '/config/entity/attribute_set/attribute' => 'code'
        ],
        $domDocumentClass = \Magento\Framework\Config\Dom::class,
        $defaultScope = 'global'
    ) {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope
        );
    }
}
