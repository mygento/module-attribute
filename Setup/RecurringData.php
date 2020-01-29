<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Attribute
 */

namespace Mygento\Attribute\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class RecurringData implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     * @var \Mygento\Attribute\Model\SchemaSetup
     */
    private $schema;

    public function __construct(\Mygento\Attribute\Model\SchemaSetup $schema)
    {
        $this->schema = $schema;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->schema->update();
    }
}
