<?php


namespace AlTayerIns\CustomCatalog\Model;

use AlTayerIns\CustomCatalog\Api\Data\EntityInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use AlTayerIns\CustomCatalog\Api\Data\EntityInterface;

class Entity extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'altayerins_customcatalog_entity';
    protected $entityDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param EntityInterfaceFactory $entityDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \AlTayerIns\CustomCatalog\Model\ResourceModel\Entity $resource
     * @param \AlTayerIns\CustomCatalog\Model\ResourceModel\Entity\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        EntityInterfaceFactory $entityDataFactory,
        DataObjectHelper $dataObjectHelper,
        \AlTayerIns\CustomCatalog\Model\ResourceModel\Entity $resource,
        \AlTayerIns\CustomCatalog\Model\ResourceModel\Entity\Collection $resourceCollection,
        array $data = []
    ) {
        $this->entityDataFactory = $entityDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve entity model with entity data
     * @return EntityInterface
     */
    public function getDataModel()
    {
        $entityData = $this->getData();
        
        $entityDataObject = $this->entityDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $entityDataObject,
            $entityData,
            EntityInterface::class
        );
        
        return $entityDataObject;
    }
}
