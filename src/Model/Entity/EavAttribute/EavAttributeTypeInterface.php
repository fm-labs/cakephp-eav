<?php

namespace Eav\Model\Entity\EavAttribute;


use Banana\Model\EntityTypeInterface;

interface EavAttributeTypeInterface extends EntityTypeInterface
{
    /**
     * Returns the database data type
     *
     * @return string
     */
    public function getDbType();

}