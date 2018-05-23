<?php

$Module = array( 'name' => 'nginfocollector' );

$ViewList = array();

$ViewList['extracollectionlist'] = array(
    'script' => 'extracollectionlist.php',
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezsetupnavigationpart',
    'ui_context' => 'view',
    'params' => array( 'ObjectID' ),
    'unordered_params' => array( 'offset' => 'Offset' ),
    'single_post_actions' => array(
        'SearchCollectionsButton' => 'SearchCollections',
        'RemoveCollectionsButton' => 'RemoveCollections',
        'RemoveFieldsButton' => 'RemoveFields',
        'ConfirmRemoveButton' => 'ConfirmRemoval',
        'CancelRemoveButton' => 'CancelRemoval',
        'AnonymizeCollectionsButton' => 'AnonymizeCollections',
        'AnonymizeFieldsButton' => 'AnonymizeFields',
        'ConfirmAnonymizationButton' => 'ConfirmAnonymization',
        'CancelAnonymizationButton' => 'CancelAnonymization',
    )
);


$FunctionList = array();
$FunctionList['read'] = array();

?>
