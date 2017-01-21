<?php

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * @param FunctionalTester $I
     */
    public function loginSuccess(FunctionalTester $I)
    {
        $I->am('admin user');
        $I->wantTo('Login to administration area with correct credentials');
        $I->lookForwardTo('access all features of the administration area');
        $I->amOnPage('/login');
        $I->fillField('_username', 'test');
        $I->fillField('_password', 'test123');
        $I->click('Log in');
        $I->see('TM tools');
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginFail(FunctionalTester $I)
    {
        $I->am('admin user');
        $I->wantTo('Login to administration area with wrong credentials');
        $I->lookForwardTo('be rejected');
        $I->amOnPage('/login');
        $I->fillField('_username', 'test');
        $I->fillField('_password', 'test');
        $I->click('Log in');
        $I->see('Invalid credentials');
    }
}
