<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Model\Config;

class Converter implements \Mygento\Attribute\Api\ConverterInterface
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

            foreach ($group->getElementsByTagName(self::ATTR) as $attr) {
                $result = $this->parseAttribute($result, $attr, $type);
            }

            foreach ($group->getElementsByTagName(self::SET) as $set) {
                $result = $this->parseSet($result, $set, $type);
            }
        }

        return $result;
    }

    private function parseAttribute($result, $attr, $type)
    {
        $code = $attr->getAttribute('code');
        if (!isset($result[$type][self::ATTR][$code])) {
            $result[$type][self::ATTR][$code] = [];
        }

        foreach ($attr->getElementsByTagName('field') as $field) {
            $result[$type][self::ATTR][$code][$field->getAttribute('code')] =
                $field->getAttribute('value');
        }

        return $result;
    }

    private function parseSet($result, $set, $type)
    {
        $name = $set->getAttribute('name');
        if (!isset($result[$type][self::SET][$name])) {
            $result[$type][self::SET][$name] = [];
        }

        foreach ($set->getElementsByTagName('attribute') as $field) {
            $result[$type][self::SET][$name][] = $field->getAttribute('code');
        }

        return $result;
    }
}
