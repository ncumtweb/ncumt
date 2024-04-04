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
        $this->recordComments = RecordComment::where('record_id', $recordId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function postComment()
    {
        $this->validate([
            'content' => 'required|max:200',
        ], [
            'content.required' => '評論內容不能為空。',
            'content.max' => '評論內容不能超過 200 字。',
        ]);

        // 新增一筆評論並存入 record_comment
        $newComment = RecordComment::create([
            'content' => $this->content,
            'user_id' => Auth::id(),
            'record_id' => $this->recordId,
        ]);

        $this->recordComments->prepend($newComment);
        $this->recordComments = $this->recordComments->sortBy('created_at');


        $this->reset(['content']);
        $this->successMessage = '成功發送評論！';
    }

    public function render()
    {
        return view('livewire/recordComment/record-comments');
    }
}
