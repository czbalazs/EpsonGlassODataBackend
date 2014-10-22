<?php
/**
 * Created by PhpStorm.
 * User: Balázs
 * Date: 2014.10.22.
 * Time: 16:59
 */

namespace ODataProducer\Providers\Metadata;


class MetadataMapping {

    public function mapEntity($entityName,$mappedEntityName)
    {
        $this->entityMappingInfo[$entityName] = $mappedEntityName;
        $this->mappingDetail[$entityName] = Array();
    }

    public function mapProperty($entityName,$metaPropertyName,$dsPropertyName)
    {
        $this->mappingDetail[$entityName][$metaPropertyName] = $dsPropertyName;
    }

} 