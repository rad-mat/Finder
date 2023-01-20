<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class MatchCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->wantTo('Test matching functionalities');
        $I->wantTo('Check if unauthenticated user can see matching subpages');
        $I->amOnPage('/match/find');
        $I->seeCurrentUrlEquals('/login');
        $I->amOnPage('/match/show');
        $I->seeCurrentUrlEquals('/login');

        $I->wantTo('Find match');
        $I->amOnPage("/login");

        $I->fillField("email", "john.doe@gmail.com");           //using seeded user
        $I->fillField("password", "secret");

        $I->click("login-button");

        $I->wantTo('test if filters are working');
        $I->amOnPage('/match/find');
        $I->see('Znaleziono matematyka!');
        $I->see('Anna');

        $I->selectOption('sex', 'Mężczyzna');
        $I->click('filter');

        $I->amOnPage('/match/find');
        $I->see('Znaleziono matematyka!');
        $I->see('Patrick');

        $I->selectOption('league', '4');
        $I->click('filter');

        $I->amOnPage('/match/find');
        $I->see('Niestety nie znaleziono nikogo spełniającego twoje wymagania');

        $I->selectOption('sex', 'all');
        $I->selectOption('league', '0');
        $I->click('filter');

        $I->wantTo('test if wrong match want be activated');
        $I->amOnPage('/match/find');
        $I->see('Znaleziono matematyka!');
        $I->see('Anna');
        $I->click('accept');

        $I->wantTo('See match notification');
        $I->amOnPage('/match/find');
        $I->see('Znaleziono matematyka!');
        $I->see('Patrick');
        $I->click('accept');

        $I->amOnPage('/match/notification');
        $I->see('Znaleziono parę!');
        $I->see('Przejdź do listy znalezionych par');
        $I->see('Szukaj dalej');
        $I->click('#go-to-pairs');

        $I->amOnPage('/match/show');
        $I->dontSee('Anna');
        $I->See('Patrick Bateman');
        $I->See('tim.doe@gmail.com');
    }
}
