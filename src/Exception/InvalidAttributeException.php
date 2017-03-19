<?php
namespace Eav\Exception;

use Cake\Core\Exception\Exception as CakeCoreException;

class InvalidAttributeException extends CakeCoreException
{
    protected $_messageTemplate = 'Attribute %s not found';
}