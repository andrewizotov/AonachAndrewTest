<?php
    
namespace Aonachandrew\Test\Block\Sales\Order\Item\Renderer;
/**
 * Order item render block
 */
class DefaultRenderer extends \Magento\Sales\Block\Order\Item\Renderer\DefaultRenderer
{
    protected $_helper;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Model\Product\OptionFactory $productOptionFactory,
        \Magento\Framework\Pricing\Helper\Data $helperPrice,
        array $data = []
    ) {
        $this->_helper = $helperPrice;
        
        parent::__construct($context,$string,$productOptionFactory,$data);
    }
    
     public function getLabelForWarranty()
     {
         $item = $this->getItem();
         if ($item->getWarrantyRate() > 0) {
             $warrantyRate = $this->_helper
                 ->currency(number_format($item->getWarrantyRate(),2),true,false);
             return '( Warranty ' . $item->getWarrantyTerm() . ' year ' . $warrantyRate . ' ) ';
         }
     }
}
