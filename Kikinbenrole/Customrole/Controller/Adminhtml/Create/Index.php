<?php

protected function _isAllowed()
{
 return $this->_authorization->isAllowed('Kikinbenrole_CustomMenu::menu');
}

?>
