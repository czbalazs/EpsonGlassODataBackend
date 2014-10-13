<?php
/**
 * Created by PhpStorm.
 * User: Balázs
 * Date: 2014.10.11.
 * Time: 18:01
 */

use ODataProducer\UriProcessor\ResourcePathProcessor\SegmentParser\KeyDescriptor;
use ODataProducer\Providers\Metadata\ResourceSet;
use ODataProducer\Providers\Metadata\ResourceProperty;
use ODataProducer\Providers\Query\IDataServiceQueryProvider;
use ODataProducer\Common\ODataException;

require_once "FictiveCompanyMetadata.php";
//require_once "\ODataPHPProducer\library\ODataProducer\Providers\Query\IDataServiceQueryProvider.php";

define('DB_NAME', 'fictivecompany');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');

class FictiveCompanyQueryProvider implements IDataServiceQueryProvider {

    private $_connectionHandle = null;

    public function __construct(){
        $this->_connectionHandle = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD, true);
        if ($this->_connectionHandle){

        } else {
            die(print_r( mysql_error(), true));
        }
        mysql_select_db(DB_NAME, $this->_connectionHandle);
    }

    public function getResourceSet(ResourceSet $resourceSet)
    {
        $resourceSetName = $resourceSet->getName();
        if ($resourceSetName !== 'Items' && $resourceSetName !== 'Stocks'){
            die('(FictiveCompanyQueryProvider) Unknown resource set');
        }

        $query = "SELECT * FROM [$resourceSetName]";
        $stmt = sqlsrv_query($this->_connectionHandle, $query);
        if ($stmt === false){
            die(print_r(sqlsrv_errors(), true));
        }

        $returnResult = array();
        switch ($resourceSetName) {
            case 'Stock':
                $returnResult = $this->_serializeStocks($stmt);
                break;
            case 'Items':
                $returnResult = $this->_serializeItems($stmt);
                break;
        }

        sqlsrv_free_stmt($stmt);
        return $returnResult;
    }

    private function _serializeStocks($result){
        $stocks = array();
        while ($record = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $stocks[] = $this->_serializeStocks($record);
        }

        return $stocks;
    }

    private function _serializeStock($record){
        $stock  = new Stock();
        $stock->StockID = $record['StockID'];
        $stock->ProductID = $record['ProductID'];
        $stock->Quantity = $record['Quantity'];
        return $stock;
    }

    public function getResourceFromResourceSet(ResourceSet $resourceSet,
                                               KeyDescriptor $keyDescriptor
    )
    {
        $resourceSetName = $resourceSet->getName();
        if ($resourceSetName !== 'Stocks'
            && $resourceSetName !== 'Items'
        ) {
            die('(FictiveCompanyQueryProvider) Unknown resource set ' . $resourceSetName);
        }

        $namedKeyValues = $keyDescriptor->getValidatedNamedValues();
        $condition = null;
        foreach ($namedKeyValues as $key => $value) {
            $condition .= $key . ' = ' . $value[0] . ' and ';
        }

        $len = strlen($condition);
        $condition = substr($condition, 0, $len-5);
        $query = "SELECT * FROM [$resourceSetName] WHERE $condition";
        $stmt = sqlsrv_query($this->_connectionHandle, $query);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (!sqlsrv_has_rows($stmt)){
            return null;
        }

        $result = null;
        while ( $record = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            switch ($resourceSetName) {
                case 'Stocks':
                    $result = $this->_serializeStocks($record);
                    break;
                case 'Items':
                    $result = $this->_serializeItems($record);
                    break;
            }
        }

        sqlsrv_free_stmt($stmt);
        return $result;
    }

    public function getResourceFromRelatedResourceSet(ResourceSet $sourceResourceSet,
                                                      $sourceEntityInstance,
                                                      ResourceSet $targetResourceSet,
                                                      ResourceProperty $targetProperty,
                                                      KeyDescriptor $keyDescriptor
    )
    {
        // TODO: Implement getResourceFromRelatedResourceSet() method.
    }

    public function  getRelatedResourceSet(ResourceSet $sourceResourceSet,
                                           $sourceEntityInstance,
                                           ResourceSet $targetResourceSet,
                                           ResourceProperty $targetProperty,
                                           $filterOption = null
    )
    {
        $result = array();
        $srcClass = get_class($sourceEntityInstance);
        $navigationPropName = $targetProperty->getName();
        if ($srcClass ==='Stocks'){
            if ($navigationPropName === 'Orders') {
                //TODO What?'
                $query = "SELECT * FROM Orders WHERE CustomerID = '$sourceEntityInstance->CustomerID'";
                if ($filterOption != null) {
                    $query .= ' AND ' . $filterOption;
                } $stmt = sqlsrv_query($this->_connectionHandle, $query);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                $result = $this->_serializeOrders($stmt);
            } else {
                die('Customer does not have navigation porperty with name: ' . $navigationPropName);
            }
        } else if ($srcClass === 'Order') {
            if ($navigationPropName === 'Order_Details') {
                $query = "SELECT * FROM [Order Details] WHERE OrderID = $sourceEntityInstance->OrderID";
                if ($filterOption != null) {
                    $query .= ' AND ' . $filterOption;
                } $stmt = sqlsrv_query($this->_connectionHandle, $query);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                } $result = $this->_serializeOrderDetails($stmt);
            } else {
                die('Order does not have navigation porperty with name: ' . $navigationPropName);
            }
        } return $result;
    }

    /**
     * Get related resource for a resource
     *
     * @param ResourceSet $sourceResourceSet The source resource set
     * @param mixed $sourceEntityInstance The source resource
     * @param ResourceSet $targetResourceSet The resource set of
     *                                               the navigation property
     * @param ResourceProperty $targetProperty The navigation property to be
     *                                               retrieved
     *
     * @return Object/null The related resource if exists else null
     */
    public function getRelatedResourceReference(ResourceSet $sourceResourceSet,
                                                $sourceEntityInstance,
                                                ResourceSet $targetResourceSet,
                                                ResourceProperty $targetProperty
    )
    {
        // TODO: Implement getRelatedResourceReference() method.
    }
}

?>