<?php
    
namespace Aonachandrew\Test\Model\Total;

class Warranty extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    protected $quoteValidator = null;
    protected $_warrantyRate  = null;
    
    protected $_code = 'warranty';
    
    protected $_helperData;
    
    protected $_checkoutSession;
    
    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Api\Data\PaymentInterface $payment,
        \Aonachandrew\Test\Helper\Data $helperData)
    {
        $this->quoteValidator = $quoteValidator;
        $this->_helperData = $helperData;
        $this->_checkoutSession = $checkoutSession;
    }
    
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        parent::collect($quote, $shippingAssignment, $total);
        
        if (!count($shippingAssignment->getItems())) {
            return $this;
        }
        $exist_amount = 0;
    
        $this->_warrantyRate = 0;
        $address = $shippingAssignment->getShipping()->getAddress();
        $items = $quote->getAllVisibleItems();
        
        foreach ($items as $item) {
            $warrantyRate = $item->getWarrantyRate();
            $this->_warrantyRate += $warrantyRate;
        }
      
        
        $balance = $this->_warrantyRate - $exist_amount;
        $address->setWarrantyRate($this->_warrantyRate);
        
        $quote->setWarrantyRate($this->_warrantyRate);
        
        $total->setTotalAmount('warranty_rate', $balance);
        $total->setBaseTotalAmount('base_warranty_rate', $balance);
        $total->setWarrantyRate($balance);
        $total->setBaseWarrantyRate($balance);
        $total->setGrandTotal($total->getGrandTotal() + $balance);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);
        
        
        return $this;
    }
    
    
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        return [
            'code'  => $this->getCode(),
            'title' => $this->getLabel(),
            'value' => $total->getWarrantyRate()
        ];
    }
    
    public function getLabel()
    {
        return __('Warranty');
    }
    
    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
        $total->setWarrantyRate(0);
        $total->setBaseWarrantyRate(0);
    }
}