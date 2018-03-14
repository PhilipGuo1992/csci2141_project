Alex's sample queries for the project:

# Ratings

- find movies which are above a certain rating, between a rating, and below a rating

- find movies which have a good relevance score (number of votes and rating combined mathematically) using this https://www.evanmiller.org/how-not-to-sort-by-average-rating.html

- rating divided by show duration (highest rating per minute of show watched)

- most reliable audience (tv shows with more than 10 years running)

- similar shows (those with the same keywords, or have similar actors (could be very slow))

# Administrative

- create a new timeslot

- add a movie to a timeslot

- find all conflicts with the timeslots, and warn the user when they try to enter in a timeslot which has been booked already

- edit a movie in a timeslot (moving start time)

- prevent the user from changing a timeslot if the movie is currently playing

- allow the timeslot to be resized independently of the movie (e.g. just show part of a movie)

- list all episodes by their name

- delete/update episodes using form-like interface and search function (looks like Google search)

- delete/update any actors or characters per episode by converting the characters column of tids into an array and searching them individually

# Search

- search for episodes using any qualifier (similar to the LIKE command) so you can search via episode title or episode name

- allow episodes to be searched with SOUNDEX (if your query is a little bit wrong, it will still work if the word can be prounced the same) https://stackoverflow.com/questions/29598065/how-to-query-soundex-in-mysql

- searching via season number, episode number (advanced search)

- allow searching with a very simple query-like syntax (but NOT mysql) so the user could type "game of thrones before this thursday"

- allow clicking on an actor in the search results pane and get a list of movies that that actor starred in


# User side

- allow movies to be favorited

- get notifications when the timeslot contains their show in the future (just select from timeslot where episodeName = "ABC") and then check date

- allow movies to be hidden (just set a user-session cookie with the movie id, simple)

- show/hide images (just get them via google search for some movies; not all of them unless it's easy)


# Other

- find episodes with people's names in them (I have a list of names)

