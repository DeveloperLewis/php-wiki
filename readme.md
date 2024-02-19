# A wikipedia built using my custom framework
A fairly simple wikipedia that has a backend for creting wiki articles.
Features a complex text editor for ease of use, a backend cms for managing your articles and more.

Almost completely coded from scratch using html, css(bootstrap), javascript and php. (Uses autoloading from composer because its magic and HTMLpurifier for security and sanitization.)

## Installation

- Requires php 8, mysql/mariadb and apache. Or just use xammp.

- `git clone https://github.com/DeveloperLewis/php-wiki`
- `composer install`
- Enter the `/classes/database.php` class and change the username and password to match your environment.
- Enter the `init.php` and change the username and password to match your environment.
- Open the site and create an account.
- After creating an account, you can enable them as an administrator by setting the "is_admin" column to true in the users table for your specified user.

