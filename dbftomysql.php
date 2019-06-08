#!/usr/bin/env php
<?php
/**
 * 2019 Job Diógenes Ribeiro Borges
 *
 * NOTICE OF LICENSE
 *
 *Licensed under the GNU Public License, Version 3.0 (the "License");
 *you may not use this file except in compliance with the License.
 *You may obtain a copy of the License at
 *
 *https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 *Unless required by applicable law or agreed to in writing, software
 *distributed under the License is distributed on an "AS IS" BASIS,
 *WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *See the License for the specific language governing permissions and
 *limitations under the License.
 *
 *  @author    Job Diógenes Ribeiro Borges.
 *  @copyright Job Diógenes Ribeiro Borges.
 *  @license   https://www.gnu.org/licenses/gpl-3.0.en.html
 *  @version   1.0
*/
require_once 'lib/autoload.php';

$defaults = [
      "dbf_charset"     => 850,
      "log_path"        => realpath(dirname(__FILE__)."/..")."/dbfs2mysql.log"
    ];

$longoptions = Array(
        'db_host',
        'db_username',
        'db_password',
        'db_name',
        'db_charset',
        'dbf_charset',
        'dbf_path',
        'table_prefix',
        'key_field',
        'columns_only',
        'deleted_records',
        'verbose',
        'log_path');

$message = "
     usage: dbfstosql.php (options)\n
    -h= 'db_host - MySQL Server (default localhost)'
    or -h=url:port  'db_host:db_port - MySQL Port (default 3306)'
    -u= '[db_username] - MySQL Username (default: root)'
    -p= '[db_password] - MySQL User Password (default: empty)'
    -n= '[db_name] - MySQL Database Name: should exists (required)'
    -c= '[db_charset] - MySQL Table Charset (default: utf-8)'
    -f= '[dbf_charset] - DBF-file Charset for tables without defined encoding (default: 850)'
    -d= '[dbf_path] - Path to DBF-files directory to be converted (required)'
    -l= '[dbf_list] - List of import DBF-files: without extension, case-insensitive. 
        If null - import of all files from directory (default: null)'\n
    -b= '[table_prefix] - Add prefix for table name (default: null)'
    -k= '[key_field] - Adds index to MySQL table after import (default: null)'
    -i= '[columns_only] - Ignore Index Imports only columns from DBF-file (default: false)'
    -x= '[deleted_records] - Import records marked for exclusion: creating column with name 'deleted' (default: false)'
    -v= '[verbose] - Show import process in console (default: true)'
    -l= '[log_path] - Log-file with import process. If empty or null - not logging (default: current script directory)'\n
";

$opts = getopt("h:u:p:n:c:f:d:l:b:k:i:x:v:l",$longoptions);

if (sizeof($opts)==0) {
    print($message);
    exit();
}    

if (!array_key_exists('n',$opts) or !array_key_exists('d',$opts)){
    print("usage: dbfs2sql.php (options)\nOptions -n and -d are required!, call without options to see help\n\n");
    exit();
}

foreach(array_keys($opts) as $opt) switch($opt) {
    case 'h':
       $h =  explode(':',$opts['h']);
       $p['db_host'] = $h[0];
       if (sizeof($h)>1)
          $p['db_port'] =  (int)$h[1];
       break;
    case 'u':
       $p['db_username'] = $opts['u'];
       break;
    case 'p':       
       $p['db_password'] = $opts['p'];
       break;
    case 'n':
      $p['db_name'] = $opts['n'];
      break;
    case 'c':  
      $p['db_charset'] = $opts['c'];
      break;
    case 'f':  
      $p['dbf_charset'] = $opts['f'];
      break;
    case 'd':  
      $p['dbf_path'] = $opts['d'];
      break;
    case 'l':  
      $p['dbf_list'] = $opts['l'];
      break;
    case 'b':  
      $p['table_prefix'] = $opts['b'];
      break;
    case 'k':
      $p['key_field'] = $opts['k'];
      break;
    case 'i':
      $p['columns_only'] = $opts['i'];
      break;
    case 'x':
      $p['deleted_records'] = $opts['x'];
      break;
    case 'v':
      $p['verbose'] = $opts['v'];
      break;
    case 'l':
      $p['log_path'] = $opts['l'];
}
$p += $defaults;
new \Inok\Dbf2mysql\convert($p);
?>
