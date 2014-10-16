<?php
/**
 * Created by PhpStorm.
 * User: Balázs
 * Date: 2014.10.11.
 * Time: 16:26
 */

//Viki's comment
//2nd comment
//Hi!

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
    public $Orders;  //ResourceSetReference
}

class Reload {

    public $ReloadID;
    public $ProductID;
    public $SupplierID;
    public $Quantity;
    public $Date;
    public $Items;  //ResourceSetReference
}

class Order {

    public $OrderID;
    public $ProductID;
    public $CustomerID;
    public $Quantity;
    public $Date;
    public $Items;  //ResourceSetReference
    public $User;   //ResourceReference
    public $Customer; //ResourceReference
    public $Supplier;  //ResourceReference
}

class User {

    public $UserID;
    public $Name;
    public $Privilege;
    public $Orders;  //ResourceSetReference
}

class Customer {

    public $CustomerID;
    public $Address;
    public $Order;  //ResourceReference
}

class Supplier {

    public $SupplierID;
    public $Phone;
    public $ContactName;
    public $Order;  //ResourceReference
}

class CreateFictiveCompanyMetadata {

    public static function create(){

        $metadata = new ServiceBaseMetadata('FictiveCompanyEntities', 'FictiveCompany');

        $stockEntityType = $metadata->addEntityType(new ReflectionClass('Stock'), 'Stock', 'FictiveCompany');
        $metadata->addKeyProperty($stockEntityType, 'StockID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($stockEntityType, 'ProductID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($stockEntityType, 'Quantity', EdmPrimitiveType::INT32);
        $stocksResourceSet = $metadata->addResourceSet('Stocks', $stockEntityType);

        $itemEntityType = $metadata->addEntityType(new ReflectionClass('Item'), 'Item', 'FictiveCompany');
        $metadata->addKeyProperty($itemEntityType, 'ItemID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($itemEntityType, 'Barcode', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($itemEntityType, 'Name', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($itemEntityType, 'Description', EdmPrimitiveType::STRING);
        $itemsResourceSet = $metadata->addResourceSet('Items', $itemEntityType);

        $reloadEntityType = $metadata->addEntityType(new ReflectionClass('Reload'), 'Reload', 'FictiveCompany');
        $metadata->addKeyProperty($reloadEntityType, 'ReloadID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveType($reloadEntityType, 'ProductID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveType($reloadEntityType, 'SupplierID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveType($reloadEntityType, 'Quantity', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveType($reloadEntityType, 'Date', EdmPrimitiveType::STRING);
        $reloadsResourceSet = $metadata->addResourceSet('Reloads', $reloadEntityType);

        /*
         * Defining relationships
         */
        //TODO!!
        $metadata->addResourceSetReferenceProperty($stockEntityType, 'Item', $itemsResourceSet);
        $metadata->addResourceReferenceProperty($itemEntityType, 'Stock', $stocksResourceSet);

        $metadata->addResourceSetReferenceProperty($reloadEntityType, 'Reload', $reloadsResourceSet);



    }

}

?>