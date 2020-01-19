<?php


namespace AlTayerIns\CustomCatalog\Api\Data;

interface EntitySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get entity list.
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface[]
     */
    public function getItems();

    /**
     * Set copywrite_info list.
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
