<?php
/**
 * Created by PhpStorm.
 * User: manuele
 * Date: 01/07/15
 * Time: 17:21
 */

class Webgriffe_CmsHelper_Model_Entity_Setup extends Mage_Eav_Model_Entity_Setup
{
    /**
     * @param $identifier
     * @param array $data
     * @param array $stores
     * @return Mage_Cms_Model_Page
     */
    public function updateCmsPage($identifier, $data = array(), $stores = array(1)) {
        /** @var Mage_Cms_Model_Page $page */
        $page = Mage::getModel('cms/page');
        $page->setStoreId($stores[0])->load($identifier, 'identifier');

        if (!$page->getId()) {
            return $page;
        }

        return $page->addData($data)->save();
    }

    /**
     * @param $title
     * @param $identifier
     * @param string $content
     * @param int $isActive
     * @param int $sortOrder
     * @param array $stores
     * @param string $rootTemplate
     * @return Mage_Cms_Model_Page
     */
    public function createCmsPage(
        $title,
        $identifier,
        $content = '',
        $isActive = 1,
        $sortOrder = 0,
        $stores = array(1),
        $rootTemplate = 'one_column'
    ) {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        $data = array(
            'title' => $title,
            'identifier' => $identifier,
            'content' => $content,
            'is_active' => $isActive,
            'sort_order' => $sortOrder,
            'stores' => $stores,
            'root_template' => $rootTemplate
        );

        return Mage::getModel('cms/page')->setData($data)->save();
    }
}
