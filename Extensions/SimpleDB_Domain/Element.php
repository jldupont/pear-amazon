<?php
/**
 * Element.php
 * SimpleDB_Domain - Amazon SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @version @@package-version@@
 * @category extensions
 */

class SimpleDB_Domain_Element
{
	/**
	 *
	 */
	var $attributes = array();
	/**
	 *
	 */
	var $uid = null;

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// CONSTRUCTION & INITIALIZATION
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 *
	 */	
	public function __construct( $uid = null )
	{
		$this->uid = $uid;		
	}
	/**
	 * Prepares this element for a transaction.
	 * Generates a uid if not already done.
	 */	
	public function prepare()
	{
		if (is_null( $this->uid ))
			$this->generateUID();
	}
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// SET/GET interface
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    /**
     * Support for virtual properties getters. 
     * 
     * Virtual property call example:
     *  
     *   $this->Property
     *   
     * Direct getter(preferred): 
     * 
     *   $this->getProperty()      
     * 
     * @param string $propertyName name of the property
     */
    public function __get($propertyName)
    {
       $getter = "get$propertyName"; 
       return $this->$getter();
    }

    /**
     * Support for virtual properties setters. 
     * 
     * Virtual property call example:
     *  
     *   $this->Property  = 'ABC'
     *   
     * Direct setter (preferred):
     * 
     *   $this->setProperty('ABC')     
     * 
     * @param string $propertyName name of the property
     */
    public function __set($propertyName, $propertyValue)
    {
       $setter = "set$propertyName";
       $this->$setter($propertyValue);
       return $this;
    }
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Unique ID related.
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Generate a UID for this element.
	 *
	 */	
	public function generateUID( )
	{
		$this->uid = 0; //TODO	
	}
	/**
	 * Sets the unique ID.
	 */	
	public function setUID( $uid )
	{
		$this->uid = $uid;
		return $this;		
	}
	/**
	 * Gets the unique ID.
	 */	
	public function getUID( )
	{
		return $this->uid;
	}
	/**
	 * Validate the uid
	 */	
	public function uidValid()
	{
		return !is_null( $this->uid );	
	}	 
	/**
	 * Creates an element from a uid.
	 */	
	public static function fromUID( $uid )	 
	{
		return new SimpleDB_Domain_Element( $uid );
	}
} //end class