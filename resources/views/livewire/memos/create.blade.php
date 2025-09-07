<?php

use App\Models\Memo;
use function Livewire\Volt\{state, rules, mount};

state(['title' => '', 'body' => '']);

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

$save = function () {
    $validated = $this->validate();

    $memo = Memo::create([
        'user_id' => auth()->id(),
        'title' => $validated['title'],
        'body' => $validated['body'],
    ]);

    $this->redirect(route('memos.show', $memo));
};

?>

<div class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            メモの作成
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            新しいメモを作成します。
        </p>
    </header>

    <form wire:submit="save" class="space-y-6">
        <div>
            <x-input-label for="title" value="タイトル" />
            <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full"
                required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="body" value="本文" />
            <x-textarea wire:model="body" id="body" name="body" class="mt-1 block w-full" rows="10"
                required />
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>保存</x-primary-button>
            <x-secondary-button type="button" onclick="window.location='{{ route('memos.index') }}'">
                キャンセル
            </x-secondary-button>
        </div>
    </form>
</div>
