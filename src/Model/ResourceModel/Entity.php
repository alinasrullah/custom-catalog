<?php


namespace AlTayerIns\CustomCatalog\Model\ResourceModel;

class Entity extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('altayerins_customcatalog_entity', 'entity_id');
    }
}
