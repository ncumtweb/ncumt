<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordCommentReply extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'record_comment_id', 'record_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(RecordComment::class, 'record_comment_id');
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
