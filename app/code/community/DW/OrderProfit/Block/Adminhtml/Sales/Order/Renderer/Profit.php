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

class DW_OrderProfit_Block_Adminhtml_Sales_Order_Renderer_Profit extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
    	$order_id = $row->getId();
         
		if(!empty($order_id))
		{	
			$sales_model = Mage::getModel('sales/order')->load($order_id);
			$subtotal = $sales_model->getSubtotal();//get order subtotal (without shipping)			
			$items = $sales_model->getAllItems(); //get all order items
        	$base_cost = array();
        	if(!empty($items))
        	{        		
				foreach ($items as $itemId => $item)
				{				
					$qty = intval($item->getQtyOrdered()); //get items quantity
					if(empty($qty))
					{
						$qty = 1;
					}
					$b_cost = $item->getBaseCost();//get item cost					
					$base_cost[] = ($b_cost*$qty); //get all items cost
				}
        	}
        	$total_order_cost = '';
        	if(!empty($base_cost))
        	{
        		$total_order_cost = array_sum($base_cost); //get sum of all items cost
        	}
        	$profit = '';
        	if(!empty($total_order_cost))
        	{
        		$profit = ($subtotal-$total_order_cost); //get profit , subtraction of order subtotal 
        	}
        	
        	$_coreHelper = Mage::helper('core');			
			$profit = $_coreHelper->currency($profit);
	
			return strip_tags($profit);
		}else
		{
			return '';
		}
		
    }
}