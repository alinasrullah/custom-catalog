<?php


namespace AlTayerIns\CustomCatalog\Model\ResourceModel\Entity;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \AlTayerIns\CustomCatalog\Model\Entity::class,
            \AlTayerIns\CustomCatalog\Model\ResourceModel\Entity::class
        );
    }
}
