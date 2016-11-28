<?php
/**
 * DecryptWeb OrderProfit Extension
 *
 * This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @category    DW
 * @package     DW_OrderProfit
 * @copyright   Copyright (c) 2013 DecryptWeb (http://www.decryptweb.com) All Rights Reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html  GNU/GPL
 */

class DW_OrderProfit_Block_Adminhtml_Sales_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{		  
 	protected function _prepareColumns()
    {	
       	//below code for showing profit 
       	//start
		$active = Mage::getStoreConfig('dw_orderprofit/default/active'); 
		if($active)
		{
			$columnName = Mage::getStoreConfig('dw_orderprofit/default/colname');
			$this->addColumnAfter('base_profit', array(
				'header' => Mage::helper('sales')->__($columnName),
				'index' => 'entity_id',
				'type'  => 'currency',
				'currency' => 'order_currency_code',
				'filter'    => false,
				'sortable'  => false,            
				'is_system' => false,
				'renderer'  => new DW_OrderProfit_Block_Adminhtml_Sales_Order_Renderer_Profit() //for the value
			), 'grand_total');        
		}
		//end
		
		return parent::_prepareColumns();
  	}    
}