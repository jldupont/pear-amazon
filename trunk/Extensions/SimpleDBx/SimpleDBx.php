<?php
/**
 * SimpleDB extension
 *
 * This class extends Amazon's SimpleDB Client class with the following services:
 * -
 *
 * @author Jean-Lou Dupont
 * @version @@package-version@@
 * @category extensions
 */

require 'Amazon/SimpleDB/Client.php';

class Amazon_SimpleDB_Client_x extends Amazon_SimpleDB_Client
{
	/**
	 * @static string acts a ''lock'' identifier
	 */
	static $lock = 'LOCK:';
	/**
	 *
	 */	
	const CODE_OK				= true;
	const CODE_LOCK_PRESENT		= -1;
		 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Extended interface
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * Creates a unique ''item'', if possible.
	 * 
	 * @param $action
	 */
	public function createUnique( $action )
	{
		// compute ''lock'' item
		$lock = self::$lock.$action; //##FIXME
		
		// check if there is an existing ''lock''
		if ($this->itemExists( $lock ))
			return self::CODE_LOCK_PRESENT;
		
		// create a ''unique'' token
		$uid = md5( uniqid( rand(), true ) );
		
		// insert a ''lock'' item corresponding to the
		// ''item'' name to create
		$res = $this->putLock( $lock, $uid );
		
		
	}
	/**
	 *
	 */	
	public function itemExists( &$item )
	{
	
	}
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// Modified Parent Interface
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	/**
	 * The parent's putAttributes method must be extended
	 * to trap the use of the reserved ''namespace''.
	 */
    public function putAttributes( $action )
	{

	}
}//end class