<?php

$Module = array( "name" => "PHP-Resque",
				 'variable_params' => true );

$ViewList = array();

$ViewList['index'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['list'] = array(
    'params' => array(),
    'uparams' => array('attr_int_1','attr_int_2','attr_int_3','attr_int_4','attr_int_5','search_in','sort_chat','keyword','tab','chat_id','message_text','nick','sort_msg','email','user_id','department_id','timefrom','timefrom_minutes','timefrom_hours','timeto','timeto_minutes','timeto_hours'),
    'multiple_arguments' => array('search_in'),
    'functions' => array('configure')
);

$ViewList['raw'] = array(
    'params' => array('id'),
    'functions' => array('configure')
);

$ViewList['getpreviouschats'] = array(
    'params' => array('chat_id'),
    'uparams' => array(),
    'functions' => array('use')
);

$ViewList['getpreviouschatsbyid'] = array(
    'params' => array('chat_id'),
    'uparams' => array(),
    'functions' => array('use')
);

$ViewList['listos'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['listpc'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['listop'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['options'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['listmsg'] = array(
    'params' => array('chat_id'),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['elastic'] = array(
    'params' => array(),
    'uparams' => array(),
    'functions' => array('configure')
);

$ViewList['delete'] = array(
    'params' => array('id'),
    'uparams' => array('csfr'),
    'functions' => array('configure')
);

$ViewList['deleteop'] = array(
    'params' => array('id'),
    'uparams' => array('csfr'),
    'functions' => array('configure')
);

$ViewList['deleteos'] = array(
    'params' => array('id'),
    'uparams' => array('csfr'),
    'functions' => array('configure')
);

$ViewList['deletepc'] = array(
    'params' => array('id'),
    'uparams' => array('csfr'),
    'functions' => array('configure')
);

$ViewList['deletemsg'] = array(
    'params' => array('chat_id','id'),
    'uparams' => array('csfr'),
    'functions' => array('configure')
);

$ViewList['updateelastic'] = array(
    'params' => array(),
    'uparams' => array('action'),
    'functions' => array('configure')
);

$FunctionList['use'] = array('explain' => 'Allow operator to use PHP-Resque module');
$FunctionList['configure'] = array('explain' => 'Allow operator to configure PHP-Resque module');