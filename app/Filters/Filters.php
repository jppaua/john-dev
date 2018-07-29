<?php
/**
 * Created by PhpStorm.
 * User: JohnP
 * Date: 2018-07-22
 * Time: 1:28 PM
 */

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];


    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

}