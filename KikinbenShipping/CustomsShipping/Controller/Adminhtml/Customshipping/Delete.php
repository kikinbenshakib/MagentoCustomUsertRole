<?php


namespace KikinbenShipping\CustomsShipping\Controller\Adminhtml\Customshipping;

class Delete extends \KikinbenShipping\CustomsShipping\Controller\Adminhtml\Customshipping
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('customshipping_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('KikinbenShipping\CustomsShipping\Model\Customshipping');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the Customshipping.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['customshipping_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a Customshipping to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
