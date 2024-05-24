<?php

declare(strict_types=1);

namespace Tests\Unit\Drivers\Trip\Application\Read;

use App\Drivers\Trips\Application\Read\CsvDataReader;
use App\Drivers\Trips\Domain\Trip;
use App\Drivers\Trips\Domain\Trips;
use DateTimeImmutable;
use Generator;
use Illuminate\Http\UploadedFile;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group MustPass
 */
final class CsvDataReaderTest extends TestCase
{
    public static function subject(): CsvDataReader
    {
        return new CsvDataReader();
    }

    /**
     * @dataProvider csvDataProvider
     * @param string $csvContent
     * @param array $expected
     *
     * @return void
     */
    public function testRead(string $lines, array $expected): void
    {
        $file = $this->mockedUploadFile($lines);

        $trips = self::subject()->read($file);

        $this->assertInstanceOf(Trips::class, $trips);

        $this->assertTrips($expected, $trips);
    }

    public function assertTrips(array $expected, Trips $trips): void
    {
        $this->assertCount($expected['size'], $trips->getTrips());

        foreach ($expected['values'] as $index => $value) {
            $trip = $trips->getTrips()[$index];

            $this->assertInstanceOf(Trip::class, $trip);
            $this->assertEquals($value['id'], $trip->getId());
            $this->assertEquals($value['driver_id'], $trip->getDriverId());
            $this->assertEquals($value['pickup'], $trip->getPickup());
            $this->assertEquals($value['dropoff'], $trip->getDropoff());
        }
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function mockedUploadFile(string $csvContent): UploadedFile
    {
        $file = Mockery::mock(UploadedFile::class);

        $file->shouldReceive('getContent')
            ->once()
            ->andReturn($csvContent);

        return $file;
    }

    public static function csvDataProvider(): Generator
    {
        yield 'when correct csv format' => [
            'lines' => "id,driver_id,pickup,dropoff\n1,10,2024-01-01T00:00:00+00:00,2024-01-01T01:00:00+00:00\n2,20,2024-02-01T00:00:00+00:00,2024-02-01T01:00:00+00:00",
            'expected' => [
                'size' => 2,
                'values' => [
                    [
                        'id' => 1,
                        'driver_id' => 10,
                        'pickup' => new DateTimeImmutable('2024-01-01T00:00:00+00:00'),
                        'dropoff' => new DateTimeImmutable('2024-01-01T01:00:00+00:00'),
                    ],
                    [
                        'id' => 2,
                        'driver_id' => 20,
                        'pickup' => new DateTimeImmutable('2024-02-01T00:00:00+00:00'),
                        'dropoff' => new DateTimeImmutable('2024-02-01T01:00:00+00:00'),
                    ]
                ],
            ],
        ];
    }
}
