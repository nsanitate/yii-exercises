<?php
class UserTest extends WebTestCase {

    protected function setUp() {
        parent::setUp();
        
        //$this->setAutoStop(false);
    
        $this->start();
        $this->open('');
        
        // login        
        $this->clickAndWait('link=Login');
	$this->type('name=LoginForm[username]','admin');
	$this->click("//input[@value='Login']");
	$this->waitForTextPresent('Password cannot be blank.');
	$this->type('name=LoginForm[password]','test');
	$this->clickAndWait("//input[@value='Login']");
        $this->clickAndWait('link=Users');
    }

    public function testPasswordMatch() {
        $this->clickAndWait('link=Create User');  
	$this->type('name=Person[fname]','Func');
	$this->type('name=Person[lname]','Test');
	$this->type('name=User[username]','functest');
	$this->type('name=User[password]','functest');
	$this->type('name=User[password_repeat]','nomatchpass');
        $this->clickAndWait("//input[@value='Create']");
        $this->assertTextPresent('Password must be repeated exactly.');
        $this->assertTextPresent('Does not meet password requirements.');
        $this->assertTextNotPresent('Password is too short (minimum is 8 characters).');
    }
    
    public function testPasswordTooShort() {
        $this->clickAndWait('link=Create User');  
	$this->type('name=Person[fname]','Func');
	$this->type('name=Person[lname]','Test');
	$this->type('name=User[username]','functest');
	$this->type('name=User[password]','moo');
	$this->type('name=User[password_repeat]','moo');
        $this->clickAndWait("//input[@value='Create']");
        $this->assertTextPresent('Password is too short (minimum is 8 characters).');
        $this->assertTextPresent('Does not meet password requirements.');
        $this->assertTextNotPresent('Password must be repeated exactly.');
    }

    public function testGoodPassword() {
        $this->clickAndWait('link=Create User');  
	$this->type('name=Person[fname]','Func');
	$this->type('name=Person[lname]','Test');
	$this->type('name=User[username]','functest');
	$this->type('name=User[password]','m00!Isay');
	$this->type('name=User[password_repeat]','m00!Isay');
        $this->clickAndWait("//input[@value='Create']");
        $this->assertTextPresent('View User');
    }

    public function testDeleteUser() {
	$this->type('css=td > input[name="User[username]"]','functest');
        $this->assertTextPresent('functest');
        $this->clickAndWait("css=img[alt=\"View\"]");
        //$this->chooseOkOnNextConfirmation();
        $this->clickAndWait('link=Delete User');
        $this->assertConfirmation('Are you sure you want to delete this item?');
        //$this->click("css=input[type=\"submit\"]");
        $this->click("OK");
        $this->assertTextNotPresent('functest');
    }    
}
?>
