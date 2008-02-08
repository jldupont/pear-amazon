<?php
/**
 * Bridge.php
 * SimpleDB_Domain - Amazon SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @package SimpleDB_Extensions 
 * @version @@package-version@@
 * @category extensions
 */

class SimpleDB_Domain_Bridge
{
	/**
	 * Performs a 'bridging' function between the SimpleDB_Domain
	 * and the base SimpleDB model for the 'putAttributes' method.
	 */
	public static function setElement( &$domain, &$element )
	{
		$action = self::constructArray( $domain, $element );
				
		if (!$action instanceof Amazon_SimpleDB_Model_PutAttributes) {
		    require_once ('Amazon/SimpleDB/Model/PutAttributes.php');
		    $action = new Amazon_SimpleDB_Model_PutAttributes($action);
		}
        require_once ('Amazon/SimpleDB/Model/PutAttributesResponse.php');
		$response = Amazon_SimpleDB_Model_PutAttributesResponse::fromXML($this->_invoke($action->toMap()));
	}
	
	/**
	 * In this case, the API only requires:
	 * - DomainName
	 * - ItemName
	 * Cases:
	 * 1) If ID is specified, then returns (if available) the specific element
	 * 2) If ID NOT specified, then 'queries' with attribute name 'ItemName'
	 *
	 */	
	public static function getElement( $domain, &$element )
	{
		if ( !is_null( $element->getID() ))
			return self::getSpecificElement( $domain, $element );
			
		$action = self::constructArray( $domain, $element );
	}	 
	/**
	 * Retrieves a specific element.
	 * ItemName 
	 */
	protected static function & getSpecificElement( &$domain, &$element )
	{
		$action = self::constructArray( $domain, $element );
		
		if (!$action instanceof Amazon_SimpleDB_Model_GetAttributes) {
		    require_once ('Amazon/SimpleDB/Model/GetAttributes.php');
		    $action = new Amazon_SimpleDB_Model_GetAttributes($action);
		}
		require_once ('Amazon/SimpleDB/Model/GetAttributesResponse.php');
		$response = Amazon_SimpleDB_Model_GetAttributesResponse::fromXML($this->_invoke($action->toMap()));
		
		return self::responseToElement( $response );		
	}
	/**
	 *
	 */	
	public function query( $domain, &$element )		 
	{
		
	}
	/**
	 *
	 */	
	public static function deleteElement( $domain, &$element )
	{
		
	}	 
	/**
	 *
	 */	
	protected static function & constructArray( &$domain, &$element )	
	{
		$element->setDomain( $domain );		
		
		$array = array();
		$array[ 'DomainName' ] = $element->getDomain();
		$array[ 'ItemName' ] = $element->getID();
		$array[ 'Attribute' ] = $element->getAttribute();
		
		return $array;
	}
	/**
	 * 
	 */	
	protected static function & responseToElement( &$response )
	{
		
	}
}//end class