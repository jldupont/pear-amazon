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
		return Amazon_SimpleDB_Model_PutAttributesResponse::fromXML($this->_invoke($action->toMap()));
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
	public static function & getElement( $domain, &$element )
	{
		// SPECIFIC ELEMENT (i.e. there is a specific id)
		// ----------------
		if ( !is_null( $element->getID() ))
			return self::getSpecificElement( $domain, $element );
			
		// QUERY based retrieval
		// ---------------------			
		// prepare the query
		$itemName = $element->getName();
		$action = self::constructGetElementQueryArray( $domain, $itemName );
		
		// performs the query.
		if (!$action instanceof Amazon_SimpleDB_Model_Query) {
		    require_once ('Amazon/SimpleDB/Model/Query.php');
		    $action = new Amazon_SimpleDB_Model_Query($action);
		}
		require_once ('Amazon/SimpleDB/Model/QueryResponse.php');
		$response = Amazon_SimpleDB_Model_QueryResponse::fromXML($this->_invoke($action->toMap()));
		
		// might return more than one element...
		return self::responseToElement( $response, $element );
	}	 
	/**
	 * Retrieves a specific element.
	 * ItemName 
	 */
	protected static function & getSpecificElement( &$domain, &$element )
	{
		$action = self::constructGetElementArray( $domain, $element );
		
		if (!$action instanceof Amazon_SimpleDB_Model_GetAttributes) {
		    require_once ('Amazon/SimpleDB/Model/GetAttributes.php');
		    $action = new Amazon_SimpleDB_Model_GetAttributes($action);
		}
		require_once ('Amazon/SimpleDB/Model/GetAttributesResponse.php');
		$response = Amazon_SimpleDB_Model_GetAttributesResponse::fromXML($this->_invoke($action->toMap()));
		
		// should return just one element.
		return self::responseToElement( $response, $element );		
	}
	/**
	 * Deletes a specific element
	 * i.e. the id of the element must be set.
	 *
	 */	
	public static function deleteElement( $domain, &$element )
	{
		assert( !is_null( $element->getID() ));

		// deletes a specific element
		$action = array( 'ItemName' => $element->getID() );
		
        if (!$action instanceof Amazon_SimpleDB_Model_DeleteAttributes) {
            require_once ('Amazon/SimpleDB/Model/DeleteAttributes.php');
            $action = new Amazon_SimpleDB_Model_DeleteAttributes($action);
        }
        require_once ('Amazon/SimpleDB/Model/DeleteAttributesResponse.php');
        return Amazon_SimpleDB_Model_DeleteAttributesResponse::fromXML($this->_invoke($action->toMap()));
	}	 
	/**
	 * Constructs an 'action' array for the 'getAttributes' API method
	 * related to the 'GetElement' method. 
	 */	
	protected static function & constructGetElementArray( &$domain, &$element )	
	{
		$element->setDomain( $domain );		
		
		$array = array();
		$array[ 'DomainName' ] = $element->getDomain();
		$array[ 'ItemName' ] = $element->getID();
		$array[ 'Attribute' ] = $element->getAttribute();
		
		return $array;
	}
	/**
	 * Constructs an 'action' array for the Query API method
	 * related to the 'GetElement' method.
	 */	
	protected static function & constructGetElementQueryArray( $domain, $name )
	{
		$array = array();
		$array[ 'DomainName' ] = $domain;
		$array[ 'QueryExpression' ] = "['ItemName' = '$name' ]";
		
		return $array;
	}	 
	/**
	 * 
	 */	
	protected static function & responseToElement( &$response, &$element )
	{
		$method = 'handle_'.get_class( $response );
		return self::$method( $response, $element );
	}
	/**
	 *
	 * @return SimpleDB_Domain_Element
	 */
	protected static function & 
		handle_Amazon_SimpleDB_Model_GetAttributesResponse( 
			&$response, &$inputElement )
	{
		$result = $response->getAttribute();
		$element = SimpleDB_Domain_Element::fromElement( $inputElement );
		
		foreach( $result as $att )
		{
			$ra = new Amazon_SimpleDB_Model_ReplaceableAttribute();
			$ra->setName( $att->getName() );
			$ra->setValue( $att->getValue() );
			$element->withAttribute( $ra );
		}		
		return $element;		
	}
	/**
	 * @return SimpleDB_Domain_Element
	 * @return array of SimpleDB_Domain_Element
	 */
	protected static function & 
		handle_Amazon_SimpleDB_Model_QueryResponse( 
			&$response, &$inputElement )
	{
		$result = $response->getQueryResult();
		$itemList = $result->getItemName();
		
		$liste = array();
		foreach( $itemList as $id )
			$liste[] = new SimpleDB_Domain_Element( $id );
		
		if ( count( $liste ) == 1)
			return $liste[0];
		
		return $liste;		
	}
}//end class