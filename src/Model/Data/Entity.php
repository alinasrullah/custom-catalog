<?php


namespace AlTayerIns\CustomCatalog\Model\Data;

use AlTayerIns\CustomCatalog\Api\Data\EntityInterface;

class Entity extends \Magento\Framework\Api\AbstractExtensibleObject implements EntityInterface
{

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get copywrite_info
     * @return string|null
     */
    public function getCopywriteInfo()
    {
        return $this->_get(self::COPYWRITE_INFO);
    }

    /**
     * Set copywrite_info
     * @param string $copywriteInfo
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setCopywriteInfo($copywriteInfo)
    {
        return $this->setData(self::COPYWRITE_INFO, $copywriteInfo);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \AlTayerIns\CustomCatalog\Api\Data\EntityExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \AlTayerIns\CustomCatalog\Api\Data\EntityExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get product_vpn
     * @return string|null
     */
    public function getProductVpn()
    {
        return $this->_get(self::PRODUCT_VPN);
    }

    /**
     * Set product_vpn
     * @param string $productVpn
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setProductVpn($productVpn)
    {
        return $this->setData(self::PRODUCT_VPN, $productVpn);
    }

    /**
     * Get product_sku
     * @return string|null
     */
    public function getProductSku()
    {
        return $this->_get(self::PRODUCT_SKU);
    }

    /**
     * Set product_sku
     * @param string $productSku
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setProductSku($productSku)
    {
        return $this->setData(self::PRODUCT_SKU, $productSku);
    }

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId()
    {
        return $this->_get(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $productId
     * @return \AlTayerIns\CustomCatalog\Api\Data\EntityInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }
}
