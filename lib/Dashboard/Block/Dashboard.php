<?php
/**
 * Copyright Zikula Foundation 2012
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class Dashboard_Block_Dashboard extends Zikula_Controller_AbstractBlock
{
    /**
     * Initialize
     */
    public function init()
    {
        SecurityUtil::registerPermissionSchema('Dashboard::', '::');
    }

    /**
     * Metadata
     *
     * @return array The block information
     */
    public function info()
    {
        return array('module'          => $this->name,
                     'text_type'       => $this->__('Dashboard'),
                     'text_type_long'  => $this->__('Dashboard block'),
                     'allow_multiple'  => true,
                     'form_content'    => false,
                     'form_refresh'    => false,
                     'show_preview'    => true,
                     'admin_tableless' => true);
    }

    /**
     * Display block.
     *
     * @param  array  $blockInfo a blockinfo structure
     *
     * @return string html block
     */
    public function display($blockInfo)
    {
        if (!SecurityUtil::checkPermission('Dashboard::', "::", ACCESS_READ)) {
            return;
        }

        // Break out options from our content field
        $vars = BlockUtil::varsFromContent($blockInfo['content']);

        if ($this->view->getCaching()) {
            $this->view->setCacheId($blockInfo['bkey'].'/bid'.$blockInfo['bid'].'/'.UserUtil::getGidCacheString());

            if ($this->view->is_cached('Block/dashboard.html.tpl')) {
                $blockInfo['content'] = $this->view->fetch('Block/dashboard.html.tpl');

                return BlockUtil::themeBlock($blockInfo);
            }
        }

        $uid = $this->request->getSession()->get('uid');

        $helper = new Dashboard_Helper_WidgetHelper($this->entityManager);
        $dashboard = $helper->getUserWidgets($uid);

        $this->view->assign('userWidgets', $dashboard);

        // get the block content
        $blockInfo['content'] = $this->view->fetch('Block/dashboard.html.tpl');

        // pass the block array back to the theme for display
        return BlockUtil::themeBlock($blockInfo);
    }

    /**
     * Modify block settings
     *
     * @param array $blockInfo blockinfo array
     *
     * @return string block form html
     */
    public function modify($blockInfo)
    {
        // Break out options from our content field
        $vars = BlockUtil::varsFromContent($blockInfo['content']);

        $this->view->setCaching(Zikula_View::CACHE_DISABLED);
        $this->view->assign('dashboard_vars', $vars);

        return $this->view->fetch('Block/dashboard_modify.html.tpl');
    }

    /**
     * Update block settings
     *
     * @param array $blockInfo blockinfo array
     *
     * @return array $blockinfo
     */
    public function update($blockInfo)
    {
        $vars = BlockUtil::varsFromContent($blockInfo['content']);

        // write back the new contents
        $blockInfo['content'] = BlockUtil::varsToContent($vars);

        // clear the block cache
        $this->view->clear_cache(null, $blockInfo['bkey'].'/bid'.$blockInfo['bid']);

        // and clear the theme cache
        Zikula_View_Theme::getInstance()->clear_cache();

        return $blockInfo;
    }
}
