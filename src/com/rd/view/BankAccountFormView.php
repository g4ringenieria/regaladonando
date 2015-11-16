<?php

namespace com\rd\view;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\form\BSForm;
use com\bootstrap\component\form\BSNumberField;
use com\bootstrap\component\form\BSSelectField;
use com\bootstrap\component\form\BSTextField;
use com\rd\connection\MainConnection;
use com\rd\model\Bank;
use com\rd\model\BankAccountType;
use NeoPHP\web\html\HTMLTag;

class BankAccountFormView extends SiteView
{
    protected function createContent()
    {
        $container = parent::createContent();
        $container->addElement(new HTMLTag("div", ["class"=>"page-header"], new HTMLTag("h1", "Creacion de Cuenta Bancaria"))); 
        $container->addElement($this->createBankAccountForm());
        return $container;
    }

    protected function createBankAccountForm ()
    {
        $form = new BSForm();
        $form->setMethod("POST");
        $form->setAction($this->getUrl("user/addBankAccount"));        
        $form->addField(new BSSelectField(["name"=>"bank", "label"=>"Banco", "autoFocus"=>true, "options"=>$this->getBanks()]));
        $form->addField(new BSSelectField(["name"=>"type", "label"=>"Tipo de Cuenta", "options"=>$this->bankAccountTypes()]));
        $form->addField(new BSNumberField (["name"=>"number", "type"=>"number", "label"=>"Número", "required"=>true]));
        $form->addField(new BSNumberField(["name"=>"cbu", "label"=>"Cbu", "required"=>true]));
        $form->addField(new BSTextField(["name"=>"owner", "label"=>"Titular", "required"=>true]));
        $form->addField(new BSNumberField(["name"=>"cuil", "label"=>"Cuil", "required"=>true]));
        $form->addButton(new BSButton("Agregar cuenta", ["type"=>"submit", "style"=>  BSButton::STYLE_PRIMARY]));
        return $form;
    }
    
    private function getBanks()
    {
        $banks = array();
        foreach (MainConnection::getInstance()->getEntities (Bank::getClass()) as $bank)
        {
            $banks[$bank->getId()] = $bank->getName();
        }
        return $banks;
    }
    
    private function bankAccountTypes()
    {
        $bankAccountTypes = array();
        foreach (MainConnection::getInstance()->getEntities (BankAccountType::getClass()) as $bankAccountType)
        {
            $bankAccountTypes[$bankAccountType->getId()] = $bankAccountType->getDescription();
        }
        return $bankAccountTypes;
    }
}