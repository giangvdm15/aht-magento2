<?php
namespace GiangVu\Polls\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            // POLL ENTITY TABLE
            if (! $installer->tableExists('giangvu_poll_entity')) {
                $poll_entity_table = $installer->getConnection()
                    ->newTable($installer->getTable('giangvu_poll_entity'))
                    ->addColumn('poll_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ], 'Poll ID')
                    ->addColumn('poll_title', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [
                    'nullable => false'
                ], 'Poll Title')
                    ->addColumn('poll_content', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [
                    'nullable' => false
                ], 'Poll Content')
                    ->addColumn('status', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, [
                    'nullable' => false,
                    'default' => '0'
                ], 'Status')
                    ->addColumn('created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ], 'Created At')
                    ->addColumn('updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [
                    'nullable' => true
                ], 'Updated At')
                    ->setComment('Poll Table');
                $installer->getConnection()->createTable($poll_entity_table);

                $installer->getConnection()->addIndex($installer->getTable('giangvu_poll_entity'), $setup->getIdxName($installer->getTable('giangvu_poll_entity'), [
                    'poll_title',
                    'poll_content'
                ], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT), [
                    'poll_title',
                    'poll_content'
                ], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT);
            }
            // end of POLL ENTITY TABLE

            // ANSWER ENTITY TABLE
            if (! $installer->tableExists('giangvu_answer_entity')) {
                $answer_entity_table = $installer->getConnection()
                    ->newTable($installer->getTable('giangvu_answer_entity'))
                    ->addColumn('answer_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ], 'Answer ID')
                    ->addColumn('answer_content', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [
                    'nullable' => false
                ], 'Answer Content')
                    ->addColumn('created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ], 'Created At')
                    ->addColumn('updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [
                    'nullable' => true
                ], 'Updated At')
                    ->setComment('Poll Table');
                $installer->getConnection()->createTable($answer_entity_table);

                $installer->getConnection()->addIndex($installer->getTable('giangvu_answer_entity'), $setup->getIdxName($installer->getTable('giangvu_answer_entity'), [
                    'answer_content',
                ], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT), [
                    'answer_content',
                ], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT);
            }
            // end of ANSWER ENTITY TABLE

            // POLL-ANSWER TABLE
            if (! $installer->tableExists('giangvu_poll_answer')) {
                $poll_answer_table = $installer->getConnection()
                    ->newTable($installer->getTable('giangvu_poll_answer'))
                    ->addColumn('entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ], 'Entity ID')
                    ->addColumn('poll_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'nullable' => false,
                    'unsigned' => true
                ], 'Poll ID')
                    ->addColumn('answer_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'nullable' => false,
                    'unsigned' => true
                ], 'Answer ID')
                    ->addColumn('count', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'nullable' => false,
                    'unsigned' => true,
                    'default' => 0
                ], 'Count')
                    ->addForeignKey(
                        $installer->getFkName(
                            'giangvu_poll_answer',
                            'poll_id',
                            'giangvu_poll_entity',
                            'poll_id'
                        ),
                        'poll_id',
                        $installer->getTable('giangvu_poll_entity'),
                        'poll_id',
                        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->addForeignKey(
                        $installer->getFkName(
                            'giangvu_poll_answer',
                            'answer_id',
                            'giangvu_answer_entity',
                            'answer_id'
                        ),
                        'answer_id',
                        $installer->getTable('giangvu_answer_entity'),
                        'answer_id',
                        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->setComment('Poll-Answer Table');
                $installer->getConnection()->createTable($poll_answer_table);
            }
            // end of POLL-ANSWER TABLE
            
            // POLL-CUSTOMER TABLE
            if (! $installer->tableExists('giangvu_poll_customer')) {
                $poll_customer_table = $installer->getConnection()
                ->newTable($installer->getTable('giangvu_poll_customer'))
                ->addColumn('entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ], 'Entity ID')
                ->addColumn('poll_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'nullable' => false,
                    'unsigned' => true
                ], 'Poll ID')
                ->addColumn('customer_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'nullable' => false,
                    'unsigned' => true
                ], 'Customer ID')
                ->addColumn('answer_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'nullable' => false,
                    'unsigned' => true,
                ], 'Answer ID')
                ->addForeignKey(
                    $installer->getFkName(
                        'giangvu_poll_customer',
                        'poll_id',
                        'giangvu_poll_entity',
                        'poll_id'
                    ),
                    'poll_id',
                    $installer->getTable('giangvu_poll_entity'),
                    'poll_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'giangvu_poll_customer',
                        'customer_id',
                        'customer_entity',
                        'entity_id'
                    ),
                    'customer_id',
                    $installer->getTable('customer_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'giangvu_poll_customer',
                        'answer_id',
                        'giangvu_answer_entity',
                        'answer_id'
                    ),
                    'answer_id',
                    $installer->getTable('giangvu_answer_entity'),
                    'answer_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('Poll-Customer Table');
                $installer->getConnection()->createTable($poll_customer_table);
            }
            // end of POLL-CUSTOMER TABLE
        }

        $installer->endSetup();
    }
}