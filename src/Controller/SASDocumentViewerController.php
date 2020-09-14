<?php
namespace Drupal\sas_document_viewer\Controller;
class SASDocumentViewerController {
    public function welcome() {
        return array(
            '#markup' => 'Welcome to the document viewer page'
        );
    }
}
