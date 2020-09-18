<?php

/**
 * @file
 * Contains \Drupal\sas_document_viewer\Form\SASDocumentViewerSettingsForm
 */
namespace Drupal\sas_document_viewer\Form;
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Componentj\HttpFoundation\Request;
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
    public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
        $types = node_type_get_name();
        $config = $this->config('sas_document_viewer.settings');
        $form['sas_document_viewer_types'] = array(
            '#type' => 'checkboxes',
            '#title' => $this->t('The content types to enable sas_document_viewer on.'),
            '#default_value' => $config->get('allowed_types'),
            '#options' => $types,
            '#description' => t('On the specified node types, sas document viewer option will be available and can be enables whiel that node is being edited'),
        );
        $form['array_filter'] = array('#type' => 'value', '#value' => TRUE);
        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $allowed_types = array_filter($form_state->getValue('sas_document_viewer_types'));
        sort($allowed_types);
        $this->config('sas_document_viewer.settings')
            ->set('allowed_types', $allowed_types)
            ->save();
            parent::submitForm($form, $form_state);
    }
}
