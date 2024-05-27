<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventHour;
use App\Models\EventLocation;
use App\Models\EventTicket;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event = Event::updateOrcreate(
            ['name' => 'Visitação Mirante',],
            [
                'description' => fake('pt_BR')->randomHtml,
                'date' => fake()->dateTimeBetween('+1 day', '+2 months', 'America/Boa_Vista'),
                'is_draft' => true,
            ]
        );

        EventLocation::updateOrCreate([
            'event_id' => $event->id,
            'name' => 'Mirante Edileusa Lós',
        ], [
            'cep' => '69301-280',
            'address' => 'Tv. Pres. Castelo Branco',
            'number' => 205,
            'neighborhood' => 'Centro',
        ]);

        $now = Carbon::parse(date('Y-m-d') . ' 15:00:00.0000');
        $hours = [$now];
        do {
            array_push($hours, $now->addMinutes(30)->clone());
        } while ($now->isBefore(date('Y-m-d') . ' 20:30:00.0000'));

        usort($hours, fn (Carbon $a, Carbon $b) => $a->hour - $b->hour);

        foreach ($hours as $hour) {
            $eventHour = EventHour::updateOrcreate(
                [
                    'event_id' => $event->id,
                    'start' => $hour->toString(),
                    'end' => $hour->addMinutes(29)->clone()->toString(),
                ],
                [
                    'vacancy_limit' => 20,
                    'vacancy_current' => 20,
                ]
            );

            if (EventTicket::count() === (20 * count($hours))) {
                continue;
            }

            for ($i = 0; $i <= 19; $i++) {
                EventTicket::create([
                    'event_hour_id' => $eventHour->id,
                ]);
            }
        }
    }
}
