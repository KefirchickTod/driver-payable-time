<?php

declare(strict_types=1);

namespace Tests\Unit\Drivers\Trip\Domain;

use App\Drivers\Trips\Domain\Trip;
use App\Drivers\Trips\Domain\Trips;
use Carbon\Carbon;
use Generator;
use Tests\TestCase;

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group MustPass
 */
final class TripsTest extends TestCase
{
    public static function subject(array $trips): Trips
    {
        return new Trips($trips);
    }

    /**
     * @dataProvider tripsDataProvider
     *
     * @param array $trips
     * @param float $expected
     *
     * @return void
     */
    public function testCalculatePayableTime(array $trips, float $expected): void
    {
        $this->assertPayableTime(self::subject($trips)->calculatePayableTime(), $expected);
    }

    public function assertPayableTime(float $expected, float $minutes): void
    {
        $this->assertSame($expected, $minutes);
    }

    public static function tripsDataProvider(): Generator
    {
        yield 'when correct data' => [
            'trips' => [
                new Trip(1, 2, Carbon::parse('2024-05-23 20:43:38'), Carbon::parse('2024-05-23 23:43:38'))
            ],
            'expected' => 180.0,
        ];

        yield 'when incorrect data' => [
            'trips' => [
                new Trip(1, 2, Carbon::parse('2024-05-23 20:43:38'), Carbon::parse('2024-04-23 20:43:38'))
            ],
            'expected' => -43200.0
        ];
    }
}
