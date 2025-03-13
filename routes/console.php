<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule as ScheduleFacade;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Votre tâche de détection des retards de paiement
ScheduleFacade::command('recouvrements:detecter-retards')->everyMinute()->sendOutputTo('recouvrement-output.log');
