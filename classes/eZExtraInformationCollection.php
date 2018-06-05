<?php

class eZExtraInformationCollection extends \eZInformationCollection
{
    /**
     * Anonymizes whole collection
     *
     * @param int $collectionID
     */
    static function anonymizeCollection( $collectionID )
    {
        if( !is_numeric( $collectionID ) )
        {
            return;
        }

        $db = eZDB::instance();

        $db->query(
        "UPDATE ezinfocollection_attribute
            SET data_float = 0,
            data_int = 0,
            data_text = 'xxxxxxxxxx'
            WHERE informationcollection_id = " . (int)$collectionID
        );
    }

    /**
     * Anonymizes given fields for collection
     *
     * @param int $collectionID
     * @param array $fieldIDs
     */
    static function anonymizeFieldForCollection( $collectionID, array $fieldIDs )
    {
        if( !is_numeric( $collectionID ) )
        {
            return;
        }

        if (empty($fieldIDs))
        {
            return;
        }

        $fieldIDs = array_map('intval',$fieldIDs);
        $fieldIDs = implode(",", $fieldIDs);

        $db = eZDB::instance();

        $db->query(
            "UPDATE ezinfocollection_attribute
            SET data_float = 0,
            data_int = 0,
            data_text = 'xxxxxxxxxx'
            WHERE informationcollection_id = " . (int)$collectionID
            . " AND contentobject_attribute_id IN ($fieldIDs)"
        );
    }

    /**
     * Removes fields from collection
     *
     * @param int $collectionID
     * @param array $fieldIDs
     */
    static function deleteAttributesForCollection( $collectionID, array $fieldIDs )
    {
        if( !is_numeric( $collectionID ) )
        {
            return;
        }

        if (empty($fieldIDs))
        {
            return;
        }

        $fieldIDs = array_map('intval',$fieldIDs);
        $fieldIDs = implode(",", $fieldIDs);

        $db = eZDB::instance();

        $db->query(
            "DELETE FROM ezinfocollection_attribute
            WHERE informationcollection_id = " . (int)$collectionID
            . " AND contentobject_attribute_id IN ($fieldIDs)"
        );
    }

    /**
     * Performs search withing collection attributes
     *
     * @param int $contentObjectID
     * @param string $searchText
     * @param int $offset
     * @param int $limit
     *
     * @return array
     */
    static function fetchCollectionsBySearchTest($contentObjectID, $searchText, $offset = 0, $limit = 10)
    {
        $objects = [];

        $db = eZDB::instance();

        $results = $db->arrayQuery(
        "SELECT id
            FROM ezinfocollection
            WHERE id in (SELECT informationcollection_id as id
                         FROM ezinfocollection_attribute
                         WHERE LOWER(data_text) like '%" . $db->escapeString(strtolower($searchText)) . "%')
            AND contentobject_id = " . (int)$contentObjectID,
            array(
                'offset' => (int)$offset,
                'limit' => (int)$limit,
            )
        );

        foreach ($results as $result) {
            $objects[] = eZInformationCollection::fetch($result['id']);
        }

        return $objects;
    }

    /**
     * Returns count for search
     *
     * @param int $contentObjectID
     * @param string $searchText
     *
     * @return int
     */
    static function fetchCollectionsCountBySearchTest($contentObjectID, $searchText)
    {
        $db = eZDB::instance();

        $results = $db->arrayQuery(
            "SELECT COUNT(id) as count
            FROM ezinfocollection
            WHERE id in (SELECT informationcollection_id as id
                         FROM ezinfocollection_attribute
                         WHERE LOWER(data_text) like '%" . $db->escapeString(strtolower($searchText)) . "%')
            AND contentobject_id = " . (int)$contentObjectID,
            array(
                "column" => array(
                    "count"
                ),
            )
        );

        return (int)$results[0]['count'];
    }
}
