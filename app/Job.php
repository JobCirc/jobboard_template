<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title',
        'city',
        'state',
        'ref',
        'url',
        'company_name',
        'description',
        'qualifications',
        'category',
        'status',
        'parent_job',
        'parent_company',
    ];

    public function views() {
        return $this->hasMany('App\View', 'job');
    }

    public function clicks() {
        return $this->hasMany('App\Redirect', 'job');
    }

    public function location() {
        if($this->state == '')
            return $this->city;
        elseif($this->city == '')
            return $this->state;
        else
            return $this->city.', '.$this->state;
    }

    public static function shuffle($jobs) {
        $jobs = $jobs->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m/d/Y');
        });
        $collect = [];
        foreach($jobs as &$data) {
            $data = $data->shuffle();
            $collect[] = $data->shuffle();
        }
        
        return Self::paginateCollection(collect(array_flatten($collect)), 15);
    }

    public static function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null) {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'pageName' => $pageName,
                'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                'query' => $query,
                'fragment' => $fragment
            ]
        );

        return $paginator;
    }
}


