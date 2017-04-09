<?php


namespace KikinbenShipping\CustomsShipping\Controller\Adminhtml\Customshipping;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('customshipping_id');
        
            $model = $this->_objectManager->create('KikinbenShipping\CustomsShipping\Model\Customshipping')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Customshipping no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the Customshipping.'));
                $this->dataPersistor->clear('kikinbenshipping_customsshipping_customshipping');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['customshipping_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Customshipping.'));
            }
        
            $this->dataPersistor->set('kikinbenshipping_customsshipping_customshipping', $data);
            return $resultRedirect->setPath('*/*/edit', ['customshipping_id' => $this->getRequest()->getParam('customshipping_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
