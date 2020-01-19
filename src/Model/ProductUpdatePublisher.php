<?php
namespace AlTayerIns\CustomCatalog\Model;

use Magento\Framework\MessageQueue\PublisherInterface;
class ProductUpdatePublisher
{
    const TOPIC_NAME = 'altayer.product.update';

    /**
     * @var \Magento\Framework\MessageQueue\PublisherInterface
     */
    private $publisher;

    /**
     * @param PublisherInterface $publisher
     */
    public function __construct( PublisherInterface $publisher )
    {
        $this->publisher = $publisher;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(\AlTayerIns\CustomCatalog\Api\Data\EntityInterface $entity)
    {
       $this->publisher->publish(self::TOPIC_NAME, $entity);
    }
}