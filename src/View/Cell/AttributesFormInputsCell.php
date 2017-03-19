<?php

namespace Eav\View\Cell;

use Cake\Datasource\EntityInterface;
use Cake\Log\Log;
use Cake\ORM\Exception\RolledbackTransactionException;
use Cake\View\Cell;
use Eav\Model\EntityAttributesInterface;
use Eav\Model\Table\EavAttributesTable;

/**
 * Class AttributesFormInputs
 *
 * @package Eav\View\Cell
 * @property EavAttributesTable $EavAttributes
 */
class AttributesFormInputsCell extends Cell
{
    public function display(EntityInterface $entity = null, $modelName = null)
    {
        if (!$entity) {
            throw new \Exception("Entity missing");
        }
        if (!$modelName) {
            throw new \Exception("Model name missing");
        }

        if (!($entity instanceof EntityAttributesInterface)) {
            throw new \Exception("Entity is not an instance of EntityAttributesInterface: " . get_class($entity));
        }

        $Table = $this->loadModel($modelName);

        $errors = [];
        if ($this->request->is(['put', 'post'])) {
            $entity = $Table->patchEntity($entity, $this->request->data);

            try {

                if (!$Table->save($entity)) {
                    debug("Saving failed");
                    $errors = $entity->errors();
                }

            } catch (RolledbackTransactionException $ex) {
                debug("Saving failed: " . $ex->getMessage());

            } catch (\Exception $ex) {
                debug($ex->getMessage());
                Log::error('Exception thrown while updating entity attributes: ' . $ex->getMessage());
            }

            //$errors = $Table->validateAttributes($entity, $entity->attributes);
        }

        // loop available attributes
        // create a form input for each attribute respecting its attribute type

        // pass form input definitions to template renderer
        $attrsAvail = $entity->getAttributesAvailable();
        $this->set('attrsAvail', $attrsAvail);
        $this->set('entity', $entity);
        $this->set('errors', $errors);
    }
}