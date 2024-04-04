<?php

namespace App\Http\Livewire;

use App\Models\RecordComment;
use App\Models\RecordCommentReply;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecordCommentReplies extends Component
{
    public $recordCommentId;
    public $recordCommentReplies = [];
    public $isToggleReplies = false;

    public $recordId;

    public $content;
    public $successMessage;

    public $replyCount;

    public function render()
    {
        return view('livewire/recordComment/record-comment-replies');
    }

    public function toggleReplies($recordCommentId)
    {
        $this->isToggleReplies = !$this->isToggleReplies;
        if ($this->isToggleReplies) {
            $this->recordCommentReplies = RecordCommentReply::where('record_comment_id', $recordCommentId)
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $this->recordCommentReplies = [];
        }
    }

    public function postReply()
    {
        $this->validate([
            'content' => 'required',
        ]);

        $recordComment = RecordComment::findOrFail($this->recordCommentId);

        // Save comment to database
        $newReply = RecordCommentReply::create([
            'content' => $this->content,
            'user_id' => Auth::id(),
            'record_comment_id' => $this->recordCommentId,
            'record_id' => $recordComment->record_id,
        ]);

        $this->recordCommentReplies->prepend($newReply);
        $this->recordCommentReplies = $this->recordCommentReplies->sortBy('created_at');

        // Clear input fields
        $this->reset(['content']);

        $this->successMessage = '成功發送回覆！';
    }
}
