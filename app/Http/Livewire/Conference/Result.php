<?php

namespace App\Http\Livewire\Conference;

use App\Models\ConferenceUser;
use Livewire\Component;
use Livewire\WithPagination;

class Result extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $conferenceUsers = ConferenceUser::orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.conference.result', [
            'conferenceUsers' => $conferenceUsers,
        ]);
    }
}
