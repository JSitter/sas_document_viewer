<?php
/**
 * Remember php??
 * array_keys($contentTypes)
 * count($contentTypes)
 * sizeof($contentTypes)
 * 
 * foreach ($contentTypes as $value) {
 *  $value
 * }
 * 
 * foreach ($contentTypes as $key => $value) {
 * $key 
 * $value
 * }
 */

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

        $contentTypes = $this->getContentTypes();
        
        foreach ($contentTypes as $key => $value) {
            $options = $this->getFieldNames($key);

            $form['enable'.$key] = [
                '#type' => 'checkbox',
                '#title' => $this->t('Enable browser for '.$key),
                ];

            $form[$key.'fields'] = [
                '#type' => 'select',
                '#title' => 'Select field to group '.$key.' by',
                '#options' =>  $options,
                '#description' => "Select Field",
            ];

            $form[$key.'levels'] = [
                '#type' => 'select',
                '#title' => 'Grouping Levels',
                '#options' =>  array(
                    '1' => t('1'),
                    '2' => t('2'),
                ),
                '#description' => "Select number of groupings",
            ];
            
        }
        
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
  
    /**
     * {@inheritdoc}
     */
    protected function getContentTypes() {
        $result = \Drupal::entityTypeManager()
            ->getStorage('node_type')
            ->loadMultiple();

        return $result;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getFieldNames($node_name) {
        $result = \Drupal::entityManager()
            ->getFieldDefinitions('node', $node_name);
        $nodeArray = array();
        foreach (array_keys($result) as $val) {
            $nodeArray[$val] = t($val);
        }

        return $nodeArray;
    }
}
