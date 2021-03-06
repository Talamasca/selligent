<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent;

/**
 *
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConnection()
    {
        $connection = new Connection();
        $client = $connection->open('login', 'password', 'tests/individual.xml');

        $this->assertInstanceOf(Connection::CLASS_SOAPCLIENT, $client);
    }

    /**
     *
     */
    public function testWrongSoapClassConnection()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $connection = new Connection('stdClass');
    }

    /**
     *
     */
    public function testWrongHeaderClassConnection()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $connection = new Connection(Connection::CLASS_SOAPCLIENT, 'stdClass');
    }

    /**
     *
     */
    public function testConnectionWithLogger()
    {
        $logger = $this
            ->getMockBuilder('Psr\Log\NullLogger')
            ->getMock()
        ;
        $logger
            ->expects($this->exactly(2))
            ->method('debug')
        ;

        $connection = new Connection();
        $connection->setLogger($logger);
        $connection->open('', '', 'tests/individual.xml');
    }
}
