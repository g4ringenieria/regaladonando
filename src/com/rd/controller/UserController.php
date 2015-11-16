<?php

/**
 * sudo apt-get install php5-mcrypt
 * sudo php5enmod mcrypt
 * sudo service apache2 restart
 */
namespace com\rd\controller;

use com\rd\connection\MainConnection;
use com\rd\model\Bank;
use com\rd\model\BankAccount;
use com\rd\model\BankAccountType;
use com\rd\model\User;
use com\rd\model\UserType;
use com\rd\view\BankAccountFormView;
use com\rd\view\BankAccountsView;
use com\rd\view\UserView;
use Exception;
use NeoPHP\util\mail\SMTPMailer;

class UserController extends SiteController
{
    public function showRegistrationFormAction ()
    {
        return new UserView(UserView::MODE_REGISTRATION);
    }
    
    public function showUserAccountAction ()
    {
        $userView = new UserView();
        $userView->setUser(MainConnection::getInstance()->getEntity(User::getClass(), $this->getSession()->userId));
        return $userView;
    }
    
    public function showBankAccountsAction ()
    {
        $bankAccountTable = MainConnection::getInstance()->getTable("bankaccount");
        $bankAccountTable->addWhere("userid","=",$this->getSession()->userId);
        $bankAccountTable->addField("bankaccount.*");
        $bankAccountTable->addFields(["bankid", "name"], "bank_%s", "bank");
        $bankAccountTable->addFields(["bankaccounttypeid", "description"], "type_%s", "bankaccounttype");
        $bankAccountTable->addInnerJoin("bank", "bankaccount.bankid", "bank.bankid");
        $bankAccountTable->addInnerJoin("bankaccounttype", "bankaccount.bankaccounttypeid", "bankaccounttype.bankaccounttypeid");
        $bankAccounts = $bankAccountTable->get(BankAccount::getClass());
        $bankAccountsView = new BankAccountsView();
        $bankAccountsView->setBankAccounts($bankAccounts);
        return $bankAccountsView;
    }

    public function showBankAccountFormAction ()
    {
        return new BankAccountFormView();
    }
    
    public function addBankAccountAction ($bank, $type, $number, $cbu, $owner, $cuil)
    {
        $bankAccount = new BankAccount();
        $bankAccount->setUser(new User($this->getSession()->userId));
        $bankAccount->setBank(new Bank($bank));
        $bankAccount->setType(new BankAccountType($type));
        $bankAccount->setNumber($number);
        $bankAccount->setCbu($cbu);
        $bankAccount->setOwner($owner);
        $bankAccount->setCuil($cuil);
        MainConnection::getInstance()->insertEntity($bankAccount);
        return $this->showBankAccountsAction();
    }
    
    public function deleteBankAccountAction ($id)
    {
        $bankAccount = new BankAccount(); 
        $bankAccount->setId($id); 
        MainConnection::getInstance()->deleteEntity($bankAccount);
        return $this->showBankAccountsAction();
    }
    
    public function registerUserAction ($firstname, $lastname, $password, $retypePassword, $email, $retypeEmail, $country)
    {
        $userView = new UserView(UserView::MODE_REGISTRATION);
        
        $valid = true;
        if ($password != $retypePassword) 
        {
            $userView->addErrorMessage("password", "Las contraseñas no coinciden.");
            $userView->addErrorMessage("retypePassword", "Las contraseñas no coinciden.");
            $valid = false;
        }
        if ($email != $retypeEmail) 
        {
            $userView->addErrorMessage("email", "Los e-mails no coinciden");
            $userView->addErrorMessage("retypeEmail", "Los e-mails no coinciden");
            $valid = false;
        }
        if ($this->findUserByEmail($email)) 
        {
            $userView->addErrorMessage("email", "El e-mail \"{$email}\" ya se encuentra registrado en nuestro sistema.");
            $valid = false;
        }
        
        if ($valid) 
        {
            $conn = MainConnection::getInstance();
            $user = new User();
            $user->setActive("false");
            $user->setUsername($email);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setPassword(base64_encode(hash("md5",$password,true)));
            $user->setEmail($email);
            $userType = new UserType();
            $userType->setId(UserType::CLIENT);
            $user->setType($userType);
            $user->setCountry($country);
            $user->setHash(base64_encode($this->encrypt(User::DEFAULT_HASH_KEY, "{$firstname}|{$lastname}|{$email}" )));
            $result = $conn->insertEntity($user);
            
            if ($result === false) 
            {
                $userView->addErrorMessage("Ha ocurrido un error inesperado en la registración del usuario");
            }
            else
            {
                $this->sendUserRegistrationMail($user);
                $userView->setInfoMessage("Se ha enviado un email a su correo \"$email\". Active su usuario haciendo click en el link proporcionado");
            }
        }
        
        return $userView;
    }
    
