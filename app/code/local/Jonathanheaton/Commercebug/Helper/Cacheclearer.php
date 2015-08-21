<?php
	class Jonathanheaton_Commercebug_Helper_Cacheclearer
	{
		public function clearCache()
		{			
			Mage::app()->cleanCache();
		}
	}