<?php

class eZExtraInformationCollection extends \eZInformationCollection
{
    static function anonymizeCollection( $collectionID )
    {
        if( !is_numeric( $collectionID ) )
        {
            return;
        }

        $db = eZDB::instance();

        $db->query("UPDATE ezinfocollection_attribute
                    SET data_float = 0,
                    data_int = 0,
                    data_text = 'xxxxxxxxxx'
                    WHERE informationcollection_id = '$collectionID'"
        );
    }

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

        $fieldIDs = implode(",", $fieldIDs);

        $db = eZDB::instance();

        $db->query("UPDATE ezinfocollection_attribute
                SET data_float = 0,
                data_int = 0,
                data_text = 'xxxxxxxxxx'
                WHERE informationcollection_id = '$collectionID'
                AND contentobject_attribute_id IN ($fieldIDs)"
        );
    }

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

        $fieldIDs = implode(",", $fieldIDs);

        $db = eZDB::instance();


        $db->query("DELETE FROM ezinfocollection_attribute
                WHERE informationcollection_id = '$collectionID'
                AND contentobject_attribute_id IN ($fieldIDs)"
        );
    }

    static function fetchCollectionsBySearchTest($contentObjectID, $searchText, $offset = 0, $limit = null)
    {
        $objects = [];

        $db = eZDB::instance();

        $searchText = strtolower($searchText);

        $queryString = "SELECT id
                        FROM ezinfocollection
                        WHERE id in (SELECT informationcollection_id as id
			                         FROM ezinfocollection_attribute
			                         WHERE LOWER(data_text) like '%$searchText%')
                        AND contentobject_id = $contentObjectID
                        LIMIT $offset, $limit";

        $results = $db->query($queryString);

        foreach ($results->fetch_all() as $result) {
            $objects[] = eZInformationCollection::fetch($result[0]);
        }

        return $objects;
    }

    static function fetchCollectionsCountBySearchTest($contentObjectID, $searchText)
    {
        $db = eZDB::instance();

        $searchText = strtolower($searchText);

        $queryString = "SELECT COUNT(id) as count
                        FROM ezinfocollection
                        WHERE id in (SELECT informationcollection_id as id
			                         FROM ezinfocollection_attribute
			                         WHERE LOWER(data_text) like '%$searchText%')
                        AND contentobject_id = $contentObjectID";

        $results = $db->query($queryString);

        $result = $results->fetch_assoc();

        return $result['count'];
    }
}
