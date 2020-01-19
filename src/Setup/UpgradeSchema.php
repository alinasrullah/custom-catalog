<?php


namespace AlTayerIns\CustomCatalog\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    const CATALOG_TABLE_NAME = "altayerins_customcatalog_entity";

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), "1.0.0", "<")) {
            $setup->startSetup();
            $setup->getConnection()->addIndex(
                $setup->getTable(self::CATALOG_TABLE_NAME),
                $setup->getIdxName(
                    $setup->getTable(self::CATALOG_TABLE_NAME),
                    'product_id',
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                'product_id',
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            );
            $setup->endSetup();
        }
    }
}
