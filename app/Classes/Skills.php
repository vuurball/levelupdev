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
            'backbone' => 'backbonejs',
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
            'd3' => 'd3js',
            'dsp' => 'dsp',
            'django' => 'django',
            'design pattern' => 'design pattern',
            'datapath' => 'datapath',
            //E
            'ec2' => 'ec2',
            'extjs' => 'extjs',
            'etl ' => 'etl',
            'ericom' => 'ericom',
            'ember' => 'emberjs',
            'embedded' => 'rt/embedded',
            'elastic search' => 'elasticsearch',
            'elasticsearch' => 'elasticsearch',
            'elixir' => 'elixir',
            'express' => 'expressjs',
            //F
            'flash' => 'flash',
            'flask' => 'flask',
            'firebase' => 'firebase',
            'freertos' => 'freertos', //rtos
            'foglight' => 'foglight',
            //G
            'git' => 'git',
            'grails' => 'grails',
            'golang' => 'golang',
            'groovy' => 'groovy',
            'gulp' => 'gulp',
            'grunt' => 'grunt',
            //H
            'http ' => 'http',
            'hadoop' => 'hadoop',
            'html' => 'html',
            'haksell' => 'haksell',
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
            'lisp' => 'lisp',
            'less' => 'less',
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
            'meteor' => 'meteor',
            'magento' => 'magento',
            'mariadb' => 'mariadb',
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
            'phalcon' => 'phalcon',
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
            'rust' => 'rust',
            'redis' => 'redis',
            //S
            'sap' => 'sap',
            'sqlite' => 'sqlite',
            'soc' => 'soc', //system on chip
            'ssh' => 'ssh',
            'saml' => 'saml',
            'symfony' => 'symfony',
            'saas' => 'saas',
            'sql' => 'sql',
            'scala' => 'scala',
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
            'vagrant' => 'vagrant',
            'vue' => 'vuejs',
            //W
            'winforms' => 'winforms',
            'wpf' => 'wordpress',
            'wordpress' => 'wordpress',
            'wcf' => 'wcf',
            'webdynpro' => 'webdynpro',
            'webpack' => 'webpack',
            //X
            //Y
            'yii' => 'yii',
            //Z
            'zend' => 'zend',
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
