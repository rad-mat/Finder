<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class RiddlesCest
{
    public const RIDDLES_PER_PAGE = 5;
    public function test(AcceptanceTester $I): void
    {
        $I->wantTo('Test functionality of riddles');

        $I->amGoingTo('see all necessary elements');
        $I->amOnPage('/riddles');
        $I->seeCurrentUrlEquals('/riddles/page/1');
        $I->see('Zagadki', 'h1');
        $I->see('Wylosuj zagadkę', "#random-riddle");
        $I->dontSee('Tylko nierozwiązane', 'label');
        $I->see('Filtruj', "#riddles-filter");
        $riddlesCount = $I->grabNumRecords('riddles');
        $riddlesOnPageCount = ($riddlesCount < self::RIDDLES_PER_PAGE) ? $riddlesCount : self::RIDDLES_PER_PAGE;
        $I->seeNumberOfElements('.riddle', $riddlesOnPageCount);
        $I->see('<', '#riddles-previous');
        $I->see('1', '#riddles-page-number');
        $I->see('>', '#riddles-next');

        $I->amGoingTo('filter riddles');
        $I->selectOption('category', 'geometria');
        $I->click("#riddles-filter");
        $I->seeCurrentUrlEquals('/riddles/page/1');

        $I->amGoingTo('choose one riddle');
        $I->amOnPage('/riddles/1');
        $I->dontSee('Zagadki', 'h1');
        $I->see('Powrót', "#riddle-back");
        $I->click("#riddle-back");

        $I->amGoingTo('draw one riddle');
        $I->click("#random-riddle");
        $I->seeCurrentUrlMatches('~/riddles/(\d+)~');
        $I->dontSee('Zagadki', 'h1');
        $I->see('Powrót', "#riddle-back");
        $I->click("#riddle-back");

        $I->amGoingTo('come back to all riddles');
        $I->selectOption('category', 'all');
        $I->click("#riddles-filter");

        $I->amGoingTo('test navigation of pages');
        $I->seeCurrentUrlEquals('/riddles/page/1');
        $I->see('1', "#riddles-page-number");
        $I->click("riddles-previous");
        $I->seeCurrentUrlEquals('/riddles/page/1');
        $I->click("riddles-next");
        if ($riddlesCount > self::RIDDLES_PER_PAGE) {
            $I->see('2', "#riddles-page-number");
            $I->seeCurrentUrlEquals('/riddles/page/2');
        } else {
            $I->seeCurrentUrlEquals('/riddles/page/1');
            $I->see('1', "#riddles-page-number");
        }

        $I->amOnPage("/login");
        $I->fillField("email", "john.doe@gmail.com");
        $I->fillField("password", "secret");
        $I->click("login-button");
        $I->see('Zdobytych punktów: 2', 'p');
        $I->amOnPage("/riddles");

        $I->amGoingTo('test riddles after login');
        $I->see('Tylko nierozwiązane', 'label');
        $I->dontSeeCheckboxIsChecked('#answeredBoxValue');
        $I->see('Trójkąty w ośmiokącie', 'a');
        $I->see('Za siedmioma cyframi', 'a');
        $I->amOnPage('/riddles/1');
        $I->see('Zagadka rozwiązana!', 'p');
        $I->amOnPage('/riddles/2');
        $I->see('Sprawdź', '#send-answer');

        $I->amOnPage("/riddles");
        $I->checkOption('#answeredBoxValue');
        $I->click("#riddles-filter");
        $I->seeCheckboxIsChecked('#answeredBoxValue');
        $I->dontSee('Trójkąty w ośmiokącie', 'a');
        $I->see('Za siedmioma cyframi', 'a');
        $I->amOnPage('/riddles/2');
        $I->fillField("#filledAnswer", "10");
        $I->click("#send-answer");
        $I->see('Zła odpowiedź', 'li');
        $I->fillField("#filledAnswer", "21");
        $I->click("#send-answer");
        $I->see('Zagadka rozwiązana!', 'p');

        $I->amOnPage("/riddles");
        $I->seeCheckboxIsChecked('#answeredBoxValue');
        $I->dontSee('Za siedmioma cyframi', 'a');
        $I->amOnPage("/dashboard");
        $I->see('Zdobytych punktów: 3', 'p');
    }
}
