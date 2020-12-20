<?php
/**
 * Created by PhpStorm.
 * User: lihongwei
 * Date: 2020-12-20
 * Time: 12:27
 */

namespace Nucarf\NucarfRpc\Service;
//
//error_reporting(E_ALL);
//
//define('THRIFT_ROOT', __DIR__);
//echo __DIR__;exit;
//require_once  THRIFT_ROOT.'/Thrift/ClassLoader/ThriftClassLoader.php';
//require_once __DIR__ . '/vendor/autoload.php';
//
//use Thrift\ClassLoader\ThriftClassLoader;
//
//$loader = new ThriftClassLoader();
//$loader->registerNamespace('Thrift', THRIFT_ROOT);
//$loader->register();


use Thrift\Exception\TException;
use Thrift\Factory\TTransportFactory;
use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\TMultiplexedProcessor;
use Thrift\Server\TServerSocket;
use Thrift\Server\TSimpleServer;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TPhpStream;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\server\TSwooleServerTransport;
use Thrift\server\TSwooleServer;
use Thrift\Transport\TSocket;
use Nucarf\NucarfRpc\Impl\Tag;
//use Goods\Rpc\Attr\HelloWorldProcessor;
//use Goods\Rpc\Tag\TagServiceProcessor;

class Service
{
    public function handle()
    {
        dd('fsdf');
    }
}