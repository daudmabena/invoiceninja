<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

/**
 * Class HeaderComposer
 * @package App\Http\ViewComposers
 */
class HeaderComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('header', $this->headerData());
    }

    /**
     * @return array
     */
    private function headerData()
    {
        if(!auth()->user())
            return [];
        
        //companies
        $companies = auth()->user()->companies;

        $data['current_company'] = $companies->first(function ($company){
            return $company->id == auth()->user()->company()->id;
        });

        $data['companies'] = $companies->reject(function ($company){
            return $company->id == auth()->user()->company()->id;
        });

        return $data;
    }

}