<?php

namespace App\Http\Livewire;

use App\Models\RecordCommentReply;
use Livewire\Component;

class RecordCommentReplies extends Component
{
    public $recordCommentId;
    public $recordCommentReplies = [];
    public $isToggleReplies = false;

    public $replyCount;

    public function render()
    {
        return view('livewire.record-comment-replies');
    }

    public function toggleReplies($recordCommentId)
    {
        $this->isToggleReplies = !$this->isToggleReplies;
        if ($this->isToggleReplies) {
            $this->recordCommentReplies = RecordCommentReply::where('record_comment_id', $recordCommentId)->get();
        } else {
            $this->recordCommentReplies = [];
        }
    }
}
