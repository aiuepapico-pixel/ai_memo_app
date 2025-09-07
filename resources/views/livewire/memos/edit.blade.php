<?php

use function Livewire\Volt\{state, rules, mount};
use App\Models\Memo;

state([
    'memo' => null,
    'title' => '',
    'body' => '',
]);

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

mount(function (Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->body = $memo->body;
});

$update = function () {
    $validated = $this->validate();

    $this->memo->update([
        'title' => $validated['title'],
        'body' => $validated['body'],
    ]);

    session()->flash('status', 'メモを更新しました。');

    $this->redirect(route('memos.show', ['memo' => $this->memo]), navigate: true);
};

?>

<div>
    <form wire:submit="update" class="space-y-6">
        <div>
            <x-input-label for="title" value="タイトル" />
            <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="body" value="本文" />
            <x-textarea wire:model="body" id="body" name="body" class="mt-1 block w-full" rows="10"
                required />
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>更新</x-primary-button>
            <x-secondary-button tag="a" href="{{ route('memos.show', ['memo' => $memo]) }}" wire:navigate>
                キャンセル
            </x-secondary-button>
        </div>
    </form>
</div>
