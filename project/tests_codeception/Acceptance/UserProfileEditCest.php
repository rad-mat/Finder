<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class UserProfileEditCest
{
    public function userProfileEditTest(AcceptanceTester $I): void
    {
        $I->wantTo('Check if user profile is saved after edit');

        $I->amOnPage("/login");

        $I->fillField("email", "john.doe@gmail.com");           //using seeded user
        $I->fillField("password", "secret");

        $I->click("login-button");

        $I->seeCurrentUrlEquals("/dashboard");
        $I->amOnPage("/profile");

        $I->fillField("name", "James");
        $I->fillField("surname", "Potter");
        $I->fillField("favourite_number", 420);
        $I->fillField("favourite_function", "uselessness");
        $I->fillField("description", "Alkohol?");

        $I->click("#user-profile-save");


        $name = $I->grabValueFrom("#user-name");
        if ($name != "James") {
            $I->fail("Wrong user name found");
        }

        $surname = $I->grabValueFrom("#user-surname");
        if ($surname != "Potter") {
            $I->fail("Wrong user surname found");
        }

        $favouriteNumber = $I->grabValueFrom("#user-favourite-number");
        if ($favouriteNumber != 420) {
            $I->fail("Wrong user favourite number found");
        }

        $favouriteFunction = $I->grabValueFrom("#user-favourite-function");
        if ($favouriteFunction != "uselessness") {
            $I->fail("Wrong user favourite function found");
        }

        $description = $I->grabValueFrom("#user-description");
        if ($description != "Alkohol?") {
            $I->fail("Wrong user description found");
        }
    }
}
