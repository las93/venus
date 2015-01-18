===================
Venus 1.0.3
===================

IMPORTANT CHANGE

1/ Bug fixed : on the scaffolding

===================
Venus 1.0.2
===================

IMPORTANT CHANGE

1/ Bug fixed : Scaffolding create entities with the capacity to use entities in all domain 
2/ Add : Ldap library (with conf file) and Google Map Pro 
3/ Add : Image library
4/ Bug fixed : When you do an inner join , correction in the entity for the join, Insert is now possible with a join entity
5/ Update : Big updated of the scaffolding, improve the join in the scaffolding, document to add the join concept for the scaffolding
6/ Bug fixed : Batch of scaffolding to write in PSR2 and works with join  
7/ Update : Take the value in Db.conf + bit define like a bool not like an int 
8/Bug Fixed : The router accepts an empty GET where your constraint is .*

MINOR CHANGE

1/ Add File kind in Form library
2/ Remove : a temporary file 
3/ Bug fixed : On the variable in the template 
4/ Bug fixed : have the capacity to add a value for the kind decimal of mysql 
5/ Bug fixed : In the AbstractLogger 

===================
Venus 1.0.1
===================

IMPORTANT CHANGE

1/ Router take * for all characters
2/ Add Response library with mock, json and yaml support
3/ New logger like PSR-3
4/ Bug fixed : The truncate method in the ORM is in error
5/ Add : New method truncate for a Model
6/ Add : Http library to get all Put parameter in PHP and method to create automatic http status header
7/ Add : On Duplicate Key Update in the Orm
8/ Add : Accept On Duplicate Key Method in the save of Entity

MINOR CHANGE

1/ Add an Interface for the I18n library
2/ Modify the mistake comment in Translator
3/ Advance rewrite in PSR-1 and PSR-2
4/ Add method in Config to know if the config file have a redirect or not
5/ separate the cache for the classic config and a redirect profil
6/ Add : Complete the document
