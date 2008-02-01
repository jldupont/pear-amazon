<?php
/**
 * SimpleDB extension
 *
 * @author Jean-Lou Dupont
 * @version @@package-version@@
 * @category extensions
 */

/**
 *  @see Amazon_SimpleDB_Model
 */
require_once ('Amazon/SimpleDB/Model.php');  

    

/**
 * SimpleDBx_CreateUnique
 * 
 * Properties:
 * <ul>
 * 
 * <li>DomainName: string</li>
 * <li>ItemName: string</li>
 *
 * </ul>
 */ 
class SimpleDBx_CreateUnique extends Amazon_SimpleDB_Model
{


    /**
     * Construct new SimpleDBx_CreateUnique
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>DomainName: string</li>
     * <li>ItemName: string</li>
     * <li>Attribute: Amazon_SimpleDB_Model_ReplaceableAttribute</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'DomainName' => array('FieldValue' => null, 'FieldType' => 'string'),
        'ItemName' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the DomainName property.
     * 
     * @return string DomainName
     */
    public function getDomainName() 
    {
        return $this->_fields['DomainName']['FieldValue'];
    }

    /**
     * Sets the value of the DomainName property.
     * 
     * @param string DomainName
     * @return this instance
     */
    public function setDomainName($value) 
    {
        $this->_fields['DomainName']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the DomainName and returns this instance
     * 
     * @param string $value DomainName
     * @return this instance
     */
    public function withDomainName($value)
    {
        $this->setDomainName($value);
        return $this;
    }


    /**
     * Checks if DomainName is set
     * 
     * @return bool true if DomainName  is set
     */
    public function isSetDomainName()
    {
        return !is_null($this->_fields['DomainName']['FieldValue']);
    }

    /**
     * Gets the value of the ItemName property.
     * 
     * @return string ItemName
     */
    public function getItemName() 
    {
        return $this->_fields['ItemName']['FieldValue'];
    }

    /**
     * Sets the value of the ItemName property.
     * 
     * @param string ItemName
     * @return this instance
     */
    public function setItemName($value) 
    {
        $this->_fields['ItemName']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the ItemName and returns this instance
     * 
     * @param string $value ItemName
     * @return this instance
     */
    public function withItemName($value)
    {
        $this->setItemName($value);
        return $this;
    }


    /**
     * Checks if ItemName is set
     * 
     * @return bool true if ItemName  is set
     */
    public function isSetItemName()
    {
        return !is_null($this->_fields['ItemName']['FieldValue']);
    }

}