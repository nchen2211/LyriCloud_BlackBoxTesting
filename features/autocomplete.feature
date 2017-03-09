Feature: Autocomplete
	In order to find an artist
	As a website user
	I need to be able to search for the artist

	@javascript
	Scenario: Searching for an artist that does exist
		Given I am on the "Main Page"
		When I fill in "search" with an "artist name"
		Then a list of related artists is shown

	@javascript
	Scenario: Searching for an artist that does not exist
		Given I am on the "Main Page"
		When I fill in "search" with a "wrong artist name"
		Then a list of related artists is not shown