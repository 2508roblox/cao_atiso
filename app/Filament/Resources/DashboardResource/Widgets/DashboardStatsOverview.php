<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Visitor;
use App\Models\OnlineUser;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\LineChartWidget;

class DashboardStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            $this->createVisitorTodayCard(),
            $this->createTotalVisitorCard(),
            $this->createOnlineUsersCard(),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            self::class,
            Visitor7DaysChart::class,
        ];
    }

    private function createVisitorTodayCard()
    {
        $today = now()->format('Y-m-d');
        $todayCount = Visitor::where('date', $today)->value('count') ?? 0;
        $yesterdayCount = Visitor::where('date', now()->subDay()->format('Y-m-d'))->value('count') ?? 0;

        $percentageChange = $this->calculatePercentageChange($todayCount, $yesterdayCount);

        return Card::make('Tổng số người truy cập hôm nay', $todayCount)
            ->icon('heroicon-o-users')
            ->color('primary')
            ->description("So với hôm qua: {$percentageChange}")
            ->descriptionIcon($percentageChange > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
            ->chart([$yesterdayCount, $todayCount]);
    }

    private function createTotalVisitorCard()
    {
        $totalCount = Visitor::sum('count');
        $currentMonthCount = Visitor::whereMonth('date', now()->month)->sum('count');
        $previousMonthCount = Visitor::whereMonth('date', now()->subMonth()->month)->sum('count');

        $percentageChange = $this->calculatePercentageChange($currentMonthCount, $previousMonthCount);

        return Card::make('Tổng truy cập toàn thời gian', $totalCount)
            ->icon('heroicon-o-chart-bar')
            ->color('success')
            ->description("Tháng này: {$currentMonthCount} ({$percentageChange})")
            ->descriptionIcon($percentageChange > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
            ->chart([$previousMonthCount, $currentMonthCount]);
    }

    private function createOnlineUsersCard()
    {
        $onlineCount = OnlineUser::getOnlineCount();
        $previousCount = OnlineUser::where('last_activity', '>=', now()->subMinutes(10))->count();

        $percentageChange = $this->calculatePercentageChange($onlineCount, $previousCount);

        return Card::make('Tổng người online', $onlineCount)
            ->icon('heroicon-o-user-group')
            ->color('info')
            ->description("So với 10 phút trước: {$percentageChange}")
            ->descriptionIcon($percentageChange > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
            ->chart([$previousCount, $onlineCount]);
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? '100%' : '0%';
        }

        $change = (($current - $previous) / $previous) * 100;
        return round($change) . '%';
    }
}

class Visitor7DaysChart extends LineChartWidget
{
    protected static ?string $heading = 'Biểu đồ truy cập 7 ngày gần nhất';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('Y-m-d'));
        $labels = $days->map(fn($d) => date('d/m', strtotime($d)))->toArray();
        $data = $days->map(fn($d) => Visitor::where('date', $d)->value('count') ?? 0)->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Lượt truy cập',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
} 