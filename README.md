Converter DBF to Mysql
======================

This is command line frontend to [inok-dbf2mysql](https:github.com/nchizhov/inok-dbf2mysql) php class. Use to convert all _dbf_ files in a directory or a list of _dbf_ files in the directory 


## Requirements
* PHP version 5.4.0 or higher
* composer
* git client
* [Inok\Dbf2mysql](https://github.com/nchizhov/inok-dbf2mysql)
* [Inok\Dbf](https://github.com/nchizhov/inok-dbf)

## Usage
> dbftomysql.php 
### options:

- **-h=** db_host or **-h=url:port** 'db_host:db_port' - MySQL Server (default host: _localhost_) (default port: _3306_)'
- -u= '[db_username] - MySQL Username (default: root)'
- -p= '[db_password] - MySQL User Password (default: empty)'
- -n= '[db_name] - MySQL Database Name: should exists (required)'
- -c= '[db_charset] - MySQL Table Charset (default: utf-8)'
- -f= '[dbf_charset] - DBF-file Charset for tables without defined encoding (default: 850)'
- -d= '[dbf_path] - Path to DBF-files directory to be converted (required)'
- -l= '[dbf_list] - List of import DBF-files: without extension, case-insensitive. 
If null - import of all files from directory (default: null)'\n
- -b= '[table_prefix] - Add prefix for table name (default: null)'
- -k= '[key_field] - Adds index to MySQL table after import (default: null)'
- -i= '[columns_only] - Ignore Index Imports only columns from DBF-file (default: false)'
- -x= '[deleted_records] - Import records marked for exclusion: creating column with name 'deleted' (default: false)'
- -v= '[verbose] - Show import process in console (default: true)'
- -l= '[log_path] - Log-file with import process. If empty or null - not logging (default: current script directory)
### Installation
Using terminal go to the directory to place _dbftomysql_ and type the followings commands:
```sh
git clone https://github.com/jobdiogenes/dbftomysql.git
cd dbftomysql
composer install
```

Convertion standards

* DATE and TIME fields -> NULL
* GENERAL and IMAGE fields -> BLOB
* LOGICAL -> _1_ or _0_
* MEMO -> TEXT