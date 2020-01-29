<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model\Config;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert config
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $groups = $source->getElementsByTagName('entity');
        $result = [];
        /** @var \DOMElement $group */
        foreach ($groups as $group) {
            $type = $group->getAttribute('type');
            if (!isset($result[$type])) {
                $result[$type] = [];
            }

            foreach ($group->getElementsByTagName('attribute') as $attr) {
                $code = $attr->getAttribute('code');
                if (!isset($result[$type][$code])) {
                    $result[$type][$code] = [];
                }

                foreach ($attr->getElementsByTagName('field') as $field) {
                    $result[$type][$code][$field->getAttribute('code')] = $field->getAttribute('value');
                }
            }
        }

        return $result;
    }
}
