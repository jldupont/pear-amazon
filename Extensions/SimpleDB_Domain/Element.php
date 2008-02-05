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
	
	/**
	 *
	 */	
	public function __construct()
	{
		
	}

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
	 *
	 */	
	public function generateUID( )
	{
		
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
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		
} //end class