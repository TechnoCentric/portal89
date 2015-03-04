<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Sign Up a new user');

$I->amOnPage('/');
$I->click('Create User');
$I->seeCurrentUrlEquals('/create');

$I->fillField('Username:', 'JohnDoe');
$I->fillField('Password:', 'secret');
$I->fillField('Password Confirmation:', 'secret');
$I->fillField('Role:', 'User');
$I->Click('Register');

$I->seeCurrentUrlEquals('');
$I->see('User Created');





