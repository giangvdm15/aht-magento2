<?php
namespace GiangVu\CategoryThumbnail\Setup;

use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * EAV setup factory.
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;
    
    /**
     * @var CategorySetupFactory
     */
    protected $categorySetupFactory;
    
    /**
     * InstallData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
            $this->_eavSetupFactory = $eavSetupFactory;
            $this->categorySetupFactory = $categorySetupFactory;
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
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            /** @var EavSetup $eavSetup */
            $setup = $this->categorySetupFactory->create(['setup' => $setup]);
            $setup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY, 'thumbnail_image', [
                    'type' => 'varchar',
                    'label' => 'Thumbnail Image',
                    'input' => 'image',
                    'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                    'required' => false,
                    'sort_order' => 9,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'General Information',
                ]
            );
            $setup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY, 'test_attribute', [
                    'type' => 'varchar',
                    'label' => 'Test Thumbnail Image (Don\'t use this!)',
                    'input' => 'image',
                    'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                    'required' => false,
                    'sort_order' => 9,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'General Information',
                ]
            );
        }
    }
}