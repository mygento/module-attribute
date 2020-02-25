<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Api;

interface ConverterInterface extends \Magento\Framework\Config\ConverterInterface
{
    const ATTR = 'attribute';
    const SET = 'attribute_set';
}
