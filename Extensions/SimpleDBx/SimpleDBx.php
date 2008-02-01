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
	const CODE_ITEM_EXISTS		= -2;	
		 
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
        if (!$action instanceof SimpleDBx_CreateUnique) {
            require_once ('JLD/Amazon/Extensions/SimpleDBx/Model/CreateUnique.php');
            $action = new SimpleDBx_CreateUnique($action);
        }

		// First, the quick test
		if ( $this->itemExists( $action ) )
			return self::CODE_ITEM_EXIST;		

		$itemName = $action->getItemName();
		
		// compute ''lock'' item
		$lock = self::$lock.$itemName; //##FIXME
		
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
	 * Verifies if the specified 'itemName' exists
	 */	
	public function itemExists( &$action )
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