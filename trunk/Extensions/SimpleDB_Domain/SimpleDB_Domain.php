<?php
/**
 * Element.php
 * SimpleDB_Domain - Amazon SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @package SimpleDB_Extensions
 * @version @@package-version@@
 * @category extensions
 */
/**
 *
 */
require_once 'Amazon/SimpleDB/Client.php';
require 'Amazon/Extensions/SimpleDB_Domain/Exception.php';
require 'Amazon/Extensions/SimpleDB_Domain/Bridge.php';
require 'Amazon/Extensions/SimpleDB_Domain/Element.php';
require 'Amazon/Extensions/SimpleDB_Domain/Interface.php';

class SimpleDB_Domain
	implements SimpleDB_Domain_Interface
{
	/**
	 *
	 */	
	var $domain = null;
	/**
	 *
	 */	
	var $service = null;
			
	/**
	 *
	 */	
	public function __construct( $domain, $awsAccessKeyId, $awsSecretAccessKey, $config = null )
	{
		$this->domain = $domain;
		$this->service = new Amazon_SimpleDB_Client( $awsAccessKeyId, $awsSecretAccessKey, $config );
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// INTERFACE
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Sets the domain name for this object instance
	 * @param string $domainName
	 */    
	public function setDomain( $domainName )
	{
		$this->domain = $domainName;
		return $this;
	}

	/**
	 * Gets the domain name of this instance
	 * @return string/null $domainName
	 */    
	public function getDomain( )
	{
		return $this->domain;		
	}
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// INTERFACE
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Updates a single element in the current domain.
	 * 1) If the element does not exist (i.e. uid == null), the
	 *	  element is created with a generated unique uid.
	 * 2) If the element already exists in the db, it is updated.
	 * 3) If the element contains a uid *but* it does not exist
	 *	  in the db, it is created with the given uid.
	 *
	 * Uses the 'putAttributes' method API.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Amazon_SimpleDB_Exception *iff* there was an error
	 */    
	public function setElement( &$element )
	{
		assert( $element instanceof SimpleDB_Domain_Element );
		assert( $this->service instanceof Amazon_SimpleDB_Client );

		// prepares the 'action' object for SimpleDB
		SimpleDB_Domain_Bridge::putAttributes( $this->domain, $element );
		
		return $element;			
	}
	/**
	 * Gets a single element from the current domain.
	 * Since SimpleDB's parameter 'itemName' is effectively used
	 * to carry the unique identifier, we need to use the 'query' method
	 * API to retrieve an element.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Amazon_SimpleDB_Exception *iff* there was an error
	 */    
	public function getElement( $element )
	{
		assert( $element instanceof SimpleDB_Domain_Element );
		assert( $this->service instanceof Amazon_SimpleDB_Client );

		SimpleDB_Domain_Bridge::getElement( $this->domain, $element );
				
		return $element;			
	}
	/**
	 * Deletes a single element in the current domain.
	 * Since the creation process can create multiple
	 * elements with the same 'itemName', albeit with
	 * very low probability, this method effectively deletes
	 * all such entries.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Amazon_SimpleDB_Exception *iff* there was an error
	 */    
	public function deleteElement( &$element )
	{
		assert( $element instanceof SimpleDB_Domain_Element );		
		assert( $this->service instanceof Amazon_SimpleDB_Client );
				
		SimpleDB_Domain_Bridge::deleteElement( $this->domain, $element );
		
		return null;	
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Calls the target method in the server class.
	 * The server class throws the exceptions.
	 */
	protected function doAction( $method, &$element, $update = false )
	{
		assert( !is_null( $this->domain ) );
		
		$action = SimpleDB_Domain_Bridge::fromElementToAction( $element );
		$action->setDomain( $this->domain );
		
		$response = $this->service->$method( $action );
		
		if ( $update )
			SimpleDB_Domain_Bridge::fromResponseToElement( $element, $response );
	}	
	
} //end class
