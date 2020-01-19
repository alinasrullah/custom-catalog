<?php


namespace AlTayerIns\CustomCatalog\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    const CATALOG_TABLE_NAME = "altayerins_customcatalog_entity";

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {

        $setup->startSetup();

        if (!$setup->tableExists(self::CATALOG_TABLE_NAME)) {
            $table_altayerins_customcatalog_entity = $setup->getConnection()->newTable($setup->getTable(self::CATALOG_TABLE_NAME));

            $table_altayerins_customcatalog_entity->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true,],
                'Entity ID'
            );

            $table_altayerins_customcatalog_entity->addColumn(
                'copywrite_info',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'CopyWriteInfo'
            );

            $table_altayerins_customcatalog_entity->addColumn(
                'product_vpn',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'VPN Of the Product'
            );

            $table_altayerins_customcatalog_entity->addColumn(
                'product_sku',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'SKU of the Product'
            );

            $table_altayerins_customcatalog_entity->addColumn(
                'product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Product ID'
            );

            $setup->getConnection()->createTable($table_altayerins_customcatalog_entity);

            $setup->getConnection()->addIndex(
                $setup->getTable(self::CATALOG_TABLE_NAME),
                $setup->getIdxName(
                    $setup->getTable(self::CATALOG_TABLE_NAME),
                    ['product_id', 'product_sku', 'copywrite_info', 'product_vpn'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['product_id', 'product_sku', 'copywrite_info', 'product_vpn'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $setup->endSetup();
    }
}
