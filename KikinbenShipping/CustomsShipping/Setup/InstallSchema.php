<?php


namespace KikinbenShipping\CustomsShipping\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_kikinbenshipping_customshipping = $setup->getConnection()->newTable($setup->getTable('kikinbenshipping_customshipping'));

        
        $table_kikinbenshipping_customshipping->addColumn(
            'customshipping_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_kikinbenshipping_customshipping->addColumn(
            'shippingrate',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['default' => 'shippingrate','identity' => true,'auto_increment' => true],
            'customshipping'
        );
        

        $setup->getConnection()->createTable($table_kikinbenshipping_customshipping);

        $setup->endSetup();
    }
}
