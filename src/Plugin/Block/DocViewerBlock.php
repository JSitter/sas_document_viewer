<?php
namespace Drupal\sas_document_viewer\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 * Provides a block to browse and view SAS Archive documents.
 * @Block(
 * id = "sas_document_viewer_block",
 * admin_label = @Translation("SAS Document Viewer Block"),
 * category = @Translation("Browse and view SAS documents."),
 * )
 */
class DocViewerBlock extends BlockBase {
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
