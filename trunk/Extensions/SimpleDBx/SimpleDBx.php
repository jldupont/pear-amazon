<?php
/**
 * SimpleDB extension
 *
 * This class is meant to abstract a whole 'domain'. The base class (i.e. Amazon_SimpleDB_Client)
 * is abstracted to deal with the customer's whole domain space.
 *
 * It also sports the following additional methods:
 * - createUniqueElement
 * - putUniqueElement
 * - getUniqueElement
 * - deleteUniqueElement
 * - deleteElements
 * - isUniqueElement
 *
 * @author Jean-Lou Dupont
 * @version @@package-version@@
 * @category extensions
 */

require 'Amazon/SimpleDB/Client.php';
require 'Amazon/Extensions/SimpleDBx/Interface.php';

class Amazon_SimpleDB_Client_x extends Amazon_SimpleDB_Client
	implements SimpleDBx_Interface
{
	/**
	 * @var $domain
	 */	
	var $domain = null;
			 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Extended interface - PART I
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
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
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Extended interface - PART II
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Creates a 'unique' element
	 *
	 */
	public function createUniqueElement( &$action )
	{
        if (!$action instanceof SimpleDBx_CreateUniqueElement ) {
            require_once ('Amazon/Extensions/SimpleDBx/Model/CreateUniqueElement.php');
            $action = new SimpleDBx_CreateUniqueElement($action);
        }
        require_once ('Amazon/Extensions/SimpleDBx/Model/CreateUniqueElementResponse.php');
        return SimpleDBx_CreateUniqueElementResponse::fromXML($this->_invoke($action->toMap()));
	}	 
	/**
	 * Puts a unique element in the database.
	 * Collisions can still occur albeit at low probability.
	 * 
	 */
	public function putUniqueElement( &$action )
	{
        if (!$action instanceof SimpleDBx_PutUniqueElement ) {
            require_once ('Amazon/Extensions/SimpleDBx/Model/PutUniqueElement.php');
            $action = new SimpleDBx_PutUniqueElement($action);
        }
        require_once ('Amazon/Extensions/SimpleDBx/Model/PutUniqueElementResponse.php');
        return SimpleDBx_PutUniqueElementResponse::fromXML($this->_invoke($action->toMap()));
	}
	/**
	 * 
	 * 
	 * @param $action
	 */
	public function getUniqueElement( &$element )
	{
        if (!$action instanceof SimpleDBx_GetUniqueElement ) {
            require_once ('Amazon/Extensions/SimpleDBx/Model/GetUniqueElement.php');
            $action = new SimpleDBx_GetUniqueElement($action);
        }
        require_once ('Amazon/Extensions/SimpleDBx/Model/GetUniqueElementResponse.php');
        return SimpleDBx_GetUniqueElementResponse::fromXML($this->_invoke($action->toMap()));
	}
	/**
	 * 
	 * 
	 * @param $action
	 */
	public function deleteUniqueElementAttributes( &$element )
	{
        if (!$action instanceof SimpleDBx_GetUniqueElement ) {
            require_once ('Amazon/Extensions/SimpleDBx/Model/DeleteUniqueElementAttributes.php');
            $action = new SimpleDBx_DeleteUniqueElementAttributes($action);
        }
        require_once ('Amazon/Extensions/SimpleDBx/Model/DeleteUniqueElementAttributesResponse.php');
        return SimpleDBx_DeleteUniqueElementAttributesResponse::fromXML($this->_invoke($action->toMap()));
	}
	/**
	 * Deletes the/all elements with $itemName.
	 * 
	 * @param $action
	 */
	public function deleteElements( &$element )
	{
        if (!$action instanceof SimpleDBx_DeleteElements ) {
            require_once ('Amazon/Extensions/SimpleDBx/Model/DeleteElements.php');
            $action = new SimpleDBx_DeleteElements($action);
        }
        require_once ('Amazon/Extensions/SimpleDBx/Model/DeleteElementsResponse.php');
        return SimpleDBx_DeleteElementsResponse::fromXML($this->_invoke($action->toMap()));
	}
	/**
	 * 
	 * 
	 * @param $action
	 */
	public function deleteUniqueElement( &$element )
	{
        if (!$action instanceof SimpleDBx_DeleteUniqueElement ) {
            require_once ('Amazon/Extensions/SimpleDBx/Model/DeleteUniqueElement.php');
            $action = new SimpleDBx_DeleteElements($action);
        }
        require_once ('Amazon/Extensions/SimpleDBx/Model/DeleteUniqueElementResponse.php');
        return SimpleDBx_DeleteUniqueElementResponse::fromXML($this->_invoke($action->toMap()));
	}
	/**
	 * 
	 * 
	 * @param $action
	 */
	public static function isUniqueElement( &$responseMetaData )
	{

	}
	
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// HELPER METHODS
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	protected function generateUID( )
	{
		
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Modified Parent Interface -- Unsupported Methods
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    /**
     * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_CreateDomain.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_CreateDomain action or Amazon_SimpleDB_Model_CreateDomain object itself
     * @see Amazon_SimpleDB_Model_CreateDomain
     * @return Amazon_SimpleDB_Model_CreateDomainResponse Amazon_SimpleDB_Model_CreateDomainResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function createDomain($action) 
    {
		throw new Exception( __METHOD__.': method not supported.' );
    }
	
	/**
	 * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_ListDomains.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_ListDomains action or Amazon_SimpleDB_Model_ListDomains object itself
     * @see Amazon_SimpleDB_Model_ListDomains
     * @return Amazon_SimpleDB_Model_ListDomainsResponse Amazon_SimpleDB_Model_ListDomainsResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function listDomains($action) 
    {
		throw new Exception( __METHOD__.': method not supported.' );    
	}
            
    /**
     * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_DeleteDomain.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_DeleteDomain action or Amazon_SimpleDB_Model_DeleteDomain object itself
     * @see Amazon_SimpleDB_Model_DeleteDomain
     * @return Amazon_SimpleDB_Model_DeleteDomainResponse Amazon_SimpleDB_Model_DeleteDomainResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function deleteDomain($action) 
    {
		throw new Exception( __METHOD__.': method not supported.' );        
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Modified Parent Interface -- Enhanced
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            
    /**
     * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_PutAttributes.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_PutAttributes action or Amazon_SimpleDB_Model_PutAttributes object itself
     * @see Amazon_SimpleDB_Model_PutAttributes
     * @return Amazon_SimpleDB_Model_PutAttributesResponse Amazon_SimpleDB_Model_PutAttributesResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function putAttributes($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_PutAttributes) {
            require_once ('Amazon/SimpleDB/Model/PutAttributes.php');
            $action = new Amazon_SimpleDB_Model_PutAttributes($action);
        }
		
		$this->injectDomainName( $action );				
		
        require_once ('Amazon/SimpleDB/Model/PutAttributesResponse.php');
        return Amazon_SimpleDB_Model_PutAttributesResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_GetAttributes.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_GetAttributes action or Amazon_SimpleDB_Model_GetAttributes object itself
     * @see Amazon_SimpleDB_Model_GetAttributes
     * @return Amazon_SimpleDB_Model_GetAttributesResponse Amazon_SimpleDB_Model_GetAttributesResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function getAttributes($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_GetAttributes) {
            require_once ('Amazon/SimpleDB/Model/GetAttributes.php');
            $action = new Amazon_SimpleDB_Model_GetAttributes($action);
        }
		
		$this->injectDomainName( $action );				
		
        require_once ('Amazon/SimpleDB/Model/GetAttributesResponse.php');
        return Amazon_SimpleDB_Model_GetAttributesResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Delete Attributes 
     * Deletes one or more attributes associated with the item. If all attributes of an item are deleted, the item is
     * deleted.
     *   
     * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_DeleteAttributes.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_DeleteAttributes action or Amazon_SimpleDB_Model_DeleteAttributes object itself
     * @see Amazon_SimpleDB_Model_DeleteAttributes
     * @return Amazon_SimpleDB_Model_DeleteAttributesResponse Amazon_SimpleDB_Model_DeleteAttributesResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function deleteAttributes($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_DeleteAttributes) {
            require_once ('Amazon/SimpleDB/Model/DeleteAttributes.php');
            $action = new Amazon_SimpleDB_Model_DeleteAttributes($action);
        }
		
		$this->injectDomainName( $action );				
		
        require_once ('Amazon/SimpleDB/Model/DeleteAttributesResponse.php');
        return Amazon_SimpleDB_Model_DeleteAttributesResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Query 
     * The Query operation returns a set of ItemNames that match the query expression. Query operations that
     * run longer than 5 seconds will likely time-out and return a time-out error response.
     * A Query with no QueryExpression matches all items in the domain.
     *   
     * @see http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_Query.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_Query action or Amazon_SimpleDB_Model_Query object itself
     * @see Amazon_SimpleDB_Model_Query
     * @return Amazon_SimpleDB_Model_QueryResponse Amazon_SimpleDB_Model_QueryResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function query($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_Query) {
            require_once ('Amazon/SimpleDB/Model/Query.php');
            $action = new Amazon_SimpleDB_Model_Query($action);
        }
		
		$this->injectDomainName( $action );		
		
        require_once ('Amazon/SimpleDB/Model/QueryResponse.php');
        return Amazon_SimpleDB_Model_QueryResponse::fromXML($this->_invoke($action->toMap()));
    }

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// HELPER methods for the modified Parent Interface
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	protected function injectDomainName( &$action )
	{
		if ( $this->domain === null )	
			throw new Exception( __METHOD__.': domain not initialized.' );
			
		$action->setDomainName( $this->domain );			
	}

}//end class