<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//
define ('BASE_URL', 'http://localhost/html/LyriCloud_Team9/LyriCloud_Team9');
//$mainPage = "http://localhost/html/LyriCloud_Team9/LyriCloud_Team9/html/lyriCloud.html";
// $songListPage = "http://localhost/html/LyriCloud_Team9/LyriCloud_Team9/html/songList.html";
// $lyricsPage = "http://localhost/html/LyriCloud_Team9/LyriCloud_Team9/html/lyrics.html";

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{

    const MAIN_PAGE = 'html/lyriCloud.html';
    public function __construct() {}

    /**
     * @Given /^I am on the "([^"]*)"$/
     */
    public function iAmOnThe($path)
    {
        if ($path == "Main Page")
            $this->visit('/html/lyriCloud.html');
        else if ($path == "Song List Page")
            $this->visit('/html/songList.html');
        else if ($path == "Lyric Page")
            $this->visit('/html/lyrics.html');
        else {
            throw new Exception ('Page is not found');
        }
    }

    // ############################### AUTOCOMPLETE FEATURE ##########################
     /**
     * @When /^I fill in "([^"]*)" with an "([^"]*)"$/
     */
    public function iFillInWithAn($search, $artistName)
    {
        $field = $this->getSession()->getPage()->find('css', 'input[id="search"]');
        $field->setValue($artistName);
    }


    /**
     * @Then /^a list of related artists is shown$/
     */
    public function aListOfRelatedArtistsIsShown()
    {
        // this is to check if the dropdown list is generated
        $field = $this->getSession()->getPage()->find('css', 'input[class="ui-autocomplete-input"]');
        
        if ($field == null) {
            throw new Exception("Dropdown list is not generated");
        }
    }

     /**
     * @When /^I fill in "([^"]*)" with a "([^"]*)"$/
     */
    public function iFillInWithA($search, $wrongName)
    {
        $field = $this->getSession()->getPage()->find('css', 'input[id="search"]');
        $field->setValue($wrongName);         
    }

     /**
     * @Then /^a list of related artists is not shown$/
     */
    public function aListOfRelatedArtistsIsNotShown()
    {  
        $noList = $this->getSession()->getPage()->find('css', 'input[class="ui-autocomplete-input ui-autocomplete-loading"]');

        // it won't pass the test if $noList gets the HTML element
        if ($noList != null)
            throw new Exception("Dropdown list is generated.");
    }

    // ###############################################################################


    // ######################### WORD CLOUD PAGE USER INTERFACE #######################
     /**
     * @Then /^I will be able to see the "([^"]*)" is "([^"]*)"$/
     */
    public function iWillBeAbleToSeeTheIs($attributes, $color)
    {
        $bgRule = "background";
        $bgColorRule = "background-color";
        $textColorRule = "color";

        if ($attributes == "background") {
            $background = $this->getSession()->getPage()->find('css', 'body');
            $bg_color = $background->getAttribute('background');

            if ($bg_color != $color){
                throw new Exception("Background is not gray");
            }
        } 
        else if ($attributes = "button background") {
            $button_bg = $this->getSession()->getPage()->find('css', 'input[id="gobutton"]');
            $bt_bg_color = $button_bg->getAttribute('style');

            if ($bt_bg_color) {
                if (preg_match("/(^{$bgRule}:|; {$bgRule}:) ([a-z0-9]+);/i", $matches)) {
                    $found = array_pop(($matches));

                    if ($found != $color)
                        throw new Exception("Button background is not purple");
                }
            }
        } 
        else if ($attributes = "text color") {
            $text = $this->getSession()->getPage()->find('css', 'input[id="search"]');
            $text_color = $text->getAttribute('style');

            if ($text_color) {
                if (preg_match("/(^{$bgRule}:|; {$bgRule}:) ([a-z0-9]+);/i", $matches)) {
                    $found = array_pop(($matches));

                    if ($found != $color)
                        throw new Exception("Text color is not black");
                }
            }
        }
    }

     /**
     * @Then /^title page should be the same as the page name$/
     */
    public function titlePageShouldBeTheSameAsThePageName()
    {
        $head = $this->getSession()->getPage()->find('css', 'head');

        if ($head->hasAttribute('title')) {
            $title = $head->getAttribute('title');

            if ($title->getText() != 'Lyricloud')
                throw new Exception("Title page is not the same as page name");
            
        }
    }

    /**
     * @Given /^"([^"]*)" is located on the center of the page$/
     */
    public function isLocatedOnTheCenterOfThePage($logo)
    {
        throw new PendingException();
    }

    /**
     * @Given /^"([^"]*)" is located below the "([^"]*)"$/
     */
    public function isLocatedBelowThe($searchBar, $logo)
    {
        throw new PendingException();
    }



    // ###############################################################################

}
