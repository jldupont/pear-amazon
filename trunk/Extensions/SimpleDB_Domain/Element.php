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
 *  itemName (from base Model) --> attribute.0.Name = $name
 *  itemName (from base Model) = $uid
 *  
 */
class SimpleDB_Domain_Element
{
	/**
	 * Array of 'ReplaceableAttribute' objects
	 */
	var $attribute = array();
	/**
	 * Contains the (unique) ID.
	 */
	var $id = null;
	/**
	 * The 'itemName' is conveyed through an 'attribute'
	 * named 'itemName'.
	 */
	var $itemName = null;


// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// CONSTRUCTION & INITIALIZATION
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Constructs a skeleton instance
	 */	
	public function __construct( $uid = null )
	{
		$this->id = $uid;		
	}
	/**
	 * Prepares this element for a transaction.
	 * Generates a uid if not already done.
	 */	
	public function prepare()
	{
		if (is_null( $this->id ))
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
	protected function generateUID( )
	{
		$this->id = 0; //TODO	
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
	public function getID( )
	{
		return $this->uid;
	}
	/**
	 * Validates (basic) the uid
	 */	
	public function IDValid()
	{
		return !is_null( $this->uid );	
	}	 
	/**
	 * Creates an element from a uid.
	 */	
	public static function fromID( $uid )	 
	{
		return new SimpleDB_Domain_Element( $uid );
	}
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Attribute related
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Sets the entire array of 'ReplaceableAttributes'
	 */
	public function setAttribute( &$ra )	 
	{
		assert( is_array( $ra ) );		
		$this->attribute = $ra;
		return $this;
	}
	/**
	 * Adds one 'ReplaceableAttribute'
	 */	
	public function withAttribute( &$ra )	 
	{
		assert( $ra instanceof Amazon_SimpleDB_Model_ReplaceableAttribute );		
		$this->attribute[] = $ra;
		return $this;		
	}
	/**
	 * Returns the whole array of attributes
	 * OR just a specific instance.
	 *
	 * Returns the merged array of attributes.
	 */	
	public function getAttribute( $aName = null )	 
	{
		if ( is_null( $aName ) )
			return array_merge( $this->itemName, $this->attribute);		
			
		if ( is_null( $this->attribute ))
			return null;
			
		foreach( $this->attribute as $index => &$ra )
			if ( $ra->getName() == $aName )
				return $ra;
				
		return null;
	}
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// ItemName related
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	public function setName( $name )
	{
		$this->itemName = 
			new Amazon_SimpleDB_Model_ReplaceAttribute( 
				array(	'Name'	=> 'itemName',
						'Value'	=> $name
				)
			);
		return $this;
	}
	public function getName()
	{
		if (is_null( $this->itemName ))
			return null;
		return $this->itemName.getValue();
	}
} //end class