<?php
namespace GiangVu\CustomerActivation\Setup;
 
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * EAV setup factory.
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * @var Config
     */
    protected $_eavConfig;
    
    protected $_attributeSetFactory;
 
    /**
     * InstallData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param Config $eavConfig
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->_eavConfig = $eavConfig;
        $this->_attributeSetFactory = $attributeSetFactory;
    }
 
    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            // Add Activated attribute to Customer
            
            $customerEntity = $this->_eavConfig->getEntityType('customer');
            $attributeSetId = $customerEntity->getDefaultAttributeSetId();
            /** @var $attributeSet AttributeSet */
            $attributeSet = $this->_attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
            
            $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                Customer::ENTITY,
                'customer_activated',
                [
                    'type'              => 'int',
                    'label'             => 'Customer Activated',
                    'input'             => 'select',
                    'source'            => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'default'           => 0,
                    'required'          => true,
                    'visible'           => true,
                    'user_defined'      => true,
                    'position'          => 100,
                    'global'            => \Magento\Customer\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                    'group'             => 'Account Information',
                    'system'            => 0,
                    'filterable'        => true,
                    'comparable'        => false,
                    'unique'            => false,
                    'is_used_in_grid'   => true,
                    'is_visible_in_grid'=> true,
                ]
            );

            $eavSetup->addAttributeToSet(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
                null,
                'customer_activated'
            );

            $attribute = $this->_eavConfig->getAttribute(
                Customer::ENTITY,
                'customer_activated'
            );
            $attribute->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer'],
            ]);
            $attribute->save();

        }
    }
}