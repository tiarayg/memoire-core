<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:update-ready-capsules')
    ->everyMinute();