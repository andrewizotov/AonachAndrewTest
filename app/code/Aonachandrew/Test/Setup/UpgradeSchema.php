<?php
namespace Aonachandrew\Test\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        
        if (version_compare($context->getVersion(), '1.0.1') < 0)
        {
            $quoteAddressTable = 'quote_address';
            $quoteTable = 'quote';
            $orderTable = 'sales_order';
            $orderItemTable = 'sales_order_item';
            $quoteItemTable = 'quote_item';
            $invoiceTable = 'sales_invoice';
            $creditmemoTable = 'sales_creditmemo';
            // Address tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteAddressTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteAddressTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Base Warranty Amount'
                    ]
                );
            //Order tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Base Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderTable),
                    'warranty_rate_refunded',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderTable),
                    'base_warranty_rate_refunded',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderTable),
                    'warranty_rate_invoiced',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                        
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderTable),
                    'base_warranty_rate_invoiced',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            //Quote Item Table
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteItemTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteItemTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Base Warranty Amount'
                    ]
                );
            
            //Order Item tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Base Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'warranty_rate_refunded',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'base_warranty_rate_refunded',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'warranty_rate_invoiced',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'base_warranty_rate_invoiced',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            //Quote tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Base Warranty Amount'
                    ]
                );
            
            //Invoice tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($invoiceTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($invoiceTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Base Fee Amount'
                    ]
                );
            //Credit memo tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($creditmemoTable),
                    'warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($creditmemoTable),
                    'base_warranty_rate',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '10,2',
                        'default'  => 0.00,
                        'nullable' => true,
                        'comment'  => 'Warranty Amount'
                    ]
                );
        }
        
        
        
        $setup->endSetup();
    
    
    
        $setup->startSetup();
    
        if (version_compare($context->getVersion(), '1.0.2') < 0)
        {
            $orderItemTable = 'sales_order_item';
            $quoteItemTable = 'quote_item';
            $invoiceTable = 'sales_invoice';
           
            //Quote Item Table
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($quoteItemTable),
                    'warranty_term',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        'default'  => 0,
                        'nullable' => true,
                        'comment'  => 'Warranty Term'
                    ]
                );
       
            //Order Item tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($orderItemTable),
                    'warranty_term',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        'default'  => 0,
                        'nullable' => true,
                        'comment'  => 'Warranty Term'
                    ]
                );
            
            //Invoice tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($invoiceTable),
                    'warranty_term',
                    [
                        'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        'default'  => 0,
                        'nullable' => true,
                        'comment'  => 'Warranty Term'
                    ]
                );
        }
   
        $setup->endSetup();
    }
}
