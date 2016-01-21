<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency
	{
		var $id      		= "VNĐ";		// string ID related with the currency (ex : language)
		var $symbol    		= "VNĐ";	// Printable symbol
		var $nbDecimal 		= 2;	// Number of decimals past colon (or other)
		var $decimal   		= ".";	// Decimal symbol ('.', ',', ...)
		var $thousands 		= " "; 	// Thousands separator ('', ' ', ',')
		var $positivePos	= 1;	// Currency symbol position with Positive values :
									// 0 = '00Symb'
									// 1 = '00 Symb'
									// 2 = 'Symb00'
									// 3 = 'Symb 00' 
		var $negativePos	= 8;	// Currency symbol position with Negative values :
									// 0 = '(Symb00)'
									// 1 = '-Symb00'
									// 2 = 'Symb-00'
									// 3 = 'Symb00-'
									// 4 = '(00Symb)'
									// 5 = '-00Symb'
									// 6 = '00-Symb'
									// 7 = '00Symb-'
									// 8 = '-00 Symb'
									// 9 = '-Symb 00'
									// 10 = '00 Symb-'
									// 11 = 'Symb 00-'
									// 12 = 'Symb -00'
									// 13 = '00- Symb'
									// 14 = '(Symb 00)'
									// 15 = '(00 Symb)'
	// ================		 
	function Currency(	
								//$id			="euro",
								//$symbol		="&euro;",
								$id			="VNĐ",
								$symbol		="VNĐ",
								$nbDecimal	= 2,
								$decimal   	= ".",
								$thousands 	= " ",
								$positivePos= 1,
								$negativePos= 8){
		$this->id		 = $id;
		$this->symbol    = $symbol;
		$this->nbDecimal = $nbDecimal;
		$this->decimal   = $decimal;
		$this->thousands = $thousands;
		$this->positivePos = $positivePos;
		$this->negativePos = $negativePos;
	}

	// ================
	function getSymbol(){
		return($this->symbol);
	}

	// ================
	function getId(){
		return($this->id);
	}
	// ================
	function getValue($nb, $decimals=''){
	
		$res = "";		
		$s = strval($nb*10);
		if (!$s[strlen($s)-1])
		{
			// int
			$res=number_format($nb, 0, '', ',');//.",-";
		} else {
			// float
			$res=number_format($nb, 2, '.', ',');
		}
		return($res);
		
		// Warning ! number_format function performs implicit rounding
		// Rounding is not handled in this DISPLAY class
		// that's why you have to use the right decimal value.
		// Workaround :number_format accepts either 1, 2 or 4 parameters.
		// this cause problem when no thousands separator is given : in this
		// case, an unwanted ',' is displayed.
		// That's why we have to do the work ourserlve.
		// Note : when no decimal il given (i.e. 3 parameters), everything works fine
		if( $decimals === '') {
			$decimals = $this->nbDecimal;
		}
		if ($this->thousands != ''){
			$res=number_format($nb,$decimals,$this->decimal,$this->thousands);
		} else {
			// If decimal is equal to defaut thousand separator, apply a trick
			if ($this->decimal==','){
				$res=number_format($nb,$decimals,$this->decimal,'|');
				$res=str_replace('|','',$res);			
			} else {
				// Else a simple substitution is enough
				$res=number_format($nb,$decimals,$this->decimal,$this->thousands);
				$res=str_replace(',','',$res);
			}
		}
		return($res);
	}

	// ================
	function getFullValue($nb, $decimals='', $symbol = '') {
		global $vendor_currency;
		$res = "";
		if( $symbol != '' ) {
			$old_symbol = $this->symbol;
			$this->symbol = $symbol;
		} 
	    switch($this->symbol) {
		
			case 'USD': $this->symbol='$';break;
			case 'EUR': $this->symbol='€';break;
			case 'GBP': $this->symbol='£';break;
			case 'JPY': $this->symbol='¥';break;
			case 'AUD': $this->symbol='AUD $';break;
			case 'CAD': $this->symbol='CAD $';break;
			case 'HKD': $this->symbol='HKD $';break;
			case 'NZD': $this->symbol='NZD $';break;
			case 'SGD': $this->symbol='SGD $';break;
	    }
		
		$this->symbol = trim($this->symbol)." ";
		// Currency symbol position
		if ($nb == abs($nb)){
			$res=$this->getValue($nb, $decimals);			
			// Positive number
			switch ($this->positivePos){
				case 0:
					// 0 = '00Symb'
					$res=$res.$this->symbol;
					break;
				case 2:
					// 2 = 'Symb00'
					$res=$this->symbol.$res;
				break;
				case 3:
					// 3 = 'Symb 00'
					$res=$this->symbol.' '.$res;
					break;
				case 1:
				default :
					// 1 = '00 Symb'
					$res=$res.' '.$this->symbol;
					break;
			}
		} else {
			// Negative number
			$res=$this->getValue(abs($nb), $decimals);
			switch ($this->negativePos){
				case 0:
					// 0 = '(Symb00)'
					$res='('.$this->symbol.$res.')';
					break;
				case 1:
					// 1 = '-Symb00'
					$res='-'.$this->symbol.$res;
					break;
				case 2:
					// 2 = 'Symb-00'
					$res=$this->symbol.'-'.$res;
					break;
				case 3:
					// 3 = 'Symb00-'
					$res=$this->symbol.$res.'-';
					break;
				case 4:
					// 4 = '(00Symb)'
					$res='('.$res.$this->symbol.')';
					break;
				case 5:
					// 5 = '-00Symb'
					$res='-'.$res.$this->symbol;
					break;
				case 6:
					// 6 = '00-Symb'
					$res=$res.'-'.$this->symbol;
					break;
				case 7:
					// 7 = '00Symb-'
					$res=$res.$this->symbol.'-';
					break;
				case 9:
					// 9 = '-Symb 00'
					$res='-'.$this->symbol.' '.$res;
					break;
				case 10:
					// 10 = '00 Symb-'
					$res=$res.' '.$this->symbol.'-';
					break;
				case 11:
					// 11 = 'Symb 00-'
					$res=$this->symbol.' '.$res.'-';
					break;
				case 12:
					// 12 = 'Symb -00'
					$res=$this->symbol.' -'.$res;
					break;
				case 13:
					// 13 = '00- Symb'
					$res=$res.'- '.$this->symbol;
					break;
				case 14:
					// 14 = '(Symb 00)'
					$res='('.$this->symbol.' '.$res.')';
					break;
				case 15:
					// 15 = '(00 Symb)'
					$res='('.$res.' '.$this->symbol.')';
					break;
				case 8:
				default :
					// 8 = '-00 Symb'
					$res='-'.$res.' '.$this->symbol;
					break;
			}
		}
		if( $symbol != '' ) {
			$this->symbol = $old_symbol;
		}
		return($res);
	}
	// ================ /CURRENCY DISPLAY =========================
	// ============================================================
} // end class
