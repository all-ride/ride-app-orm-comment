<?php

namespace ride\application\orm\model;

use ride\library\orm\model\GenericModel;

/**
 * Model of the comments
 */
class CommentModel extends GenericModel {

    /**
     * Gets the name of the current user
     * @param string $type Type of the entry
     * @param string $entry Identifier of the entry
     * @param string $locale Code of the locale
     * @param boolean $isApproved Set to true to fetch only approved comments
     * @param integer $rows Number of comments to fetch
     * @param integer $page Number of the page
     * @return string|null
     */
    public function getComments($type, $entry, $locale = null, $isApproved = null, $rows = 0, $page = 1) {
        $query = $this->createQuery();
        $query->addCondition('{type} = %1% AND {entry} = %2%', $type, $entry);
        $query->addOrderBy('{dateAdded} ASC');

        if ($locale !== null) {
            $query->addCondition('{locale} = %1%', $locale);
        }

        if ($isApproved !== null) {
            $query->addCondition('{isApproved} = %1%', $isApproved);
        }

        if ($rows && $page) {
            $query->setLimit($rows, ($page - 1) * $rows);
        }

        return $query->query();
    }

}
