<?php
    namespace Aonachandrew\Test\Observer;
    use Magento\Framework\Event\Observer as EventObserver;
    use Magento\Framework\Event\ObserverInterface;
    
    class AddWarrantyToOrder implements ObserverInterface
    {
        /**
         * @var \Magento\Checkout\Model\Session
         */
        protected $_checkoutSession;
    
        public function __construct(
            \Magento\Checkout\Model\Session $checkoutSession
        )
        {
            $this->_checkoutSession = $checkoutSession;
        }
        
        public function execute(\Magento\Framework\Event\Observer $observer)
        {
            $this->order = $observer->getOrder();
            $this->quote = $observer->getQuote();
            
            $sumWarrantyRate = 0;
           
            foreach($this->order->getItems() as $orderItem){
                $quoteItem = $this->getQuoteItemById($orderItem->getQuoteItemId());
                $orderItem->setWarrantyRate($quoteItem->getWarrantyRate());
                $orderItem->setBaseWarrantyRate($quoteItem->getWarrantyRate());
                $sumWarrantyRate += $quoteItem->getWarrantyRate();
                $orderItem->setWarrantyTerm($quoteItem->getWarrantyTerm());
            }
            
            $this->quote->setWarrantyRate($sumWarrantyRate);
            $this->quote->setBaseWarrantyRate($sumWarrantyRate);
            $this->order->setWarrantyRate($sumWarrantyRate);
            $this->order->setBaseWarrantyRate($sumWarrantyRate);
            $this->order->setWarrantyRate($sumWarrantyRate);
            $this->order->setBaseWarrantyRate($sumWarrantyRate);
            
            return $this;
        }
    
        private function getQuoteItemById($id){
            if(empty($this->quoteItems)){
                /* @var  \Magento\Quote\Model\Quote\Item $item */
                foreach($this->quote->getItems() as $item){
                        $this->quoteItems[$item->getId()] = $item;
                }
            }
        
            if(array_key_exists($id, $this->quoteItems)){
                return $this->quoteItems[$id];
            }
        
            return null;
        }
    }