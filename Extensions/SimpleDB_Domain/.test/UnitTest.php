<?php
/**
 * @author Jean-Lou Dupont
 */

require '.config.php';
require 'PHPUnit/Framework.php';
require 'Amazon/Extensions/SimpleDB_Domain/SimpleDB_Domain.php';

class Tests extends PHPUnit_Framework_TestCase
{
    protected $domain = null;
 
    protected function setUp()
    {
		global $awsAccessKeyId;
		global $awsSecretAccessKey;
		
        // Create the Array fixture.
		$this->domain = new SimpleDB_Domain( 'test', $awsAccessKeyId, $awsSecretAccessKey );
    }
 	protected function tearDown()
	{
		unset( $this->domain );
	}
 
}