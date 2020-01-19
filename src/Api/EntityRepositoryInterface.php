<?php


namespace AlTayerIns\CustomCatalog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface EntityRepositoryInterface
{

    /**
     * Save entity
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
    );

    /**
     * Retrieve entity
     * @param string $entityId
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

    /**
     * Retrieve entity matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntitySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete entity
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
    );

    /**
     * Delete entity by ID
     * @param string $entityId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entityId);

    /**
     * GET for getByVpn api
     * @param string $productVpn
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByVpn($productVpn);

    /**
     * Update product
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
   public function processUpdate(
        \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
    );
}
