<?php

declare(strict_types=1);

namespace DH\Auditor\Tests\Event;

use DH\Auditor\Event\LifecycleEvent;
use DH\Auditor\EventSubscriber\AuditEventSubscriber;
use DH\Auditor\Exception\InvalidArgumentException;
use DH\Auditor\Tests\Traits\AuditorTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class LifecycleEventTest extends TestCase
{
    use AuditorTrait;

    public function testLifecycleEvent(): void
    {
        $payload = [
            'entity' => AuditEventSubscriber::class,
            'table' => '',
            'type' => '',
            'object_id' => '',
            'discriminator' => '',
            'transaction_hash' => '',
            'diffs' => '',
            'blame_id' => '',
            'blame_user' => '',
            'blame_user_fqdn' => '',
            'blame_user_firewall' => '',
            'ip' => '',
            'created_at' => '',
        ];

        $event = new LifecycleEvent($payload);
        self::assertSame($payload, $event->getPayload());
    }

    public function testLifecycleEventWithInvalidPayload(): void
    {
        self::expectException(InvalidArgumentException::class);
        $event = new LifecycleEvent(['invalid payload']);
    }

    public function testSetValidPayload(): void
    {
        $payload = [
            'entity' => AuditEventSubscriber::class,
            'table' => '',
            'type' => '',
            'object_id' => '',
            'discriminator' => '',
            'transaction_hash' => '',
            'diffs' => '',
            'blame_id' => '',
            'blame_user' => '',
            'blame_user_fqdn' => '',
            'blame_user_firewall' => '',
            'ip' => '',
            'created_at' => '',
        ];

        $event = new LifecycleEvent($payload);

        $payload['entity'] = 'new entity';
        $event->setPayload($payload);
        self::assertSame($payload, $event->getPayload());
    }

    public function testSetInvalidPayload(): void
    {
        $payload = [
            'entity' => AuditEventSubscriber::class,
            'table' => '',
            'type' => '',
            'object_id' => '',
            'discriminator' => '',
            'transaction_hash' => '',
            'diffs' => '',
            'blame_id' => '',
            'blame_user' => '',
            'blame_user_fqdn' => '',
            'blame_user_firewall' => '',
            'ip' => '',
            'created_at' => '',
        ];

        $event = new LifecycleEvent($payload);

        self::expectException(InvalidArgumentException::class);
        $payload = ['invalid payload'];
        $event->setPayload($payload);
    }
}
