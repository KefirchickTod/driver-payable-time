<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Application\Read;

use Illuminate\Http\UploadedFile;

use App\Drivers\Trips\Domain\Trip;
use App\Drivers\Trips\Domain\Trips;

readonly class CsvDataReader
{
    public function read(UploadedFile $file): Trips
    {
        $lines = explode(PHP_EOL, $file->getContent());

        $header = str_getcsv(array_shift($lines));

        return array_reduce(
            $lines,
            static function (Trips $trips, string $line) use ($header): Trips {
                if (!$line) {
                    return $trips;
                }

                $trips->push(Trip::createFromArray(array_combine($header, str_getcsv($line))));

                return $trips;
            },
            new Trips());
    }
}
