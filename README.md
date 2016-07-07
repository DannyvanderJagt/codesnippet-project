***The project is over and this repo is only used as archive for our team.***

# Codesnippet
**This is a school project! Please don't create issues or pull requests!**

## Install
To install this execute the next few points:

**(Execute composer, bower, npm and gulp in base directory!)**

* run `composer install` 
* run `bower install`
* run `npm install`
* run `gulp`
* Make sure your database is ready to use!

## Branches
This repository will contain only **1 branche!**

## File structure.
```js
- database
- node_modules (Not stored on github!)
- src
	- assets 
		- css
		- scss
		- javascript
		- images
		- libs
	- cache (directory)
	- controllers
	- dist
	- models
	- views
	- templates
- .bowerrc
- .gitignore
- .htaccess
- bower.json
- composer.json
- composer.lock
- gulpfile.js
- package.json
- README.md
```

### Explanations
#### Database
- The sql files of the database.

#### node_modules
- These are nodeJS packages, used for gulp (the preprecessor).

#### .bowerrc
- A file for bower; This file repositioned the path to the directory where the package are placed.

#### .gitignore
- A file for git/github. This file excludes files and directories from uploading to the git repository. You will use this to uncluter your repository and prevent libraries, such as jQuery, from uploading to your repository.

#### .htaccess
- Used for redirecting users (website).

#### bower.json
- The basic settings of bower.

#### composer.json
- This file stores basic settings of composer.

#### composer.lock
- Used by composer for locking installed packages.

#### gulpfile.js
- This file stores basic settings of gulp.

#### package.json
- This file stores basic settings of a node package. Used for gulp dependensies.

#### Src
- This folder stores all the files that will be used for the website.

#### Assets
- This folder stores all the scss, javascript, images and used libraries.

#### Cache
- This folder stores cached templates from Twig. **Do not change or add files!**

#### Controllers
- This folder stores all the MVC controller files.

#### Dist
- The place where the compiled css and javascript are stored. 
- **Include only these css and javascript file in the html templates!**
- **Don't place or modify any files!**

#### Models
- This folder stores all the MVC model files.

#### Templates
- This folder stores all the Html Templates.

#### Views
- This folder stores all the MVC Views files.

#### index.php
- This is the main php file.

## Server

### Software
The server is a Raspberry Pi which is connected to the internet. On the Raspberry Pi runs an Apache and a SQl database. 

### Languages
The server side is written in:

* Php
* Sql

### Frameworks

* **Twig** Template engine.

## Database
A Sql database is used.

## Client
The client is a website created for a modern day webbrowser.

### Langugages
The client is written in:

* Html
* Css / Sass
* Javascript

### Frameworks
* jQuery

### Support
The website is supported by:

* Internet Explore 10 and higher.
* Firefox 35 and higher.
* Chrome 39 and higher.
* Safari 7.1 and higher.
* Opera 27 and higher.

**The website is not supported on mobile devices!**

## Copyright
Everything in this repository and everything connected with this repository is private property! Nothing can be used, copied or in any other way distributed.
