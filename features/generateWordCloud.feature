Feature: Generate word cloud
	In order to generate a word cloud
	As a website user
	I need to be able to search for an artist
	and find the artist
	then click the GO button 

	@javascript
	Scenario: Generating a word cloud from an artist that exists
		Given I am on "/html/lyriCloud.html"
		When I fill in "search" with "Taylor Sw"
		Then I should see a "dropdown list" with "Taylor Swift" suggested to me
		When I click on the "dropdown list" with "Taylor Swift" on it
		Then the name "Taylor Swift" should fill the "search" bar
		When I click on GO "button"
		Then a word cloud should be generated