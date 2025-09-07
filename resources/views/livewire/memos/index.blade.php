<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

state([
    'memos' => fn() => Memo::where('user_id', auth()->id())
        ->latest()
        ->get(),
]);

?>

<div>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-900">メモ一覧</h2>
            <x-primary-button tag="a" href="{{ route('memos.create') }}" wire:navigate>
                新規作成
            </x-primary-button>
        </div>
        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                @foreach ($memos as $memo)
                    <a href="{{ route('memos.show', $memo) }}"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $memo->title }}
                            </h2>
                            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($memo->created_at)->format('Y年m月d日') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
