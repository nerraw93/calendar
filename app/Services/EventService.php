<?php

namespace App\Services;

use App\Repositories\Interfaces\EventRepositoryInterface;

class EventService
{
    protected $repository;
    
    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * getAllEvents
     *
     * @return void
     */
    public function getAllEvents()
    {
        $events = $this->repository->allEvents();

        foreach($events as $event) {
            $data = collect([
                'name' => $event->name,
                'from' => $event->start_date,
                'to' => $event->end_date,
                'days' => json_decode($event->days)
            ]);
        }
        
        return $data;
    }
    
    /**
     * addNewEvent
     *
     * @param  mixed $fields
     * @return void
     */
    public function saveEvent($fields)
    {
        $data = [
            "name" => $fields->name,
            "start_date" => $fields->from,
            "end_date" => $fields->to,
            "days" => json_encode($fields->days)
        ];
        
        $event = $this->repository->save($data);

        if ($event) {
            return $event;
        }
        else {
            return false;
        }
    }
    
    /**
     * getAllDates
     *
     * @return void
     */
    public function getAllDates()
    {
        return $this->repository->allDates();
    }
}