# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.6.0] - 2020-12-07
### Added
- Incoming API: View all incoming transactions, creating and deleting incoming transactions, updating package type of an existing incoming
- Outgoing API: View all outgoing transactions, creating and deleting outgoing transactions, updating type of payment for an existing outgoing transaction
- Budget API: View all budget transactions, creating and deleting budget, updating budget information
- Organization API: View all, create, delete, update
- Contribution API: View all, create and delete
- Fundraiser API: View all, create and delete
- Donate API: View all, create and delete
- Department API: View all, create and update

### Changed
- Path and functions in financial_transaction.php

## [0.5.0] - 2020-12-06
### Added
- Meeting API: Creating a meeting, viewing a specific meeting, updating a meeting's info, deleting a meeting, search through meetings 
- Performance API: View all performances, create, and delete specific performances for an event
- Artist API: View all artists, create and delete specific artists for a performance
- Food API: View all food, create and delete specific food for an event
- Executive API: View all executives, create, and delete an executive
- Attendence API: View all attendences by executives to meetings, create, and delete an attendence
- Topic API: View all topics, create and delete topic

### Changed
- Updated database with dummy values for meeting, performance, artist, and food. 

## [0.4.0] - 2020-12-05
### Added
- Member API: View all members, creating a member (without subscription/transaction, these are set default values), view details of specific member, updating a member, deletion of a member (doesn't check if member exists), searching a member by program
- Meeting API: View all meetings

### Fixed
- Issue where member api is unable to update true/false values to TINYINT. Change values to b'1' and b'0' instead. 

## [0.3.0] - 2020-12-03
### Added
- Viewing, searching, creating, updating, and deleting events from the database through api. Updates against a non-existent item in the database will result in update success message, although the item won't be created. This is the same with deletions. [How to Create A Simple REST API in PHP - Step By Step Guide!](https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html).
- Front end and back end intergration with events table in database. [AJAX CRUD Tutorial Using JavaScript, JSON and PHP – Step by Step Guide! ](https://codeofaninja.com/2015/06/php-crud-with-ajax-and-oop.html).
- View, create, selection and deletion and updating specific events via user interface. The selecting a specific event api will need to be reworked to include more information about the event (such as the hosting executive, budget, etc.).

## [0.2.0] - 2020-12-02
### Added
- A main page and four subpages, and navigation between subpages and main page. 
- VSCode and Visual Studio settings to .gitignore. 
- Added API for connecting to database and viewing events. 


## [0.1.0] - 2020-11-30 
### Added
- Added events and partial members to database.
- Added basic framework for websites.

## [0.0.1] - 2020-11-29
### Added
- This changelog to keep track of changes as the project developes. 
- A readme describing how to run a released version of the project. 
- A basic SQL dump file containing the database for the backend. The schema differes from the relational model created in that:
  * The `event` table does not have a foreign key to the `fundraiser` table.
  * `performance` table links to `event` via event_name only.
  * `budget` has many sections which are added as int fields. The sum of all fields should equal the amount of the corresponding row in `financial_transaction` when querying with transaction_no.
- Basic front-end elements.
- A .gitignore for Database. 