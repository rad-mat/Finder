<?php

namespace TestsCodeception\Acceptance;

use App\Models\User;
use App\Models\UserProfile;
use TestsCodeception\Support\AcceptanceTester;

class UserProfileCest
{
    public function userProfileTest(AcceptanceTester $I): void
    {
        $I->wantTo('see hidden content after login');

        $I->amOnPage("/login");

        $I->fillField("email", "john.doe@gmail.com");           //using seeded user
        $I->fillField("password", "secret");

        $I->click("login-button");

        $I->seeCurrentUrlEquals("/dashboard");
        $I->amOnPage("/profile");

        $name = $I->grabValueFrom("#user-name");
        if ($name != "Jan Paweł") {
            $I->fail("Wrong user name found");
        }

        $surname = $I->grabValueFrom("#user-surname");
        if ($surname != "Drugi") {
            $I->fail("Wrong user surname found");
        }

        $favouriteNumber = $I->grabValueFrom("#user-favourite-number");
        if ($favouriteNumber != 2137) {
            $I->fail("Wrong user favourite number found");
        }
        $favouriteFunction = $I->grabValueFrom("#user-favourite-function");
        if ($favouriteFunction != "printf") {
            $I->fail("Wrong user favourite function found");
        }
        $description = $I->grabValueFrom("#user-description");
        if ($description != "Lubię chleb i pociągi i moją mamę Magdę też lubię i masło orzechowe.") {
            $I->fail("Wrong user description found");
        }
    }
}
