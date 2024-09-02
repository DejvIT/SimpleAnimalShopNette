# About the Pet Store
---------------------

- The XML structure is defined in the `saveAnimals()` method of the model located at `app/Model/AnimalManager.php`. If you need to store additional variables about the animals, make sure to update the XML structure here.
- The file `app/Model/AnimalManager.php` contains all the logic for storing, loading, selecting, and deleting data from/to the XML file located at `app/data/animals.xml`.
- The base layout of the application can be found at `app/UI/@layout.latte`.
- The default route is defined in `app/Core/RouterFactory.php`. If you wish to change the default route from Home, update it here.
- New endpoints can be created by adding new directories under `app/UI/`. For example, the `Animal` directory was created for this application. A presenter is used for creating new routes, defined by actions such as `actionAdd`, `actionEdit`, `actionDelete`, etc.
- If you need to create a new endpoint, such as `/openai/process`, you should create `app/UI/Openai/OpenaiPresenter.php` with a `defaultRender` function and `app/UI/Openai/default.latte` to display the results.

**Howdy!**

Nette Web Project
=================

Welcome to the Nette Web Project! This is a basic skeleton application built using
[Nette](https://nette.org), ideal for kick-starting your new web projects.

Nette is a renowned PHP web development framework, celebrated for its user-friendliness,
robust security, and outstanding performance. It's among the safest choices
for PHP frameworks out there.

If Nette helps you, consider supporting it by [making a donation](https://nette.org/donate).
Thank you for your generosity!


Requirements
------------

This Web Project is compatible with Nette 3.2 and requires PHP 8.1.


Installation
------------

To install the Web Project, Composer is the recommended tool. If you're new to Composer,
follow [these instructions](https://doc.nette.org/composer). Then, run:

	composer create-project nette/web-project path/to/install
	cd path/to/install

Ensure the `temp/` and `log/` directories are writable.


Web Server Setup
----------------

To quickly dive in, use PHP's built-in server:

	php -S localhost:8000 -t www

Then, open `http://localhost:8000` in your browser to view the welcome page.

For Apache or Nginx users, configure a virtual host pointing to your project's `www/` directory.

**Important Note:** Ensure `app/`, `config/`, `log/`, and `temp/` directories are not web-accessible.
Refer to [security warning](https://nette.org/security-warning) for more details.


Minimal Skeleton
----------------

For demonstrating issues or similar tasks, rather than starting a new project, use
this [minimal skeleton](https://github.com/nette/web-project/tree/minimal).


