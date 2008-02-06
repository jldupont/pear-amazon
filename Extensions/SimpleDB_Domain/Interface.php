<?php
/**
 * SimpleDB_Domain_Interface
 * Amazon SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @package SimpleDB_Extensions
 * @version @@package-version@@
 * @category extensions
 */

interface  SimpleDB_Domain_Interface 
{
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// DOMAIN related	
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	/**
	 * Sets the domain name for this object instance
	 * @param string $domainName
	 */    
	public function setDomain( $domainName );

	/**
	 * Gets the domain name of this instance
	 * @return string/null $domainName
	 */    
	public function getDomain( );

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
// ELEMENT related	
// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	/**
	 * Updates/Creates a single element in the current domain.
	 * The element must already exists or else an exception is throwned.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Amazon_SimpleDB_Exception *iff* there was an error
	 */    
	public function setElement( &$element );

	/**
	 * Gets a single element from the current domain.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Amazon_SimpleDB_Exception *iff* there was an error
	 */    
	public function getElement( &$element );
	
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
	public function deleteElement( &$element );

}