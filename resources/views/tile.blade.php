<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <div>
        @foreach ($stocks as $stock)
        <div class="flex flex-row justify-between border-b border-white py-1 relative">
            <div class="flex flex-col w-2/3 items-center text-xs relative" style="-webkit-mask-image: linear-gradient(black, black calc(100% - 1rem), transparent)">
                <div class="p-1 w-full text-left">{{ $stock['symbol'] }}</div>
                <div style="font-size: 0.5rem;" class="flex pb-1 pt-6 pl-1 pr-1 items-center absolute inset-0 w-screen">{{ $stock['name'] }}</div>
            </div>
            <div class="flex flex-col w-1/3 ml-1 text-xs justify-end">
                <div class="p-1 text-right">{{ $stock['now'] }}</div>
                <div class="@if($stock['differenceAmount'] >= 0) bg-green-600 @else bg-red-600 @endif p-1 rounded text-right">{{ $stock['differencePercent'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</x-dashboard-tile>