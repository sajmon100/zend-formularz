<?php

class Application_Form_form1 extends Zend_Form
{

    public function init()
    {
        //parent::__construct();
        $this->setName('Formularz');
        $this->setMethod('post');
        
        $firstName = new Zend_Form_Element_Text('firstName');
        $firstName->setLabel('Imię')
                  ->setRequired(true)
                  ->addValidator('NotEmpty');

        $lastName = new Zend_Form_Element_Text('lastName');
        $lastName->setLabel('Nazwisko')
                 ->setRequired(true)
                 ->addValidator('NotEmpty');
             
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
              ->addFilter('StringToLower')
              ->setRequired(true)
              ->addValidator('NotEmpty', true)
              ->addValidator('EmailAddress');
             
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Hasło (min. 5 i jedna duża litera oraz jedna cyfra)')
                 ->setRequired(true)
                 ->addValidator('NotEmpty', true)
                 ->addValidator(new Zend_Validate_StringLength(array('min' => 5)))
                 ->addValidator(new Zend_Validate_Regex(array('pattern' => '/(?=.*\d)(?=.*[A-Z]).+/')));
              
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Wyślij');
        
        $this->addElements(array( $firstName, 
            $lastName, $email, $password, $submit));
        
        // decorators
        $this->clearDecorators();
        $this->addDecorator('FormElements')
        ->addDecorator('HtmlTag', array('tag' => '<div>'))
        ->addDecorator('Form');
        
        $this->setElementDecorators(array(
        array('ViewHelper'),
        array('Errors'),
        array('Description'),
        array('Label', array('separator'=>' ')),
        array('HtmlTag', array('tag' => 'p', 'class'=>'element-group')),
        ));
        
        $submit->setDecorators(array(
        array('ViewHelper'),
        array('Description'),
        array('HtmlTag', array('tag' => 'p', 'class'=>'submit-group')),
        ));

    }
}
