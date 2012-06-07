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

class Dashboard_Controller_Ajax extends Zikula_Controller_AbstractAjax
{
    public function sortWidgets()
    {
        $this->checkAjaxToken();
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_EDIT));

        $widgets = $this->request->request->get('widgets');

        foreach ($widgets as $position => $id) {
            $item = $this->entityManager->getRepository('Dashboard_Entity_UserWidget')->findOneBy(array('id' => $id));
            $item->setPosition($position);
        }

        $this->entityManager->flush();

        return new Zikula_Response_Ajax(array());
    }

    public function setAddState()
    {
        $this->checkAjaxToken();
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_EDIT));

        $state = $this->request->request->get('state');
        $this->request->getSession()->set('dashboard/available_widget_checkbox', $state);

        return new Zikula_Response_Ajax(array());
    }
}
