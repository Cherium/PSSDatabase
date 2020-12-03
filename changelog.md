# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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