<?php namespace inkvizytor\FluentForm\Components\Complex;

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
    public function renderControl()
    {
        $locale = [
            'format' => $this->withTime() ? $this->root()->config('fluentform.datetimerange.format.datetime') : $this->root()->config('fluentform.datetimerange.format.date'),
            'separator' => $this->root()->config('fluentform.datetimerange.separator'),
            'applyLabel' => $this->root()->translator()->trans('fluentform::datetimerange.apply'),
            'cancelLabel' => $this->root()->translator()->trans('fluentform::datetimerange.cancel'),
            'fromLabel' => $this->root()->translator()->trans('fluentform::datetimerange.from'),
            'toLabel' => $this->root()->translator()->trans('fluentform::datetimerange.to'),
            'customRangeLabel' => $this->root()->translator()->trans('fluentform::datetimerange.custom'),
            'daysOfWeek' => [
                $this->root()->translator()->trans('fluentform::datetimerange.days.su'),
                $this->root()->translator()->trans('fluentform::datetimerange.days.mo'),
                $this->root()->translator()->trans('fluentform::datetimerange.days.tu'),
                $this->root()->translator()->trans('fluentform::datetimerange.days.we'),
                $this->root()->translator()->trans('fluentform::datetimerange.days.th'),
                $this->root()->translator()->trans('fluentform::datetimerange.days.fr'),
                $this->root()->translator()->trans('fluentform::datetimerange.days.sa')
            ],
            'monthNames' => [
                $this->root()->translator()->trans('fluentform::datetimerange.months.january'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.february'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.march'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.april'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.may'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.june'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.july'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.august'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.september'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.october'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.november'),
                $this->root()->translator()->trans('fluentform::datetimerange.months.december')
            ],
            'firstDay' => $this->root()->config('fluentform.datetimerange.firstDay')
        ];

        $ranges = [
            $this->root()->translator()->trans('fluentform::datetimerange.ranges.today') => [
                Carbon::now()->toDateString(),
                Carbon::now()->addDay()->toDateString()
            ],
            $this->root()->translator()->trans('fluentform::datetimerange.ranges.yesterday') => [
                Carbon::now()->subDay()->toDateString(),
                Carbon::now()->toDateString()
            ],
            $this->root()->translator()->trans('fluentform::datetimerange.ranges.last7days') => [
                Carbon::now()->subDays(6)->toDateString(),
                Carbon::now()->addDay()->toDateString()
            ],
            $this->root()->translator()->trans('fluentform::datetimerange.ranges.last30days') => [
                Carbon::now()->subDay(29)->toDateString(),
                Carbon::now()->addDay()->toDateString()
            ],
            $this->root()->translator()->trans('fluentform::datetimerange.ranges.thismonth') => [
                Carbon::now()->startOfMonth()->toDateString(),
                Carbon::now()->endOfMonth()->addDay()->toDateString()
            ],
            $this->root()->translator()->trans('fluentform::datetimerange.ranges.lastmonth') => [
                Carbon::now()->subMonth()->startOfMonth()->toDateString(),
                Carbon::now()->subMonth()->endOfMonth()->addDay()->toDateString()
            ]
        ];

        $config = [
            'timePicker' => $this->withTime(),
            'timePickerIncrement' => 5,
            'timePicker24Hour' => $this->root()->config('fluentform.datetimerange.timePicker24Hour'),
            'ranges' => $ranges,
            'locale' => $locale,
            'opens' => $this->root()->config('fluentform.datetimerange.opens')
        ];

        $this->data('toggle', 'datetimerange');
        $this->data('config', array_merge($config, $this->config));

        return $this->root()->html()->tag('input', array_merge($this->getAttr(), $this->getDataAttr(), [
            'type' => 'text',
            'name' => $this->getName(),
            'value' => $this->root()->binder()->value($this->getKey(), $this->value)
        ]));
    }
}
