<?php
namespace Drupal\sas_document_viewer\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 * Provides a Sample block
 * @Block(
 * id = "Sample_Drupal_Block",
 * admin_label = @Translation("Drupal Sample Block"),
 * category = @Translation("The example drupal block"),
 * )
 */
class SampleBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        return[
            '#markup' => $this->getHtmlString(),
            '#attached' => array(
                'library' => array('sas_document_viewer/react-scripts'),
            ),
        ];
    }

    private function getHtmlString() {
        return '<div id="sas-document-viewer"></div>';
    }
}
