# NewSolution
Helix Task


User authentication Logic and Session redirect

We have some users in our database added with MySQL insert into query.
Our users table has columnes id | username (char) | password (char).
Username must have max 10 characters, and password must have min 6 and max 10 characters.

We must to authentication with Laravel Auth Facade or custom with hand.
We don't have to use any Laravel package (Breeze, Sanctum ect.).

We don't have registration form, only login form.
Our password don't have to be hidden and hashed.

Write authentication logic.

When our user is logged in, there must to be a blade 'profile'.
In Profile page must be shown this text: "Welcome {{ our username }} !".


About Session

When user is logged in also one minute, the session must be expired and refreshing our profile page it must redirect our user to login page.

