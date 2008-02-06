<?php
/**
 * SimpleDB_Domain
 * Amazon SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @version @@package-version@@
 * @category extensions
 */

interface  SimpleDB_Domain_Interface 
{
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

	/**
	 * Updates/Creates a single element in the current domain.
	 * The element must already exists or else an exception is throwned.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Exception	 
	 */    
	public function setElement( &$element );

	/**
	 * Gets a single element from the current domain.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Exception	 
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
	 * @throws Exception	 
	 */    
	public function deleteElement( &$element );

	/**
	 * Determines if the given element is unique.
	 *
	 * @param SimpleDB_Domain_Element
	 * @throws Exception	 
	 */
	public static function isUniqueElement( &$element );
	
}