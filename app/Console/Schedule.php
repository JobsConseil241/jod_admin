<?php

namespace App\Console;

use Illuminate\Support\Facades\Schedule as ScheduleFacade;

class Schedule
{
    /**
     * Define the application's command schedule.
     */
    public function __invoke(): void
    {
        // Votre tâche de détection des retards de paiement
        ScheduleFacade::command('recouvrements:detecter-retards')->everyMinute()->sendOutputTo('recouvrement-output.log');

        // Vous pouvez ajouter d'autres tâches planifiées ici
        // Exemple:
        // ScheduleFacade::command('emails:send')->daily();
        // ScheduleFacade::command('app:clean-temp-files')->hourly();
        // ScheduleFacade::call(function () {
        //     // Logique personnalisée
        // })->daily();
    }
}
