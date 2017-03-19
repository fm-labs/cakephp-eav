<?php

namespace Eav\Test\TestCase\Model\Entity;


use Cake\ORM\Entity;
use Eav\Model\EntityAttributesInterface;
use Eav\Model\EntityAttributesTrait;

class EavTestEntity extends Entity implements EntityAttributesInterface
{
    use EntityAttributesTrait;

    protected $_accessible = [
        'id' => true,
        '*' => true
    ];
}