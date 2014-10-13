<?php
/**
 * Created by PhpStorm.
 * User: Balázs
 * Date: 2014.10.11.
 * Time: 16:26
 */

class Stock {

    public $StockID;
    public $ProductID;
    public $Quantity;
    public $Items;   //ResourceSetReference

}

class Item {

    public $ProductID;
    public $Barcode;
    public $Name;
    public $Description;
    public $Stock;   //ResourceReference

}

class CreateFictiveCompanyMetadata {

    public static function create(){

        $metadata = new ServiceBaseMetadata('FictiveCompanyEntities', 'FictiveCompany');

        $stockEntityType = $metadata->addEntityType(new ReflectionClass('Stock'), 'Stock', 'FictiveCompany');
        $metadata->addKeyProperty($stockEntityType, 'StockID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($stockEntityType, 'ProductID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($stockEntityType, 'Quantity', EdmPrimitiveType::INT32);
        $stockResourceSet = $metadata->addResourceSet('Stocks', $stockEntityType);

        $itemsEntityType = $metadata->addEntityType(new ReflectionClass('Item'), 'Item', 'FictiveCompany');
        $metadata->addKeyProperty($itemsEntityType, 'ItemID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($itemsEntityType, 'Barcode', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($itemsEntityType, 'Name', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($itemsEntityType, 'Description', EdmPrimitiveType::STRING);
        $itemsResourceSet = $metadata->addResourceSet('Items', $itemsEntityType);

        /*
         * Defining relationships
         */

        $metadata->addResourceSetReferenceProperty($itemsEntityType, 'Items', $stockResourceSet);
        $metadata->addResourceSetReferenceProperty($stockEntityType, 'Stock', $stockResourceSet);



    }

}

?>