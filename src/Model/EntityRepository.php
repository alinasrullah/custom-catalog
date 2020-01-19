<?php


namespace AlTayerIns\CustomCatalog\Model;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use AlTayerIns\CustomCatalog\Api\Data\EntitySearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use AlTayerIns\CustomCatalog\Api\Data\EntityInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use AlTayerIns\CustomCatalog\Model\ResourceModel\Entity\CollectionFactory as EntityCollectionFactory;
use AlTayerIns\CustomCatalog\Model\ResourceModel\Entity as ResourceEntity;
use AlTayerIns\CustomCatalog\Api\EntityRepositoryInterface;
use AlTayerIns\CustomCatalog\Model\ProductUpdatePublisher;
use Magento\Framework\Exception\NoSuchEntityException;

class EntityRepository implements EntityRepositoryInterface
{
    const PRODUCT_VPN = 'product_vpn';

    protected $dataObjectHelper;

    private $storeManager;

    protected $entityFactory;

    protected $entityCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    protected $resource;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $dataEntityFactory;
    protected $productUpdatePublisher;


    /**
     * @param ResourceEntity $resource
     * @param EntityFactory $entityFactory
     * @param EntityInterfaceFactory $dataEntityFactory
     * @param EntityCollectionFactory $entityCollectionFactory
     * @param EntitySearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     * @param ProductUpdatePublisher $productUpdatePublisher
     */
    public function __construct(
        ResourceEntity $resource,
        EntityFactory $entityFactory,
        EntityInterfaceFactory $dataEntityFactory,
        EntityCollectionFactory $entityCollectionFactory,
        EntitySearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        ProductUpdatePublisher $productUpdatePublisher
    ) {
        $this->resource = $resource;
        $this->entityFactory = $entityFactory;
        $this->entityCollectionFactory = $entityCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataEntityFactory = $dataEntityFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->productUpdatePublisher = $productUpdatePublisher;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity) {
        /* if (empty($entity->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $entity->setStoreId($storeId);
        } */
        
        $entityData = $this->extensibleDataObjectConverter->toNestedArray(
            $entity,
            [],
            \AlTayerIns\CustomCatalog\Api\Data\EntityInterface::class
        );
        
        $entityModel = $this->entityFactory->create()->setData($entityData);
        
        try {
            $this->resource->save($entityModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the entity: %1',
                $exception->getMessage()
            ));
        }
        return $entityModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($entityId)
    {
        $entity = $this->entityFactory->create();
        $this->resource->load($entity, $entityId);
        if (!$entity->getId()) {
            throw new NoSuchEntityException(__('entity with id "%1" does not exist.', $entityId));
        }
        return $entity->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->entityCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \AlTayerIns\CustomCatalog\Api\Data\EntityInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity
    ) {
        try {
            $entityModel = $this->entityFactory->create();
            $this->resource->load($entityModel, $entity->getEntityId());
            $this->resource->delete($entityModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the entity: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($entityId)
    {
        return $this->delete($this->getById($entityId));
    }

    /**
     * {@inheritdoc}
     */
    public function getByVpn($productVpn)
    {
        $product = $this->entityFactory->create();
        $this->resource->load($product, $productVpn,self::PRODUCT_VPN);
        if (!$product->getId()) {
            throw new NoSuchEntityException(__('Product with id "%1" does not exist.', $product));
        }
        return $product->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function processUpdate(\AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity)
    {
        $this->productUpdatePublisher->execute($entity);
        echo 'Request added to queue for processing';
    }
}
