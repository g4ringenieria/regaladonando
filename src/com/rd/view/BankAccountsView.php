<?php

namespace com\rd\view;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSEntityTable;
use com\rd\model\BankAccount;
use NeoPHP\web\html\HTMLTag;

class BankAccountsView extends SiteView
{
    private $bankAccounts = [];
    
    public function addBankAccount(BankAccount $bankAccount)
    {
        $this->bankAccounts = $bankAccount;
    }
    
    public function setBankAccounts (array $bankAccounts)
    {
        $this->bankAccounts = $bankAccounts;
    }
    
    protected function createContent()
    {
        $container = parent::createContent();
        $container->addElement(new HTMLTag("div", ["class"=>"page-header"], new HTMLTag("h1", "Cuentas Bancarias"))); 
        $container->addElement($this->createBankAccountTable());
        $container->addElement(new BSButton("Agregar Nueva", ["href"=>$this->getUrl("user/showBankAccountForm"), "style"=>  BSButton::STYLE_PRIMARY]));
        return $container;
    }
    
    protected function createBankAccountTable()
    {
        $table = new BSEntityTable();
        $table->addEntityColumn("Banco", "bank_name");
        $table->addEntityColumn("Tipo de cuenta", "type_description");
        $table->addEntityColumn("Número", "number");
        $table->addEntityColumn("Cbu", "cbu");
        $table->addEntityColumn("Titular", "owner");
        $table->addEntityColumn("CUIL", "cuil");
        $table->addEntityColumn("Acción", function ($bankaccount) 
        { 
            return '<a class="btn btn-primary" href="' . $this->getUrl("user/deleteBankAccount", ["id"=>$bankaccount->getId()]) . '" role="button" type="button">Borrar</a>';
        });
        $table->setEntities($this->bankAccounts);
        return $table;
    }
}