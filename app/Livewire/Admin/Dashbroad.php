<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Dashbroad")]
#[Layout("components.layouts.admin")]
class Dashbroad extends Component
{
    use WithPagination;

    public $viewsChart;

    public $filterChart = 'day';


    public function mount(){
        // $this->loadData();
        $this->loadData();
    }

    public function updatedFilterChart(){
        // dd(1);
        $this->loadData();
    }


    public function loadData()
    {
        if ($this->filterChart === 'day') {
            $this->loadHourlyData();
        } elseif ($this->filterChart === 'week') {
            $this->loadDailyData(now()->startOfWeek(), now()->endOfWeek(), 'Lượt xem tuần này');
        } elseif ($this->filterChart === 'month') {
            $this->loadDailyData(now()->startOfMonth(), now()->endOfMonth(), 'Lượt xem tháng này');
        }
    }



    public function setData($labels, $data, $type = 'bar', $label, $title){
        return  [
            'type' => $type,
            'data' => [
                    'labels' => $labels,
                    'datasets' => [
                        [
                            'label' => $label,
                            'data' => $data,
                        ]
                ],
            ],
             'options' => [
                'plugins'=> [
                    'title'=> [
                        'display'=> true,
                        'text'=> $title
                    ]
                ]
            ]
        ];
    }

    public function loadHourlyData()
    {
        $results = DB::table('views')
            ->selectRaw("strftime('%H', created_at) as hour, COUNT(*) as views")
            ->whereDate('created_at', now()->toDateString())
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hours = array_fill(0, 24, 0);
        foreach ($results as $item) {
            $hours[(int)$item->hour] = $item->views;
        }

        $this->viewsChart =  $this->setData(array_map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00', range(0, 23)), array_values($hours), 'line', 'Luợt xem', 'Lượt xem hôm nay');
    }

    public function loadDailyData(Carbon $start, Carbon $end, $title = null)
    {
        $results = DB::table('views')
            ->selectRaw("date(created_at) as day, COUNT(*) as views")
            ->whereBetween('created_at', [$start->toDateString(), $end->toDateString()])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $days = [];
        while ($start <= $end) {
            $key = $start->format('Y-m-d');
            $days[$key] = 0;
            $start->addDay();
        }

        foreach ($results as $item) {
            $days[$item->day] = $item->views;
        }


        $this->viewsChart = $this->setData(array_keys($days), array_values($days), 'line', 'Luợt xem', $title);
    }


    public function render()
    {
        return view('livewire.admin.dashbroad');
    }
}
