<?php
/**
* 
*/

# Define namespace
namespace WCFE\Modules\Editor\Model\Forms\Fields;

# Field base
use WPPFW\Forms;

/**
* 
*/
class CookieDomain extends Forms\Fields\FormStringField implements IWPConfigFileField {
	
	/**
	* put your comment there...
	* 
	*/
	public function __construct() {
		# Set field name and rules
		parent::__construct('CookieDomain');
	}

	/**
	* put your comment there...
	* 
	*/
	public function read() {
		$this->setValue( defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : null );
	}

}

