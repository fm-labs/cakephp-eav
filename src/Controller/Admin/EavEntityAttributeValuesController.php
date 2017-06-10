<?php
namespace Eav\Controller\Admin;

use Eav\Controller\Admin\AppController;

/**
 * EavEntityAttributeValues Controller
 *
 * @property \Eav\Model\Table\EavEntityAttributeValuesTable $EavEntityAttributeValues
 */
class EavEntityAttributeValuesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EavAttributes', 'EavAttributeSets']
        ];
        $this->set('eavEntityAttributeValues', $this->paginate($this->EavEntityAttributeValues));
        $this->set('_serialize', ['eavEntityAttributeValues']);
    }

    /**
     * View method
     *
     * @param string|null $id Eav Entity Attribute Value id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eavEntityAttributeValue = $this->EavEntityAttributeValues->get($id, [
            'contain' => ['EavAttributes', 'EavAttributeSets']
        ]);
        $this->set('eavEntityAttributeValue', $eavEntityAttributeValue);
        $this->set('_serialize', ['eavEntityAttributeValue']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eavEntityAttributeValue = $this->EavEntityAttributeValues->newEntity();
        if ($this->request->is('post')) {
            $eavEntityAttributeValue = $this->EavEntityAttributeValues->patchEntity($eavEntityAttributeValue, $this->request->data);
            if ($this->EavEntityAttributeValues->save($eavEntityAttributeValue)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav entity attribute value')));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav entity attribute value')));
            }
        }
        $eavAttributes = $this->EavEntityAttributeValues->EavAttributes->find('list', ['limit' => 200]);
        $eavAttributeSets = $this->EavEntityAttributeValues->EavAttributeSets->find('list', ['limit' => 200]);
        $this->set(compact('eavEntityAttributeValue', 'eavAttributes', 'eavAttributeSets'));
        $this->set('_serialize', ['eavEntityAttributeValue']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eav Entity Attribute Value id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eavEntityAttributeValue = $this->EavEntityAttributeValues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eavEntityAttributeValue = $this->EavEntityAttributeValues->patchEntity($eavEntityAttributeValue, $this->request->data);
            if ($this->EavEntityAttributeValues->save($eavEntityAttributeValue)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav entity attribute value')));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav entity attribute value')));
            }
        }
        $eavAttributes = $this->EavEntityAttributeValues->EavAttributes->find('list', ['limit' => 200]);
        $eavAttributeSets = $this->EavEntityAttributeValues->EavAttributeSets->find('list', ['limit' => 200]);
        $this->set(compact('eavEntityAttributeValue', 'eavAttributes', 'eavAttributeSets'));
        $this->set('_serialize', ['eavEntityAttributeValue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eav Entity Attribute Value id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eavEntityAttributeValue = $this->EavEntityAttributeValues->get($id);
        if ($this->EavEntityAttributeValues->delete($eavEntityAttributeValue)) {
            $this->Flash->success(__('The {0} has been deleted.', __('eav entity attribute value')));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', __('eav entity attribute value')));
        }

        return $this->redirect(['action' => 'index']);
    }
}
