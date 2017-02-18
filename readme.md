# Questions and Problems

(Junior and Intermediate Backend Developer).

Total Questions/Problems: 6

## 1. Complete the missing feature/function of authentication class 'Classes\Auth'.

file location:

./includes/classes/Auth.php

We created a very basic php framework and helpers for this exam. This php framework provides helper functions, crud (create, read, update and delete) functions, session and simple functions that can be used for building small applications.

This Authentication class is a class that handles user's log in security. These includes the ff. features for:

- Allow only {n} attempts per 2 hours
- If email is correct and using old password, then show message "You have changed your password a while ago ago."
- Allow only active user (only if option only_confirmed_user is true)
- Log in user and Redirect to dashboard if email and password matched

Also, this class much accept the following options:

- only_active_user - only allow active user
- max_attempt - maximum attempts
- max_attempt_period - the time the ```max_attempt``` value will reset.

### Installation

- create database
- import ./exam_auth.sql
- config database from ./includes/config/config.php

### Rules

- You can do whatever you want as long as we can test the said features of the `auth` class.
- Authentication class should follow object oriented approach and adopt the existing implementation of the application.

### Test Guide

- If you have any instructions on how to test the said authentication class functions, add it here:

<<<<<Start Comment (Optional)

update me on how to test your output.

END>>>>

## 2. Describe your experience with different programming languages.

	- When developing a backend, I am using PHP framework like Yii2 and Laravel Lumen.

## 3. What do you do to keep your programming skills current?

	- Experimenting with other technology to incorporate the backend or the APIs. I use reactjs and angular for the frontend.

## 4. What are your hobbies?
	
	-playing Dota 2 and Yugi-oh Duel links.
	- playing basketball

## 5. if you are familiar with automated test, tell us your thought about it.
	
	- 
## 6. Please tell us a few words about what tools do you use on a daily basis? Consider everything from browser tools, database and IDE. Which tool makes your life easier? No good or bad answers here, we just want to know how you work :)
	- Google Chrome
	- Atom or Brackets
	- Mysql, Mongodb, MSSQL, Firebase
	- Trello
	- Slack
	- Evernote
	- Quora app
	- Postman for API
	- 


## Test Authors

- regner atillo <atilloregner@gmail.com>
- serge casquejo <serg.casquejo@yahoo.com>