<?php

//Conexion del servidor, para DB
$FOM->type = getenv('DB_TYPE') ?? 'MySQLi_Object';
$FOM->serverDB = getenv('DB_SERVER') ?? 'host.docker.internal';
$FOM->nameDB = getenv('DB_NAME') ?? 'vercontacto';
$FOM->userDB = getenv('DB_USER') ?? 'vercontacto';
$FOM->passDB = getenv('DB_PASS') ?? null;
$FOM->port = getenv('DB_PORT') ?? '3306';
