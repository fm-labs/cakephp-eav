<?php
namespace Eav\Controller\Admin;

use Eav\Controller\Admin\AppController;

/**
 * EavAttributes Controller
 *
 * @property \Eav\Model\Table\EavAttributesTable $EavAttributes
 */
class EavAttributesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('eavAttributes', $this->paginate($this->EavAttributes));
        $this->set('_serialize', ['eavAttributes']);
    }

    /**
     * View method
     *
     * @param string|null $id Eav Attribute id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eavAttribute = $this->EavAttributes->get($id, [
            'contain' => ['EavAttributeSetsAttributes', 'EavEntityAttributeValues']
        ]);
        $this->set('eavAttribute', $eavAttribute);
        $this->set('_serialize', ['eavAttribute']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eavAttribute = $this->EavAttributes->newEntity();
        if ($this->request->is('post')) {
            $eavAttribute = $this->EavAttributes->patchEntity($eavAttribute, $this->request->data);
            if ($this->EavAttributes->save($eavAttribute)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav attribute')));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav attribute')));
            }
        }
        $this->set(compact('eavAttribute'));
        $this->set('_serialize', ['eavAttribute']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eav Attribute id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eavAttribute = $this->EavAttributes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eavAttribute = $this->EavAttributes->patchEntity($eavAttribute, $this->request->data);
            if ($this->EavAttributes->save($eavAttribute)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav attribute')));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav attribute')));
            }
        }
        $this->set(compact('eavAttribute'));
        $this->set('_serialize', ['eavAttribute']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eav Attribute id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eavAttribute = $this->EavAttributes->get($id);
        if ($this->EavAttributes->delete($eavAttribute)) {
            $this->Flash->success(__('The {0} has been deleted.', __('eav attribute')));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', __('eav attribute')));
        }

        return $this->redirect(['action' => 'index']);
    }
}
