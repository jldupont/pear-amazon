<?php
/**
 * SimpleDB_Domain_Exception
 * Amazon SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @package SimpleDB_Extensions
 * @version @@package-version@@
 * @category extensions
 */

class  SimpleDB_Domain_Exception extends Amazon_SimpleDB_Exception
{
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// CODES
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	/**
	 *
	 */
	//const 

	static $msg = array(
	);
	/**
	 * Parent:
	 *   $errorInfo["StatusCode"];
	 *   $errorInfo["ErrorCode"];
	 *   $errorInfo["ErrorType"];
	 *   $errorInfo["BoxUsage"];
	 *   $errorInfo["RequestId"];
	 *   $errorInfo["XML"];
	 */
	public function __construct( $code )
	{
		$errorInfo["StatusCode"] = null ;
		$errorInfo["ErrorCode"] = $code ;
		$errorInfo["ErrorType"];

		parent::__construct( $errorInfo );
			
	}
}//end class