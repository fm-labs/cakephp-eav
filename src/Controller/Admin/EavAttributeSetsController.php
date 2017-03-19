<?php
namespace Eav\Controller\Admin;

use Eav\Controller\Admin\AppController;

/**
 * EavAttributeSets Controller
 *
 * @property \Eav\Model\Table\EavAttributeSetsTable $EavAttributeSets
 */
class EavAttributeSetsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('eavAttributeSets', $this->paginate($this->EavAttributeSets));
        $this->set('_serialize', ['eavAttributeSets']);
    }

    /**
     * View method
     *
     * @param string|null $id Eav Attribute Set id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eavAttributeSet = $this->EavAttributeSets->get($id, [
            'contain' => ['EavAttributeSetsAttributes', 'EavEntityAttributeValues']
        ]);
        $this->set('eavAttributeSet', $eavAttributeSet);
        $this->set('_serialize', ['eavAttributeSet']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eavAttributeSet = $this->EavAttributeSets->newEntity();
        if ($this->request->is('post')) {
            $eavAttributeSet = $this->EavAttributeSets->patchEntity($eavAttributeSet, $this->request->data);
            if ($this->EavAttributeSets->save($eavAttributeSet)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav attribute set')));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav attribute set')));
            }
        }
        $this->set(compact('eavAttributeSet'));
        $this->set('_serialize', ['eavAttributeSet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eav Attribute Set id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eavAttributeSet = $this->EavAttributeSets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eavAttributeSet = $this->EavAttributeSets->patchEntity($eavAttributeSet, $this->request->data);
            if ($this->EavAttributeSets->save($eavAttributeSet)) {
                $this->Flash->success(__('The {0} has been saved.', __('eav attribute set')));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', __('eav attribute set')));
            }
        }
        $this->set(compact('eavAttributeSet'));
        $this->set('_serialize', ['eavAttributeSet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eav Attribute Set id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eavAttributeSet = $this->EavAttributeSets->get($id);
        if ($this->EavAttributeSets->delete($eavAttributeSet)) {
            $this->Flash->success(__('The {0} has been deleted.', __('eav attribute set')));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', __('eav attribute set')));
        }
        return $this->redirect(['action' => 'index']);
    }
}
