<?php

namespace Aonachandrew\Test\Helper;

use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_pathToWarrantyRates = null;
    
    protected $_fileTemplateName = 'warranty_';
    
    protected $_ext = '.csv';
    
    protected $_data = null;
    
    public function __construct(Context $context,\Magento\Framework\App\Filesystem\DirectoryList $directories)
    {
        $this->_directories = $directories;
        $this->_pathToWarrantyRates = $this->_directories->getPath('var');
        parent::__construct($context);
    }
    
    public function getFileExt()
    {
        return $this->_ext;
    }
    
    
    public function getTemplateNameWarranty()
    {
        return $this->_fileTemplateName;
    }
    
    public function getPathToWarrantyRates()
    {
        if ($this->_pathToWarrantyRates !== null) {
            return $this->_pathToWarrantyRates;
        }
        
        return false;
    }
    
    protected function _loadRatesByCategoryId($catIds)
    {
        if( null == $this->_data ) {
            foreach ($catIds as $id) {
                if (file_exists($this->getPathToWarrantyRates() . '/' . $this->getTemplateNameWarranty() . $id . $this->getFileExt())) {
                    $csv = new \Aonachandrew\Test\Model\Repositories\Warranty\Adapters\Csv(
                        $this->getTemplateNameWarranty() . $id . $this->getFileExt(),
                        $this
                    );
                    $this->_data = $csv->getData();
                    break;
                }
            }
        }
        
        return $this->_data;
    }
    
    /**
     *
     *  Get Warranty Rate by Product and Term
     */
    public function _getWarrantyRates($product, $termWarranty)
    {
        $categoryIds = $product->getCategoryIds();
        $productPrice = $product->getPrice();
        
        if (null == $this->_loadRatesByCategoryId($categoryIds)) {
            return false;
        }
        
        $warrantyPrice = null;
        for ($i=1; $i < count($this->_data); $i++){
            $year = (int)$this->_data[$i][0];
            $from = (float)$this->_data[$i][1];
            $to   = (float)$this->_data[$i][2];
            $warrantyPrice = (float)$this->_data[$i][3];
            if ($termWarranty == $year) {
                if ($to > 0) {
                    if ($productPrice > $from && $productPrice <= $to) {
                        return $warrantyPrice;
                    }
                } else {
                    if ($productPrice > $from) {
                        return $warrantyPrice;
                    }
                }
            }
        }
        
        return false;
    }
    
    
    public function getWarrantyDropdownOptions($productPrice, $data)
    {
        $warrantyPrice = null;
        $strOptions = "";
        
        for ($i=1; $i < count($data); $i++){
            $year = (int)$data[$i][0];
            $from = (float)$data[$i][1];
            $to   = (float)$data[$i][2];
            $warrantyPrice = (float)$data[$i][3];
            
            if ($to > 0) {
                if ($productPrice > $from && $productPrice <= $to) {
                    $strOptions .= "<option value='$year'>$year year {$warrantyPrice}</option>";
                }
            } else {
                if ($productPrice > $from ) {
                    $strOptions .= "<option value='$year'>$year year {$warrantyPrice}</option>";
                }
            }
        }
       
        return $strOptions;
    }
}