    public function updateUserAction ($firstname, $lastname, $password, $retypePassword, $documentType, $documentNumber, $country, $address, $phone, $language, $accountName, $accountNumber)
    {
        $userView = new UserView();
        
        $valid = true;
        if ($password != $retypePassword) 
        {
            $userView->addErrorMessage("password", "Las contraseñas no coinciden.");
            $userView->addErrorMessage("retypePassword", "Las contraseñas no coinciden.");
            $valid = false;
        }
        
        if ($valid) 
        {
            
            $conn = MainConnection::getInstance();
            $conn->beginTransaction();
            
            try
            {
                $user = new User();
                $user->setId($this->getSession()->userId);
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                if ($password != "********") {
                    $user->setPassword(base64_encode(hash("md5",$password,true)));
                }
                $user->setDocumentType($documentType);
                $user->setDocumentNumber($documentNumber);
                $user->setCountry($country);
                $user->setAddress($address);
                $user->setPhone($phone);
                $user->setLanguage($language);
                $result = $conn->updateEntity($user);
                if ($result === false)
                    throw new Exception ("Error inserting user !!");
                $conn->commitTransaction();
                $userView->setInfoMessage("Usuario actualizado correctamente !!");
            }
            catch (Exception $ex)
            {
                $conn->rollbackTransaction();
                $userView->setInfoMessage("Ha ocurrido un error inesperado en la actualización del usuario");
            }
        }
        
        return $userView;
    }
    
    public function activateUserAction ($hash)
    {
        $userView = new UserView(UserView::MODE_REGISTRATION);

        list($firstname, $lastname, $email) = explode ( "|",  $this->decrypt(User::DEFAULT_HASH_KEY, base64_decode($hash)) );
        $conn = MainConnection::getInstance();
        $userTable = $conn->getTable("\"user\"");
        $userTable->addWhere("hash", "=", $hash);
        $userTable->addWhere("firstname", "=", $firstname);
        $userTable->addWhere("lastname", "=", $lastname);
        $userTable->addWhere("email", "=", $email);
        $user = $userTable->getFirst(User::getClass());
        
        if ($user)
        {
            $user->setActive(true);
            $conn->updateEntity($user);
            $userView->setInfoMessage("Usuario activado exitosamente.");
        }
        else 
        {
            $userView->setInfoMessage("No se pudo activar el usuario.");
        }
        return $userView;
    }
    
    protected function findUserByEmail($email)
    {
        $conn = MainConnection::getInstance();
        $userTable = $conn->getTable("\"user\"");
        $userTable->addWhere("email", "=", $email);
        return $userTable->getFirst(User::getClass());
    }
    
    protected function sendUserRegistrationMail (User $user)
    {
        $mail = new SMTPMailer();
        $mail->setSubject("RegalaDonando.com - Registro de usuario");
        $mail->setFrom("notificaciones@regaladonando.com");
        $mail->addRecipient($user->getEmail());
        $messageTemplate = '
            <!doctype html>
            <html>
                <head>
                    <meta charset="UTF-8">
                </head>
                <body>
                    Estimado {username}:</br></br>
                    Para completar el registro en la Web, por favor hacer <a href="{activationLink}" target="newTarget">click aquí</a><br>
                </body>
            </html>
        ';
        $message = $messageTemplate;
        $message = str_replace("{username}", $user->getFirstname() . ' '  . $user->getLastname (), $message);
        $message = str_replace("{activationLink}", $this->getUrl("user/activateUser", ["hash"=>$user->getHash()] ), $message);
        $mail->setMessage($message);
        $mail->send();
    }

    private function encrypt($key, $value) 
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv);
    }

    private function decrypt($key, $value) 
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv));
    }
}
