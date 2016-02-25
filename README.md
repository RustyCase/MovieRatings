MovieRatings
============

A simple REST demo in Symfony.

### Purpose

To demonstrate how to create a simple web api using Symfony2.

### Requirements

1. PHP 5.5.9 or greater
2. MySQL 5.0 or greater
3. PHPUnit 4.2 recommended

### QuickStart

From the main MovieRatings directory:

1. Install dependencies

  ```
  $ php composer.phar install
  ```

2. This will be followed by a series of prompts to build the paramaters.yml. In
this step you will be asked to supply database related parameters:
(host, user, password, etc).

3. After step 2, check symfony_requirements
  ```
  $ php bin/symfony_requirements
  ```

4. Create and populate the database
  ```
  $ php bin/console doctrine:schema:update --force

  $ php bin/console doctrine:fixtures:load
  ```

5. Run unit tests

  ```
  $ phpunit
  ```

### TODO
