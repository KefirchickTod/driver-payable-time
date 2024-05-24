<?php

declare(strict_types=1);

namespace Tests\Unit\Drivers\Trip\Domain;

use App\Drivers\Trips\Domain\Trip;
use PHPUnit\Framework\TestCase;

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group MustPass
 */
final class TripTest extends TestCase
{
    public static function subject(array $data): Trip
    {
        return Trip::createFromArray($data);
    }

    /**
     * @dataProvider tripProvider
     */
    public function testTripCreation(array $data, array $expected): void
    {
        $trip = self::subject($data);

        $this->assertEquals($expected['id'], $trip->getId());
        $this->assertEquals($expected['driver_id'], $trip->getDriverId());
        $this->assertEquals($expected['pickup'], $trip->getPickup()->format('Y-m-d H:i:s'));
        $this->assertEquals($expected['dropoff'], $trip->getDropoff()->format('Y-m-d H:i:s'));
    }

    /**
     * @dataProvider tripProvider
     */
    public function testTripValue(array $data, array $expected): void
    {
        $trip = self::subject($data);

        $this->assertEquals($expected['value'], $trip->value());
    }

    /**
     * @dataProvider tripProvider
     */
    public function testGetDurationInMinutes(array $data, array $expected): void
    {
        $trip = self::subject($data);

        $this->assertEquals($expected['duration'], $trip->getDurationInMinutes());
    }

    public static function tripProvider(): \Generator
    {
        yield 'example trip' => [
            'data' => [
                'id' => 1,
                'driver_id' => 101,
                'pickup' => '2023-05-01 08:00:00',
                'dropoff' => '2023-05-01 08:30:00',
            ],
            'expected' => [
                'id' => 1,
                'driver_id' => 101,
                'pickup' => '2023-05-01 08:00:00',
                'dropoff' => '2023-05-01 08:30:00',
                'value' => [
                    'driver_id' => 101,
                    'pickup' => '2023-05-01 08:00:00',
                    'dropoff' => '2023-05-01 08:30:00'
                ],
                'duration' => 30,
            ]
        ];

        yield 'another example trip' => [
            'data' => [
                'id' => 2,
                'driver_id' => 202,
                'pickup' => '2023-06-01 10:15:00',
                'dropoff' => '2023-06-01 10:45:00',
            ],
            'expected' => [
                'id' => 2,
                'driver_id' => 202,
                'pickup' => '2023-06-01 10:15:00',
                'dropoff' => '2023-06-01 10:45:00',
                'value' => [
                    'driver_id' => 202,
                    'pickup' => '2023-06-01 10:15:00',
                    'dropoff' => '2023-06-01 10:45:00'
                ],
                'duration' => 30,
            ]
        ];
    }
}
