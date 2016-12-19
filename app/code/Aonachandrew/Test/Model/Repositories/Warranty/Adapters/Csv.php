<?php

namespace Aonachandrew\Test\Model\Repositories\Warranty\Adapters;

class Csv
{
     protected $_file;
     protected $_aonachHelper = null;
     protected $_data = array();
    
    
     public function __construct(String $path, \Aonachandrew\Test\Helper\Data $aonachHelper)
     {
        $this->_file = $path;
        $this->_aonachHelper = $aonachHelper;
        $this->_process();
     }
     
     protected function _process()
     {
         $file = new \Magento\Framework\Filesystem\Driver\File();
         $fileObj = new \Magento\Framework\File\Csv($file);
         $this->_data = $fileObj->getData($this->_aonachHelper->getPathToWarrantyRates().'/'.$this->_file);
     }
     
     public function  getData()
     {
         return $this->_data;
     }
}