<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model\Config;

class Conventer implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert config
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $groups = $source->getElementsByTagName('group');

        /** @var \DOMElement $discount */
        foreach ($groups as $group) {
        }

        return [];
    }
}
