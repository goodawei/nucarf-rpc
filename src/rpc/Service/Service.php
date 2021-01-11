<?php
/**
 * Created by PhpStorm.
 * User: lihongwei
 * Date: 2020-12-20
 * Time: 12:27
 */

namespace Nucarf\NucarfRpc\Service;

use Thrift\ClassLoader\ThriftClassLoader;
$loader = new ThriftClassLoader();
$loader->register();


use Thrift\Exception\TException;
use Thrift\Factory\TTransportFactory;
use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\TMultiplexedProcessor;
use Thrift\server\TSwooleServerTransport;
use Thrift\server\TSwooleServer;

class Service
{
    public function handle()
    {
        try {
            $hosts = "192.168.10.10";  // 服务端对外IP地址
            $port = 9999;// 服务端对外端口

            $tThrift = new TTransportFactory();
            $bThrift = new TBinaryProtocolFactory();
            $processor = new TMultiplexedProcessor();

            $services = config('rpc');

            foreach ($services as $service) {
                $reflexImpl = new \ReflectionClass($service);
                $reflexName = $reflexImpl->getShortName();

                $cla = "\Goods\Rpc\\tag\\" . $reflexName . "Processor";

                $impmCla =  "\App\ServiceImpl\\" . $reflexName;

                $processorItem = new $cla(new $impmCla());

                $processor->registerProcessor($reflexName.'If',$processorItem);
            }
//            $processor->registerProcessor('HelloWorldIf', new HelloWorldProcessor(new AttrController())); // 注意：OrderServiceIf -- servername需和客户端一致
//            $processor->registerProcessor('TagServiceIf', new TagServiceProcessor(new TagController())); // 注意：OrderServiceIf -- servername需和客户端一致
            $setting = [
                'daemonize' => false,
                'worker_num' => 2,
                'http_server_port' => 9998,
                'http_server_host' => $hosts,
                'log_file' => storage_path('/logs/swoole.log'),
                'pid_file' => storage_path('/logs/thrift.pid'),
            ];

            $socket = new TSwooleServerTransport($hosts, $port, $setting);
            $server = new TSwooleServer($processor, $socket, $tThrift, $tThrift, $bThrift, $bThrift);
            $server->serve();
        } catch (TException $tx) {
            print 'TException: '.$tx->getMessage()."\n";
        }
    }
}

