<?php

namespace App\Repositories\Interfaces;

interface EventRepositoryInterface
{
    public function allEvents();

    public function save($data);

    public function allDates();
}