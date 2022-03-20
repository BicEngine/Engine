<?php

namespace Bic\Async\Tests;

use Bic\Async\Coroutine;

$value = random_int(2, (int)(PHP_INT_MAX / 4));

enum FiberStatus
{
    case IDLE;
    case RUNNING;
    case SUSPENDED;
    case TERMINATED;

    public static function get(\Fiber $fiber): self
    {
        return match (true) {
            $fiber->isSuspended() => self::SUSPENDED,
            $fiber->isRunning() => self::RUNNING,
            $fiber->isTerminated() => self::TERMINATED,
            default => self::IDLE,
        };
    }
}

test('Converting to a Fiber from a Coroutine retains its behavior', function (\Fiber $fiber) use ($value): void {
    // Ready for starting
    expect(FiberStatus::get($fiber))
        ->toBe(FiberStatus::IDLE)
        ->and($fiber->start($value))
            ->toBe($value)
    ;

    // Step #1
    expect(FiberStatus::get($fiber))
        ->toBe(FiberStatus::SUSPENDED)
        ->and($fiber->resume($value * 2))
            ->toBe($value * 2)
    ;

    // Step #2
    expect(FiberStatus::get($fiber))
        ->toBe(FiberStatus::SUSPENDED)
        ->and($fiber->resume($value * 3))
            ->toBeNull()
    ;

    // Finishing
    expect(FiberStatus::get($fiber))
        ->toBe(FiberStatus::TERMINATED)
        ->and($fiber->getReturn())
            ->toBe($value * 3)
    ;
})
    ->with([
        'Raw Fiber' => new \Fiber(static fn (int $init) => \Fiber::suspend(\Fiber::suspend($init))),
        'Coroutine::toFiber with Coroutine' => Coroutine::toFiber(
            (static fn (int $init): \Generator => yield (yield $init))($value)
        ),
        'Coroutine::toFiber with Closure' => Coroutine::toFiber(
            static fn (int $init): \Generator => yield (yield $init)
        ),
    ])
;

test('Converting to a Coroutine from a Fiber retains its behavior', function (\Generator $coroutine) use ($value): void {
    // Step #1
    expect($coroutine->valid())->toBeTrue()
        ->and($coroutine->current())->toBe($value)
        ->and($coroutine->send($value * 2))->toBe($value * 2)
    ;

    // Step #2
    expect($coroutine->valid())->toBeTrue()
        ->and($coroutine->current())->toBe($value * 2)
        ->and($coroutine->send($value * 3))->toBeNull()
    ;

    // Finishing
    expect($coroutine->valid())->toBeFalse()
        ->and($coroutine->current())->toBe(null)
        ->and($coroutine->getReturn())->toBe($value * 3)
    ;
})
    ->with([
        // Coroutine
        'Raw Coroutine' => (static fn (int $value): \Generator => yield (yield $value))($value),
        'Coroutine::fromFiber' => Coroutine::fromFiber(
            new \Fiber(static fn () => \Fiber::suspend(\Fiber::suspend($value)))
        ),
    ])
;


