<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TomatoCart Open Source Shopping Cart Solution
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License v3 (2007)
 * as published by the Free Software Foundation.
 *
 * @package		TomatoCart
 * @author		TomatoCart Dev Team
 * @copyright	Copyright (c) 2009 - 2012, TomatoCart. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html
 * @link		http://tomatocart.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Order Pdf Module Class
 *
 * This class is the parent class for all toc pdf classes
 *
 * @package		TomatoCart
 * @subpackage	tomatocart
 * @category	template-module-controller
 * @author		TomatoCart Dev Team
 * @link		http://tomatocart.com/wiki/
 */

//load the parent pdf module class
require_once('pdf_module.php');

class TOC_Order_Pdf extends TOC_Pdf_Module
{
	/**
	 * Constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct($orders_id)
	{
		parent::__construct($orders_id);
		
		//load the orders language definitions
		$this->CI->lang->ini_load('orders.php');
		
		log_message('debug', 'TOC Order Pdf Class Initialized');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set general information of order pdf
	 *
	 * @access protected
	 * @return void
	 */
	protected function set_general_info()
	{
		parent::set_general_info();
	
		$this->CI->pdf->SetTitle('Order');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set the header of order pdf
	 *
	 * @access protected
	 * @return void
	 */
	protected function set_header()
	{
		parent::set_header();
	
		//set head fields
		$fields = array(
						'titles' => array(
										lang('operation_heading_order_date'),
										lang('operation_heading_order_id')
						),
						'values' => array(
										mdate($this->CI->lang->get_date_format_short(), mysql_to_unix($this->CI->order->get_date_created())),
										$this->CI->order->get_order_id()
						)
		);
	
		$this->set_head_fields($fields);
	}
	
	/**
	 * Render the order pdf
	 *
	 * @access public
	 * @param boolean
	 * @return string
	 */
	public function render($return = TRUE)
	{
		parent::render();
		
		//return output pdf
		if ($return === TRUE)
		{
			return $this->CI->pdf->Output("Order", "S");
		}
		else
		{
			$this->CI->pdf->Output("Order", "I");
		}
	}
}

/* End of order_pdf.php */
/* Location: ./system/libraries/order_pdf.php */