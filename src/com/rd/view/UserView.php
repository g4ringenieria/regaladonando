<?php

namespace com\rd\view;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSLayoutConstraints;
use com\bootstrap\component\BSWell;
use com\bootstrap\component\form\BSEmailField;
use com\bootstrap\component\form\BSForm;
use com\bootstrap\component\form\BSFormField;
use com\bootstrap\component\form\BSPasswordField;
use com\bootstrap\component\form\BSSelectField;
use com\bootstrap\component\form\BSTextField;
use com\rd\model\User;
use NeoPHP\web\html\HTMLTag;

/**
 * Vista de registración y actualización de usuarios
 * @author martin
 */
class UserView extends SiteView
{   
    const MODE_ACCOUNT = 0;
    const MODE_REGISTRATION = 1;
    
    private $mode;
    private $user;
    private $errorMessages = [];
    private $infoMessage = "";
    
    public function __construct($mode = self::MODE_ACCOUNT)
    {
        parent::__construct();
        $this->mode = $mode;
    }
    
    public function setUser (User $user)
    {
        $this->user = $user;
    }
    
    public function addErrorMessage ($field, $error)
    {
        $this->errorMessages[$field][] = $error;
    }
    
    public function setInfoMessage ($successMessage)
    {
        $this->infoMessage = $successMessage;
    }
    
    protected function createContent()
    {
        $container = parent::createContent();
        $container->addElement(new HTMLTag("div", ["class"=>"page-header"], new HTMLTag("h1", ($this->mode == self::MODE_ACCOUNT?"Mi cuenta":"Registración de usuario")))); 
                
        if (empty($this->infoMessage))
        {
            $container->addElement($this->createForm());
        }
        else
        {
            $container->addElement(new BSWell($this->infoMessage, ["style"=>BSWell::STYLE_LARGE]));
        }
        return $container;
    }
    
    private function createForm ()
    {        
        $formConstraints = new BSLayoutConstraints();
        $formConstraints->colsSm = 6;
        $form = new BSForm();
        $form->setMethod("POST");
        $form->setAction($this->getUrl($this->mode == self::MODE_ACCOUNT?"user/updateUser":"user/registerUser"));
        
        $form->addField(new BSTextField(array_merge(["name"=>"firstname", "label"=>"Nombre", "value"=>$this->user?$this->user->getFirstname():"", "required"=>"true"],!empty($this->errorMessages["firstname"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["firstname"]] : [])), $formConstraints);
        $form->addField(new BSTextField(array_merge(["name"=>"lastname", "label"=>"Apellido", "value"=>$this->user?$this->user->getLastname():"", "required"=>"true"],!empty($this->errorMessages["lastname"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["lastname"]] : [])), $formConstraints);
        $form->addField(new BSPasswordField(array_merge(["name"=>"password", "label"=>"Contraseña", "value"=>$this->user?"********":"", "required"=>"true", "minLength"=>8, "helpTexts"=>["8 caracteres como mínimo, distingue mayúsculas de minúsculas"]],!empty($this->errorMessages["password"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["password"]] : [])), $formConstraints); 
        $form->addField(new BSPasswordField(array_merge(["name"=>"retypePassword", "label"=>"Vuelve a escribir la contraseña", "value"=>$this->user?"********":"", "required"=>"true"],!empty($this->errorMessages["retypePassword"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["retypePassword"]] : [])), $formConstraints); 
        if ($this->mode == self::MODE_ACCOUNT)
        {
            $form->addField(new BSSelectField(["name"=>"documentType", "label"=>"Tipo de Documento", "options"=>[1=>"DNI"], "value"=>$this->user?$this->user->getDocumentType ():1]), $formConstraints);
            $form->addField(new BSTextField(array_merge(["name"=>"documentNumber", "label"=>"Número de Documento", "value"=>$this->user?$this->user->getDocumentNumber():"", "required"=>"true"],!empty($this->errorMessages["documentNumber"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["documentNumber"]] : [])), $formConstraints);
        }
        else 
        {
            $form->addField(new BSEmailField(array_merge(["name"=>"email", "label"=>"E-mail", "value"=>$this->user?$this->user->getEmail ():"", "required"=>"true"],!empty($this->errorMessages["email"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["email"]] : [])), $formConstraints);
            $form->addField(new BSEmailField(array_merge(["name"=>"retypeEmail", "label"=>"Vuelve a escribir el e-mail", "value"=>$this->user?$this->user->getEmail ():"", "required"=>"true"],!empty($this->errorMessages["retypeEmail"])? ["style"=>BSFormField::STYLE_ERROR, "helpTexts"=>$this->errorMessages["retypeEmail"]] : [])), $formConstraints);
        }
        $form->addField(new BSSelectField(["name"=>"country", "label"=>"País", "options"=>$this->getCountries(), "value"=>$this->user?$this->user->getCountry ():$this->getUserCountryByIp ()]));
        if ($this->mode == self::MODE_ACCOUNT)
        {
            $form->addField(new BSTextField(["name"=>"address", "label"=>"Dirección", "value"=>$this->user?$this->user->getAddress ():""]));
            $form->addField(new BSTextField(["name"=>"phone", "label"=>"Teléfono", "value"=>$this->user?$this->user->getPhone ():""]));
            $form->addField(new BSSelectField(["name"=>"language", "label"=>"Idioma", "options"=>$this->getLanguages(), "value"=>$this->user?$this->user->getLanguage ():"es"]));
        }        
        $form->addButton(new BSButton($this->mode == self::MODE_ACCOUNT?"Actualizar":"Registrarse", ["id"=>"saveButton", "type"=>"submit", "style"=>BSButton::STYLE_PRIMARY]));
        return $form;
    }
    
    private function getCountries ()
    {
        return [
            "AR" => "Argentina",
            "BR" => "Brasil",
            "CL" => "Chile",
            "CO" => "Colombia",
            "CR" => "Costa Rica",
            "CU" => "Cuba",
            "EC" => "Ecuador",
            "SV" => "El Salvador",
            "GT" => "Guatemala",
            "HT" => "Haiti",
            "HN" => "Honduras",
            "JM" => "Jamaica",
            "MX" => "Mexico",
            "PA" => "Panama",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PR" => "Puerto Rico",
            "TT" => "Trinidad And Tobago",
            "US" => "Estados Unidos",
            "UY" => "Uruguay",
            "VE" => "Venezuela"
        ];
    }
    
    private function getLanguages ()
    {
        return [
            "es" => "Español",
            "en" => "Inglés"
        ];
    }
    
    private function getUserCountryByIp ()
    {
        require_once "lib/geoiploc/geoiploc.php";
        $code = getCountryFromIP($_SERVER["REMOTE_ADDR"], "code");
        return $code!="ZZ"?$code:"AR";
    }
}