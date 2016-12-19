<?php
    
namespace Aonachandrew\Test\Block\Product;


class View extends \Magento\Catalog\Block\Product\View
{
    protected $_aonachHelper = null;
    
    public function __construct(\Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        array $data = [],
        \Aonachandrew\Test\Helper\Data $aonachHelper
    ){
        $this->_aonachHelper = $aonachHelper;
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }
    
    public function getWarrantyOptions()
    {
        $price = $this->getProduct()->getPrice();
        $categoryIds = $this->getProduct()->getCategoryIds();
        $data = null;
        
        foreach ($categoryIds as $id){
            if (file_exists(
                $this->_aonachHelper->getPathToWarrantyRates().
                '/'.
                $this->_aonachHelper->getTemplateNameWarranty().
                $id.$this->_aonachHelper->getFileExt())
            ) {
                $csv = new \Aonachandrew\Test\Model\Repositories\Warranty\Adapters\Csv(
                    $this->_aonachHelper->getTemplateNameWarranty().$id.$this->_aonachHelper->getFileExt(),
                    $this->_aonachHelper
                );
                $data = $csv->getData();
                break;
            }
        }
       
        if (null != $data) {
           return $this->_aonachHelper->getWarrantyDropdownOptions($price, $data);
        }
        
        return false;
    }
    
    
    
    protected function _toHtml()
    {
        $this->setModuleName($this->extractModuleName('Magento\Catalog\Block\Product\View'));
        return parent::_toHtml();
    }
}