<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class Test00_HomepageCest
{
    public function homepageTest(AcceptanceTester $I): void
    {
        $I->wantTo('Test homepage');

        $I->amOnPage('/');

        $I->seeInTitle('Finder');
    }
}
