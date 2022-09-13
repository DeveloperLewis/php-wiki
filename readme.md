# A wikipedia built using my custom framework
A fairly simple wikipedia that has admin accounts that can share between articles,
a wysiwyg for ease of use, a backend system for managing your articles and more.

Almost completely coded from scratch using php. (Uses autoloading from composer because its magic and HTMLpurifier for security and sanitization.)



## Installation

- Requires php 8, mysql/mariadb and apache. Or just use xammp.

- `git clone https://github.com/DeveloperLewis/php-wiki`
- `composer install`
- Enter the `/classes/database.php` class and change the username and password to match your database login.
- Enter the `init.php` and change the username and password to match your database login.
- After creating an account, you can enable them as an administrator by setting the "is_admin" column to true in the users table for your specified user.

