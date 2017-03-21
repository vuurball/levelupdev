<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Classes;

class Skills
{

    public static function getAllSkillsHash()
    {
        return $skillsHash = [
            //A
            'arm' => 'arm', //architecture
            'arc' => 'arc', //architecture
            'awr' => 'awr',
            'aws' => 'aws',
            'addm' => 'addm',
            'appium' => 'appium',
            'angular' => 'angular',
            'angularjs' => 'angular',
            'angular.js' => 'angular',
            'apache' => 'apache',
            'asp' => 'net',
            'asp.net' => 'net',
            'abap' => 'abap',
            'android' => 'android',
            'asic' => 'asic',
            'adtech' => 'adtech',
            'adonis' => 'adonis',
            'ansible' => 'ansible',
            //B
            'bi ' => 'bi',
            'bower' => 'bower',
            'bootstrap' => 'bootstrap',
            'big data' => 'big data',
            'bitbucket' => 'bitbucket',
            'bash' => 'bash',
            //C
            'c#' => 'c#',
            'citrix' => 'citrix',
            'c++' => 'c/c++',
            'composer' => 'composer',
            'chef' => 'chef',
            'css' => 'css',
            'codeigniter' => 'codeigniter',
            'cakephp' => 'cakephp',
            //D
            'dsp' => 'dsp',
            'django' => 'django',
            'design pattern' => 'design pattern',
            'datapath' => 'datapath',
            //E
            'ec2' => 'ec2',
            'extjs' => 'extjs',
            'etl ' => 'etl',
            'ericom' => 'ericom',
            'embedded' => 'rt/embedded',
            'elastic search' => 'elasticsearch',
            'elasticsearch' => 'elasticsearch',
            //F
            'flash' => 'flash',
            'firebase' => 'firebase',
            'freertos' => 'freertos', //rtos
            'foglight' => 'foglight',
            //G
            'git' => 'git',
            'grails' => 'grails',
            'golang' => 'golang',
            'groovy' => 'groovy',
            //H
            'http ' => 'http',
            'hadoop' => 'hadoop',
            'html' => 'html',
            //I
            'iot' => 'iot',
            'ionic' => 'ionic',
            'iar' => 'iar',
            'ios' => 'ios',
            //J
            'jmeter' => 'jmeter',
            'jsf' => 'jsf',
            'jira' => 'jira',
            'jenkins' => 'jenkins',
            'java' => 'java',
            'javascript' => 'javascript',
            'js' => 'javascript',
            'jquery' => 'jquery',
            //k
            'kinesis' => 'kinesis', //aws sdk
            'knockout' => 'knockout',
            'kerberos' => 'kerberos',
            'kernel' => 'kernel',
            //L
            'linux' => 'linux',
            'lambda' => 'lambda',
            'laravel' => 'laravel',
            'lumen' => 'lumen',
            //M
            'mips' => 'mips', //architecture
            'mysql' => 'mysql',
            'machine learning' => 'machine learning',
            'mvc' => 'mvc',
            'mqx' => 'mqx', //rtos
            'maven' => 'maven',
            'matlab' => 'matlab',
            'mongo' => 'mongodb',
            'mssql' => 'mssql',
            'magento' => 'magento',
            'memcached' => 'memcached',
            //N
            'nprinting' => 'nprinting',
            'ntlm' => 'ntlm',
            'npm' => 'npm',
            'node' => 'nodejs',
            'nosql' => 'nosql',
            'no sql' => 'nosql',
            'nucleus' => 'nucleus', //rtos
            'neo4j' => 'neo4j',
            //O
            'oem' => 'oem',
            'oracle' => 'oracle',
            'oop' => 'oop',
            'oath' => 'oath',
            'openid' => 'openid',
            //P
            'puppet' => 'puppet',
            'priority' => 'priority',
            'perl' => 'perl',
            'php' => 'php',
            'postgresql' => 'postgresql',
            'python' => 'python',
            //Q
            'qtp' => 'qtp', //auto qa
            //R
            'ranorex' => 'ranorex', //qa auto
            'redshift' => 'redshift',
            'rest' => 'rest',
            'rdp' => 'rdp',
            'rethinkdb' => 'rethinkdb',
            'ruby' => 'ruby',
            'react' => 'react',
            'redis' => 'redis',
            //S
            'sap' => 'sap',
            'sqlite' => 'sqlite',
            'soc' => 'soc', //system on chip
            'ssh' => 'ssh',
            'saml' => 'saml',
            'sql' => 'sql',
            'sails' => 'sails',
            's3' => 's3',
            'ssl' => 'ssl',
            'selenium' => 'selenium',
            'spring' => 'spring',
            //T
            'tomcat' => 'tomcat',
            'telerik' => 'telerik',
            'threadx' => 'threadx', //rto
            'tensilica' => 'tensilica', //architecture
            //u
            'unix' => 'unix',
            //V
            'vxworks' => 'vxworks', //rtos
            'vue' => 'vuejs',
            //W
            'winforms' => 'winforms',
            'wpf' => 'wordpress',
            'wordpress' => 'wordpress',
            'wcf' => 'wcf',
            'webdynpro' => 'webdynpro',
            //X
            //Y
            'yii' => 'yii',
            //Z
            //OTHER
            'net ' => 'net'
        ];
    }

    public static function getSkillKey($skillName)
    {
        $skills = self::getAllSkillsHash();
        return isset($skills[$skillName]) ? $skills[$skillName] : null;
    }

    public static function getAllSkillNames()
    {
        $skills = self::getAllSkillsHash();
        return array_keys($skills);
    }

    public static function getAllSkillKeys()
    {
        $skills = self::getAllSkillsHash();
        return array_unique($skills);
    }

}
