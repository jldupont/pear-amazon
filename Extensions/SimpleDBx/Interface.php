<?php
/**
 * SimpleDB Extension
 *
 * @author Jean-Lou Dupont
 * @version @@package-version@@
 * @category extensions
 */

interface  SimpleDBx_Interface 
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
	 *
	 */    
	public function createUniqueElement( &$uid, &$element );
            
	/**
	 *
	 */    
	public function putUniqueElement( $uid, &$element );

	/**
	 *
	 */    
	public function getUniqueElement( $uid );
	
	/**
	 *
	 */    
	public function deleteUniqueElement( $uid );

	/**
	 *
	 */
	public function isUniqueElement( &$element );
	
	/**
	 *
	 */
	public function deleteElements( $itemName );

	
}