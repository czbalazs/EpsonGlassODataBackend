<?php
/**
 * Created by PhpStorm.
 * User: Balázs
 * Date: 2014.10.12.
 * Time: 23:03
 */

class FictiveCompanyDataService extends \ODataProducer\DataService implements \ODataProducer\IServceProvider{

    public function getService($serviceType) {
        if ($serviceType === 'IDataServiceMetadataProvider') {
            if (is_null($this->_fictiveCompanyMetadata)) {
                $this->_finctiveCompanyMetadata = CreateFictiveCompanyMetadata::create();
            } return $this->_northWindMetadata;
        } else if ($serviceType === 'IDataServiceQueryProvider') {
            if (is_null($this->_fictiveCompanyQueryProvider)) {
                $this->_fictiveCompanyQueryProvider = new fictiveCompanyQueryProvider();
            } return $this->_fictiveCompanyQueryProvider;
        } else if ($serviceType === 'IDataServiceStreamProvider') {
            return new fictiveCompanyStreamProvider();
        }
        return null;
    }

}

?>