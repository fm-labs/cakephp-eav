<?php
namespace Eav\Controller\Admin;

use Eav\Controller\Admin\AppController;

/**
 * EavAttributeSetsAttributes Controller
 *
 * @property \Eav\Model\Table\EavAttributeSetsAttributesTable $EavAttributeSetsAttributes
 */
class EavAttributeSetsAttributesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EavAttributeSets', 'EavAttributes']
        ];
        $this->set('eavAttributeSetsAttributes', $this->paginate($this->EavAttributeSetsAttributes));
        $this->set('_serialize', ['eavAttributeSetsAttributes']);
    }

    /**
     * View method
     *
     * @param string|null $id Eav Attribute Sets Attribute id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eavAttributeSetsAttribute = $this->EavAttributeSetsAttributes->get($id, [
            'contain' => ['EavAttributeSets', 'EavAttributes']
        ]);
        $this->set('eavAttributeSetsAttribute', $eavAttributeSetsAttribute);
        $this->set('_serialize', ['eavAttributeSetsAttribute']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eavAttributeSetsAttribute = $this->EavAttributeSetsAttributes->newEntity();
        if ($this->request->is('post')) {
            $eavAttributeSetsAttribute = $this->EavAttributeSetsAttributes->patchEntity($eavAttributeSetsAttribute, $this->request->data);
            if ($this->EavAttributeSetsAttributes->save($eavAttributeSetsAttribute)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav attribute sets attribute')));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav attribute sets attribute')));
            }
        }
        $eavAttributeSets = $this->EavAttributeSetsAttributes->EavAttributeSets->find('list', ['limit' => 200]);
        $eavAttributes = $this->EavAttributeSetsAttributes->EavAttributes->find('list', ['limit' => 200]);
        $this->set(compact('eavAttributeSetsAttribute', 'eavAttributeSets', 'eavAttributes'));
        $this->set('_serialize', ['eavAttributeSetsAttribute']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eav Attribute Sets Attribute id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eavAttributeSetsAttribute = $this->EavAttributeSetsAttributes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eavAttributeSetsAttribute = $this->EavAttributeSetsAttributes->patchEntity($eavAttributeSetsAttribute, $this->request->data);
            if ($this->EavAttributeSetsAttributes->save($eavAttributeSetsAttribute)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav attribute sets attribute')));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav attribute sets attribute')));
            }
        }
        $eavAttributeSets = $this->EavAttributeSetsAttributes->EavAttributeSets->find('list', ['limit' => 200]);
        $eavAttributes = $this->EavAttributeSetsAttributes->EavAttributes->find('list', ['limit' => 200]);
        $this->set(compact('eavAttributeSetsAttribute', 'eavAttributeSets', 'eavAttributes'));
        $this->set('_serialize', ['eavAttributeSetsAttribute']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eav Attribute Sets Attribute id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eavAttributeSetsAttribute = $this->EavAttributeSetsAttributes->get($id);
        if ($this->EavAttributeSetsAttributes->delete($eavAttributeSetsAttribute)) {
            $this->Flash->success(__('The {0} has been deleted.', __('eav attribute sets attribute')));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', __('eav attribute sets attribute')));
        }

        return $this->redirect(['action' => 'index']);
    }
}
