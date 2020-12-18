<?php
namespace Vaimo\Giftcard\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'giftcard_data'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('giftcard_data'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'ID'
            )
            ->addColumn(
                'order_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'order_id'
            )->addColumn(
                'receiver_mail',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'receiver_mail'
            )->addColumn(
                'giftcard_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'giftcard_code'
            )->setComment("giftcard data table");
        $setup->getConnection()->createTable($table);
    }

//    /**
//     * {@inheritdoc}
//     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
//     */
//    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
//    {
//        $setup->startSetup();
//
//        $setup->getConnection()->addColumn(
//            $setup->getTable('quote_payment'),
//            'receiver_mail',
//            [
//                'type' => 'text',
//                'nullable' => true  ,
//                'comment' => 'Receiver mail',
//            ]
//        );
//        $setup->getConnection()->addColumn(
//            $setup->getTable('sales_order_payment'),
//            'receiver_mail',
//            [
//                'type' => 'text',
//                'nullable' => true  ,
//                'comment' => 'Receiver mail',
//            ]
//        );
//
//        $setup->endSetup();
//    }
}
