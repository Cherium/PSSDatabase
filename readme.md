## Introduction

## Instructions 

### Set up (In progress)
Download all files to a folder.

To run the project, first install and run the Apache distribution with MySQL and PHP using `http://www.appservnetwork.com`. This installation is for Windows 10 only. 

Download MySQL Workbench by mostly following the guide from `https://www.mysqltutorial.org/install-mysql/`. Note that some parts of the installation guide is out of date with the actual instructions.

A local connection should have been created with the installation. Open MySQL Workbench and select the Local instance MySQL<port>. Create a new user by selecting `Navigation > Administration > Users and Priviledges > Add Account`

Move all contents of the folder `Website` into `<Disk>:\AppServ\www`, where `<Disk>` is the disk that the Apache distribution was installed on. 

### Database configuration
Under `Login` set `Login Name` to `newuser`, `Authentication Type` to `Standard`, `Limit to Hosts Matching` to `localhost`, and `Password` to `password`. Under `Account Limits`, set all queries and connections to `0`. Under `Administrative Roles`, select all the options. `Apply` changes.

Next, upload the `database.sql` dump file into MySQL. Select `Navigation > Administration > Data Import/Restore` and in the tab `Import from Disk` enter the path of the file under `Import from Self-Contained file`. In the `Import Progress` tab, select `Start Import`. 

### Run
Open a web browser and navigate to the address `http://localhost/index.php`.