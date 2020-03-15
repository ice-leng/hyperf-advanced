<?php

namespace Common\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Logger\LoggerFactory;
use Lengbin\YiiDb\Event;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * @Listener()
 */
class ActiveRecordListener implements ListenerInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get(LoggerFactory::class)->get('db');
    }

    /**
     * @inheritDoc
     */
    public function listen(): array
    {
        return [
            Event::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function process(object $event)
    {
        $this->logger->info('class: ' . get_class($event) . ' eventName: ' . $event->name . ' table ' . $event->sender->tableName(), $event->sender->getAttributes());
    }
}
