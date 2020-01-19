<?php
namespace AlTayerIns\CustomCatalog\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Setup\Exception;

class ProductUpdateConsumer
{
    /**
     * @var \Zend\Log\Logger
     */
    private $logger;

    /**
     * @var string
     */
    private $logFileName = 'altayer-product-update-consumer.log';

    /**
     * @var DirectoryList
     */
    private $directoryList;

    /**
     * @var EntityRepository
     */
    protected $productRepository;

    /**
     * DeleteConsumer constructor.
     * @param DirectoryList $directoryList
     * @param EntityRepository $productRepository
     */
    public function __construct(
        DirectoryList $directoryList,
        EntityRepository $productRepository
    ) {
        $this->directoryList = $directoryList;
        $this->productRepository = $productRepository;
    }

    /**
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityInterface $product
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    public function processMessage(\AlTayerIns\CustomCatalog\Api\Data\EntityInterface $product)
    {
            $this->productRepository->save($product);
            $this->writelog("Product Updated");
    }

    /**
     * @param $message
     * @throws \Magento\Framework\Exception\FileSystemException
     * @return void
     */
    private function writeLog($message)
    {
        $logDir = $this->directoryList->getPath('log');
        $writer = new \Zend\Log\Writer\Stream($logDir . DIRECTORY_SEPARATOR . $this->logFileName);
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $this->logger = $logger;
        $this->logger->info($message);
    }
}