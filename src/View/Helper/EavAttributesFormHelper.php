<?php

namespace Eav\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\FormHelper;
use Cake\View\Helper\HtmlHelper;

/**
 * @property HtmlHelper $Html
 * @property FormHelper $Form
 */
class EavAttributesFormHelper extends Helper
{
    public $helpers = ['Html', 'Form'];

    public function input($attributeName, $options = [])
    {
        return $this->Form->input($attributeName, $options);
    }

    public function availableInputs()
    {
    }
}
