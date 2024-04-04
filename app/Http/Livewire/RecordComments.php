<?php

namespace App\Http\Livewire;

use App\Models\RecordComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecordComments extends Component
{
    public $content;

    public $editContent;

    public $recordId;

    public $successMessage;

    public $recordComments;

    public $selectedRecordCommentId;

    public function mount($recordId)
    {
        $this->newRecordCommentId = null;
        $this->recordComments = RecordComment::where('record_id', $recordId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire/recordComment/record-comments');
    }

    public function createRecordComment()
    {
        $this->validate([
            'content' => 'required|max:200',
        ], [
            'content.required' => '評論內容不能為空。',
            'content.max' => '評論內容不能超過 200 字。',
        ]);

        // 新增一筆評論並存入 record_comment
        $newRecordComment = RecordComment::create([
            'content' => $this->content,
            'user_id' => Auth::id(),
            'record_id' => $this->recordId,
        ]);

        $this->recordComments->prepend($newRecordComment);
        $this->recordComments = $this->recordComments->sortBy('created_at');

        $this->reset(['content']);
        $this->successMessage = '成功發送評論！';
    }

    public function editRecordComment($recordCommentId)
    {
        $this->successMessage = null;
        $this->selectedRecordCommentId = $recordCommentId;
        $recordComment = RecordComment::findOrFail($recordCommentId);
        $this->editContent = $recordComment->content;
    }

    public function saveEditRecordComment($recordCommentId)
    {
        $this->validate([
            'editContent' => 'required|max:200',
        ], [
            'editContent.required' => '評論內容不能為空。',
            'editContent.max' => '評論內容不能超過 200 字。',
        ]);

        $recordComment = RecordComment::findOrFail($recordCommentId);
        $recordComment->content = $this->editContent;
        $recordComment->update();
        $this->selectedRecordCommentId = null;
        $this->recordComments = RecordComment::where('record_id', $recordComment->record_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function deleteRecordComment($recordCommentId)
    {
        $comment = RecordComment::findOrFail($recordCommentId);
        $comment->delete();

        $this->recordComments = $this->recordComments->except($recordCommentId);
        $this->successMessage = '成功刪除評論！';
    }
}
