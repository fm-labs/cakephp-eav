<?php

namespace Eav\Model;

use Cake\Datasource\ResultSetInterface;
use Cake\ORM\ResultSet;

interface EntityAttributesInterface
{
    /**
     * @return mixed
     */
    public function getAttributes();

    /**
     * @param $code
     * @return mixed
     */
    //public function getAttribute($code);

    /**
     * @param $code
     * @param null $val
     * @return mixed
     */
    //public function setAttribute($code, $val = null);

    /**
     * @return array
     */
    public function getAttributesAvailable();
}
