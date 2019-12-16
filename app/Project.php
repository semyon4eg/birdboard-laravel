<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function path()
    {
    	return "/projects/{$this->id}";
    }

    public function owner()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    /**
     * @param $body
     * @return Model
     */
    public function addTask($body)
    {
    	return $this->tasks()->create(compact('body'));
    }

    /**
     * @param array $tasks
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function addTasks(array $tasks)
    {
        return $this->tasks()->createMany($tasks);
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
