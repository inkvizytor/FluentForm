<?php namespace inkvizytor\FluentForm\Controls\Exclusive;

use Carbon\Carbon;

/**
 * Class DateTimeRange
 *
 * @package inkvizytor\FluentForm
 */
class DateTimeRange extends DateTime
{
    /**
     * @return string
     */
    public function render()
    {
        $locale = [
            'format' => $this->withTime() ? config('fluentform.datetimerange.format.datetime') : config('fluentform.datetimerange.format.date'),
            'separator' => config('fluentform.datetimerange.separator'),
            'applyLabel' => trans('fluentform::datetimerange.apply'),
            'cancelLabel' => trans('fluentform::datetimerange.cancel'),
            'fromLabel' => trans('fluentform::datetimerange.from'),
            'toLabel' => trans('fluentform::datetimerange.to'),
            'customRangeLabel' => trans('fluentform::datetimerange.custom'),
            'daysOfWeek' => [
                trans('fluentform::datetimerange.days.su'),
                trans('fluentform::datetimerange.days.mo'),
                trans('fluentform::datetimerange.days.tu'),
                trans('fluentform::datetimerange.days.we'),
                trans('fluentform::datetimerange.days.th'),
                trans('fluentform::datetimerange.days.fr'),
                trans('fluentform::datetimerange.days.sa')
            ],
            'monthNames' => [
                trans('fluentform::datetimerange.months.january'),
                trans('fluentform::datetimerange.months.february'),
                trans('fluentform::datetimerange.months.march'),
                trans('fluentform::datetimerange.months.april'),
                trans('fluentform::datetimerange.months.may'),
                trans('fluentform::datetimerange.months.june'),
                trans('fluentform::datetimerange.months.july'),
                trans('fluentform::datetimerange.months.august'),
                trans('fluentform::datetimerange.months.september'),
                trans('fluentform::datetimerange.months.october'),
                trans('fluentform::datetimerange.months.november'),
                trans('fluentform::datetimerange.months.december')
            ],
            'firstDay' => config('fluentform.datetimerange.firstDay')
        ];

        $ranges = [
            trans('fluentform::datetimerange.ranges.today') => [
                Carbon::now()->toDateString(),
                Carbon::now()->addDay()->toDateString()
            ],
            trans('fluentform::datetimerange.ranges.yesterday') => [
                Carbon::now()->subDay()->toDateString(),
                Carbon::now()->toDateString()
            ],
            trans('fluentform::datetimerange.ranges.last7days') => [
                Carbon::now()->subDays(6)->toDateString(),
                Carbon::now()->addDay()->toDateString()
            ],
            trans('fluentform::datetimerange.ranges.last30days') => [
                Carbon::now()->subDay(29)->toDateString(),
                Carbon::now()->addDay()->toDateString()
            ],
            trans('fluentform::datetimerange.ranges.thismonth') => [
                Carbon::now()->startOfMonth()->toDateString(),
                Carbon::now()->endOfMonth()->addDay()->toDateString()
            ],
            trans('fluentform::datetimerange.ranges.lastmonth') => [
                Carbon::now()->subMonth()->startOfMonth()->toDateString(),
                Carbon::now()->subMonth()->endOfMonth()->addDay()->toDateString()
            ]
        ];

        $config = [
            'timePicker' => $this->withTime(),
            'timePickerIncrement' => 5,
            'timePicker24Hour' => config('fluentform.datetimerange.timePicker24Hour'),
            'ranges' => $ranges,
            'locale' => $locale,
            'opens' => config('fluentform.datetimerange.opens')
        ];

        $this->data('toggle', 'datetimerange');
        $this->data('config', array_merge($config, $this->config));

        return $this->html()->tag('input', array_merge($this->getOptions(), [
            'type' => 'text',
            'name' => $this->name,
            'value' => $this->binder()->value($this->key($this->name), $this->value)
        ]));
    }
} 