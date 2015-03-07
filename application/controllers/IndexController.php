<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->headLink()->appendStylesheet(WWW.'/public/css/style.css');
        $this->view->headScript()->appendFile(WWW.'/public/js/script.js');
    }

    public function indexAction()
    {
        $users = new Application_Model_DbTable_users();
        $form = new Application_Form_form1();
        
        if ($this->_request->isPost()) { 
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $data = array (
                    'name' => $formData['firstName'],
                    'surname' => $formData['lastName'],
                    'email' => $formData['email'],
                    'password' => md5($formData['password']) // mozna uzyc zendowskiej klasy do hasel wraz z Saltem(stalym kodem)
                );
                try {
                    $users->save($data);
                } catch (Exception $e) {
                    exit;
                }
                $this->sendMail($data['email']);
            }
            else {
                $form->populate($formData);
            }
        }
        
        $this->view->form = $form;
    }
    
    private function sendMail($emailTo ){
        if (empty($emailTo)) return;
        $mail = new Zend_Mail();
        $mail->setBodyText('Hello world!');
        //$mail->setFrom('somebody@example.com', 'Some Sender');
        $mail->addTo($emailTo, 'Odbiorca');
        $mail->setSubject('Temat');
        $mail->send();    
    }
    
    public function ajaxAction(){
        if ($this->_request->isPost()) {
            $data = $this->getRequest()->getPost();
            $users = new Application_Model_DbTable_users();
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->getHelper('layout')->disableLayout();
            
            $if_exists = $users->check_if_exists('email', $data['email']);
            $result = ($if_exists) ? '0' : '1';
            echo $result;
        }
    }


}

