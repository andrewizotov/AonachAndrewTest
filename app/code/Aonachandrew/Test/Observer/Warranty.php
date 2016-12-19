<?php
namespace Aonachandrew\Test\Observer;

class Warranty implements \Magento\Framework\Event\ObserverInterface
{
    protected $_request;
    protected $_helper;
    
    public function __construct(\Magento\Framework\App\RequestInterface $request,
        \Aonachandrew\Test\Helper\Data $aonachHelper
    )
    {
        $this->_helper = $aonachHelper;
        $this->_request = $request;
    }
    
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quoteItem = $observer->getQuoteItem();
        $params = $this->_request->getParams();
        if ($this->_request->getParam('warranty-rate') && $params['product'] == $quoteItem->getProductId()) {
            $warrantyTerm = $this->_request->getParam('warranty-rate');
            $quoteItem->setWarrantyTerm($warrantyTerm);
            $rate = $this->_helper->_getWarrantyRates($quoteItem->getProduct(), $warrantyTerm);
            $rate = $rate * $params['qty'];
            $quoteItem->setWarrantyRate($rate);
        }
    }
    
}