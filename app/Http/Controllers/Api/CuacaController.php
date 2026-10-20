<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CuacaLokasi;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CuacaController extends Controller
{
    public function index(): JsonResponse
    {
        $apiKey = config('services.openweather.key');

        if (! $apiKey) {
            return response()->json([
                'data' => [],
                'meta' => ['error' => 'OpenWeatherMap API key belum dikonfigurasi.'],
            ], 500);
        }

        $lokasi = CuacaLokasi::where('is_aktif', true)->get();

        $data = [];

        foreach ($lokasi as $lok) {
            $response = Http::timeout(10)->get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => $lok->latitude,
                'lon' => $lok->longitude,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if (! $response->successful()) {
                continue;
            }

            $cuaca = $this->transformOpenWeatherMap($response->json(), $lok->id, $lok->nama);

            if ($cuaca) {
                $data[] = $cuaca;
            }
        }

        return response()->json([
            'data' => $data,
            'meta' => [
                'total' => count($data),
                'source' => 'openweathermap.org',
            ],
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $apiKey = config('services.openweather.key');

        if (! $apiKey) {
            return response()->json([
                'data' => null,
                'meta' => ['error' => 'OpenWeatherMap API key belum dikonfigurasi.'],
            ], 500);
        }

        $lok = CuacaLokasi::where('id', $id)->where('is_aktif', true)->first();

        if (! $lok) {
            return response()->json([
                'data' => null,
                'meta' => ['error' => 'Lokasi tidak ditemukan.'],
            ], 404);
        }

        $response = Http::timeout(10)->get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $lok->latitude,
            'lon' => $lok->longitude,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        if (! $response->successful()) {
            return response()->json([
                'data' => null,
                'meta' => ['error' => 'Gagal mengambil data cuaca.'],
            ], 502);
        }

        $cuaca = $this->transformOpenWeatherMap($response->json(), $lok->id, $lok->nama);

        return response()->json([
            'data' => $cuaca,
            'meta' => ['source' => 'openweathermap.org'],
        ]);
    }

    private function transformOpenWeatherMap(array $raw, string $lokasiId, string $namaLokasi): ?array
    {
        $main = $raw['main'] ?? [];
        $weather = $raw['weather'][0] ?? [];
        $dt = $raw['dt'] ?? null;
        $timezone = $raw['timezone'] ?? 0;

        $temp = $main['temp'] ?? null;
        $humidity = $main['humidity'] ?? null;

        if ($temp === null || $humidity === null) {
            return null;
        }

        $tempC = round($temp);
        $conditionId = $weather['id'] ?? 800;
        $conditionMain = $weather['main'] ?? 'Clear';

        return [
            'id' => $lokasiId,
            'name' => $namaLokasi,
            'forecasts' => [
                [
                    'day' => $this->formatHari($dt, $timezone),
                    'condition' => $this->mapKondisi($conditionId, $conditionMain),
                    'temperature' => "{$tempC}-".($tempC + 2),
                    'humidity' => "{$humidity}-".min(100, $humidity + 10).'%',
                ],
            ],
        ];
    }

    private function formatHari(?int $dt, int $timezone): string
    {
        if (! $dt) {
            return '-';
        }

        $waktuLokal = Carbon::createFromTimestamp($dt)->addSeconds($timezone);

        $hari = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
        ][$waktuLokal->format('D')] ?? $waktuLokal->format('D');

        $bulan = [
            'Jan' => 'Jan',
            'Feb' => 'Feb',
            'Mar' => 'Mar',
            'Apr' => 'Apr',
            'May' => 'Mei',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Ags',
            'Sep' => 'Sep',
            'Oct' => 'Okt',
            'Nov' => 'Nov',
            'Dec' => 'Des',
        ][$waktuLokal->format('M')] ?? $waktuLokal->format('M');

        return "{$hari}, {$waktuLokal->day} {$bulan}";
    }

    private function mapKondisi(int $id, string $main): string
    {
        $map = [
            200 => 'Hujan Petir Ringan',
            201 => 'Hujan Petir',
            202 => 'Hujan Petir Lebat',
            210 => 'Petir Ringan',
            211 => 'Petir',
            212 => 'Petir Lebat',
            221 => 'Petir Rintik',
            230 => 'Petir Ringan',
            231 => 'Petir',
            232 => 'Petir Lebat',
            300 => 'Gerimis Ringan',
            301 => 'Gerimis',
            302 => 'Gerimis Lebat',
            310 => 'Hujan Gerimis Ringan',
            311 => 'Hujan Gerimis',
            312 => 'Hujan Gerimis Lebat',
            313 => 'Gerimis Lebat',
            314 => 'Hujan Gerimis Lebat',
            321 => 'Gerimis',
            500 => 'Hujan Ringan',
            501 => 'Hujan',
            502 => 'Hujan Lebat',
            503 => 'Hujan Sangat Lebat',
            504 => 'Hujan Ekstrim',
            511 => 'Salju',
            520 => 'Hujan Ringan',
            521 => 'Hujan',
            522 => 'Hujan Lebat',
            531 => 'Hujan Acak',
            600 => 'Salju Ringan',
            601 => 'Salju',
            602 => 'Salju Lebat',
            611 => 'Ajus',
            612 => 'Salju Ringan',
            613 => 'Salju',
            615 => 'Hujan Salju Ringan',
            616 => 'Hujan Salju',
            620 => 'Salju Ringan',
            621 => 'Salju',
            622 => 'Salju Lebat',
            701 => 'Kabur',
            711 => 'Asap',
            721 => 'Kabur',
            731 => 'Pasir Debu',
            741 => 'Kabut',
            751 => 'Pasir',
            761 => 'Debu',
            762 => 'Kabut Vulkanik',
            771 => 'Kabut',
            781 => 'Puting Beliung',
            800 => 'Cerah',
            801 => 'Berawan Ringan',
            802 => 'Berawan',
            803 => 'Berawan Tebal',
            804 => 'Berawan Penuh',
        ];

        return $map[$id] ?? $main;
    }
}
