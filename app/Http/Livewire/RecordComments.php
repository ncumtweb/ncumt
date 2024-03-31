<?php

namespace App\Http\Livewire;

use App\Models\RecordComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecordComments extends Component
{
    public $content;
    public $recordId;

    public $successMessage;

    public $recordComments;

    public function mount($recordId)
    {
        $this->recordComments = RecordComment::where('record_id', $recordId)->get();
    }

    public function postComment()
    {
        $this->validate([
            'content' => 'required',
        ]);
        // Save comment to database
        $newComment = RecordComment::create([
            'content' => $this->content,
            'user_id' => Auth::id(),
            'record_id' => $this->recordId,
        ]);

        $this->recordComments->prepend($newComment);
        // Clear input fields
        $this->reset(['content']);

        $this->successMessage = '成功發送評論！';
    }

    public function render()
    {
        return view('livewire.record-comments');
    }
}
