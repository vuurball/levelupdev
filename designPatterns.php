<?php

//singleton

Class A
{

    static $var = null;

    static function getVarInstance()
    {

        if (self::$var == null)
        {
            self::$var = true;
        }
        return self::$var;
    }

}

//$obj = A::getVarInstance();
//strategy

Class Strategy
{

    public static function getClass($var)
    {
        return new $var . "1"();
    }

}

Class A1 implements inter
{

    public function run()
    {
        return "a";
    }

}

Class B1 implements inter
{

    public function run()
    {
        return "b";
    }

}

Interface inter
{

    public function run();
}

//Strategy::getClass("A")->run();
//chain of command

abstract class Handler
{

    public $nextHandler = null;

    public function setNextHandler($handler)
    {
        $this->nextHandler = $handler;
    }

    abstract public function handle($request);
}

class HandlerA extends Handler
{

    public $name = "Handler A";

    public function handle($request)
    {
        $request .= $this->name . "<br>";
        if ($this->nextHandler != null)
        {
            return $this->nextHandler->handle($request);
        } else
        {
            return $request;
        }
    }

}

class HandlerB extends Handler
{

    public $name = "Handler B";

    public function handle($request)
    {
        $request .= $this->name . "<br>";
        if ($this->nextHandler != null)
        {
            return $this->nextHandler->handle($request);
        } else
        {
            return $request;
        }
    }

}

class HandlerC extends Handler
{

    public $name = "Handler C";

    public function handle($request)
    {
        $request .= $this->name . "<br>";
        if ($this->nextHandler != null)
        {
            return $this->nextHandler->handle($request);
        } else
        {
            return $request;
        }
    }

}

//$handlera = new HandlerA();
//$handlerb = new HandlerB();
//$handlerc = new HandlerC();
//
//$handlera->setNextHandler($handlerb);
//$handlerb->setNextHandler($handlerc);
//
//echo $handlera->handle("test ");
//Flyweight

abstract class Cache
{

    private static $data;

    public static function get($key)
    {
        if (isset(self::$data[$key]))
        {
            return self::$data[$key];
        } else
        {
            return null; //handle
        }
    }

}

//memento

class Memento
{

    private $memento;

    public function __construct($obj)
    {
        $this->memento = $obj;
    }

    public function getMemento()
    {
        return $this->memento;
    }

}

class Song
{

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

}

class Player
{

    private $currentSong;

    public function playSong($song)
    {
        $this->currentSong = $song;
    }

    public function goBack(Memento $memento)
    {
        $this->currentSong = $memento->getMemento();
    }

    public function saveCurrent()
    {
        return new Memento(clone $this->currentSong);
    }

    public function getCurrentSong()
    {
        return $this->currentSong->getName() . "<br>";
    }

}

$song1 = new Song('Mooi');
$player = new Player();
$player->playSong($song1);
echo "play 1st song<br>";
echo $player->getCurrentSong();
$lastSong = $player->saveCurrent();
$song2 = new Song('Kleine oneindigheid');
$player->playSong($song2);
echo "play 2nd song<br>";
echo $player->getCurrentSong();
$player->goBack($lastSong);
echo "play previous song<br>";
echo $player->getCurrentSong();
