<?php


namespace AlTayerIns\CustomCatalog\Api\Data;

interface EntityInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const PRODUCT_ID = 'product_id';
    const ENTITY_ID = 'entity_id';
    const PRODUCT_SKU = 'product_sku';
    const COPYWRITE_INFO = 'copywrite_info';
    const PRODUCT_VPN = 'product_vpn';

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setEntityId($entityId);

    /**
     * Get copywrite_info
     * @return string|null
     */
    public function getCopywriteInfo();

    /**
     * Set copywrite_info
     * @param string $copywriteInfo
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setCopywriteInfo($copywriteInfo);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \AlTayerIns\CustomCatalog\Api\Data\EntityExtensionInterface $extensionAttributes
    );

    /**
     * Get product_vpn
     * @return string|null
     */
    public function getProductVpn();

    /**
     * Set product_vpn
     * @param string $productVpn
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setProductVpn($productVpn);

    /**
     * Get product_sku
     * @return string|null
     */
    public function getProductSku();

    /**
     * Set product_sku
     * @param string $productSku
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setProductSku($productSku);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $productId
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setProductId($productId);
}
