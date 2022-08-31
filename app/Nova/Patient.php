<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Patient extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Patient::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('First Name', 'first_name')
                ->rules('required')
                ->onlyOnForms()
                ->hideFromIndex(),

            Text::make('Last Name', 'last_name')
                ->rules('required')
                ->onlyOnForms()
                ->hideFromIndex(),

            Date::make('Birth Date', 'birth_date')
                ->onlyOnForms()
                ->rules('required'),

            Text::make('Gender')
                ->onlyOnForms()
                ->rules('required'),

            new Panel('Address', $this->addressFields()),
        ];
    }

    protected function addressFields()
    {
        return [
            Text::make('Street Address', 'street_address')
                ->rules('required')
                ->onlyOnForms()
                ->hideFromIndex(),

            Text::make('City')
                ->rules('required')
                ->onlyOnForms()
                ->hideFromIndex(),

            Select::make('State')->options([
                'Abia' => 'Abia',
                'Adamawa' => 'Adamawa',
                'Akwaibom' => 'Akwaibom',
                'Anambra' => 'Anambra',
                'Bauchi' => 'Bauchi',
                'Bayelsa' => 'Bayelsa',
                'Benue' => 'Benue',
                'Borno' => 'Borno',
                'Cross River' => 'Cross River',
            ])->rules('required')->onlyOnForms()->hideFromIndex(),

            Text::make('Zip')
                ->rules('required')
                ->onlyOnForms()
                ->hideFromIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            Text::make('Name', function () {
                return sprintf('%s %s', $this->first_name, $this->last_name);
            }),

            Date::make('Birth Date', function () {
                return $this->birth_date;
            }),

            Text::make('Gender', function () {
                return sprintf('%s', $this->gender);
            }),

            Text::make('Created AT', function () {
                return sprintf('%s', $this->created_at);
            }),
        ];
    }
}
