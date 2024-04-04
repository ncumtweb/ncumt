<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/RecordComment.php

class RecordComment extends Model
{
    protected $fillable = ['content', 'user_id', 'record_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function replies()
    {
        return $this->hasMany(RecordCommentReply::class, 'record_comment_id');
    }
}

