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
	public function createUniqueElement( &$uid, $itemName, $attributes );
            
	/**
	 *
	 */    
	public function putUniqueElement( $uid, $itemName, $attributes );

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
	public function isUniqueElement( $itemName );
	
	/**
	 *
	 */
	public function deleteElements( $itemName );

	
}