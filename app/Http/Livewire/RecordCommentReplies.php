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

    public $content;

    public $editContent;

    public $successMessage;

    public $replyCount;

    public $selectedRecordCommentReplyId;

    public function render()
    {
        return view('livewire/recordComment/record-comment-replies');
    }

    public function toggleReplies($recordCommentId)
    {
        $this->successMessage = null;
        $this->isToggleReplies = !$this->isToggleReplies;
        if ($this->isToggleReplies) {
            $this->recordCommentReplies = RecordCommentReply::where('record_comment_id', $recordCommentId)
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $this->recordCommentReplies = [];
        }
    }

    public function createRecordCommentReply()
    {
        $this->validate([
            'content' => 'required|max:200',
        ], [
            'content.required' => '回覆內容不能為空。',
            'content.max' => '回覆內容不能超過 200 字。',
        ]);

        $recordComment = RecordComment::findOrFail($this->recordCommentId);

        // Save comment to database
        $newReply = RecordCommentReply::create([
            'content' => $this->content,
            'user_id' => Auth::id(),
            'record_comment_id' => $this->recordCommentId,
            'record_id' => $recordComment->record_id,
        ]);
        if (!empty($this->recordCommentReplies)) {
            $this->recordCommentReplies->prepend($newReply);
            $this->recordCommentReplies = $this->recordCommentReplies->sortBy('created_at');
        } else {
            $this->toggleReplies($this->recordCommentId);
        }
        // Clear input fields
        $this->reset(['content']);
        $this->replyCount = $this->replyCount + 1;
        $this->successMessage = '成功發送回覆！';
    }

    public function editRecordCommentReply($recordCommentReplyId)
    {
        $this->successMessage = null;
        $this->selectedRecordCommentReplyId = $recordCommentReplyId;
        $recordCommentReply = RecordCommentReply::findOrFail($recordCommentReplyId);
        $this->editContent = $recordCommentReply->content;
    }

    public function saveEditRecordCommentReply($recordCommentReplyId)
    {
        $this->validate([
            'editContent' => 'required|max:200',
        ], [
            'editContent.required' => '回覆內容不能為空。',
            'editContent.max' => '回覆內容不能超過 200 字。',
        ]);

        $recordCommentReply = RecordCommentReply::findOrFail($recordCommentReplyId);
        $recordCommentReply->content = $this->editContent;
        $recordCommentReply->update();
        $this->selectedRecordCommentReplyId = null;
        $this->recordCommentReplies = RecordCommentReply::where('record_comment_id',
            $recordCommentReply->record_comment_id)
            ->orderBy('created_at', 'asc')
            ->get();
        $this->replyCount = RecordComment::findOrFail($this->recordCommentId)->replies->count();
    }

    public function deleteRecordCommentReply($recordCommentReplyId)
    {
        $recordCommentReply = RecordCommentReply::findOrFail($recordCommentReplyId);
        $recordCommentReply->delete();

        $this->recordCommentReplies = $this->recordCommentReplies->except($recordCommentReplyId);
        $this->replyCount = RecordComment::findOrFail($this->recordCommentId)->replies->count();
        $this->successMessage = '成功刪除回覆！';
    }
}
