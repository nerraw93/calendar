<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use App\Models\Date;
use DB;

class EventRepository implements EventRepositoryInterface
{
    protected $schedule;
    protected $date;
    
    /**
     * __construct
     *
     * @param  mixed $schedule
     * @return void
     */
    public function __construct(Event $schedule, Date $date)
    {
        $this->schedule = $schedule;
        $this->date = $date;
    }
    
    /**
     * allEvents
     *
     * @return void
     */
    public function allEvents()
    {
        return $this->schedule->all();
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function save($data)
    {
        DB::table('events')->truncate();

        return $this->schedule->create($data);
    }
    
    /**
     * allDates
     *
     * @return void
     */
    public function allDates()
    {
        return $this->date->all();
    }
}