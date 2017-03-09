Feature: Web Page
	There are four web pages
	That a website user
	will be able to visit

	@javascript
	Scenario: Visiting the main page
		Given I am on the "Main Page"
		Then I will be able to see the "background" is "gray"

	@javascript
	Scenario: Visiting the song list page
		Given I am on the "Song List Page"
		Then I will be able to see the "background" is "gray"

	@javascript
	Scenario: Visiting the lyric page
		Given I am on the "Lyric Page"
		Then I will be able to see the "background" is "gray"


		