<?php

/**
 * @file
 * Contains \Drupal\sas_document_viewer\Form\SASDocumentViewerSettingsForm
 */
namespace Drupal\sas_document_viewer\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form to configure module settings
 */
class SASDocumentViewerSettingsForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'sas_document_viewer_admin_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'sas_document_viewer.settings'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('sas_document_viewer.settings');

        $form['your_message'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Your message'),
        '#default_value' => $config->get('variable_name'),
        ];
        return parent::buildForm($form, $form_state);
    
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->config('sas_document_viewer.settings')
          ->set('variable_name', $form_state->getValue('your_message'))
          ->save();
        parent::submitForm($form, $form_state);
    }
  
}
