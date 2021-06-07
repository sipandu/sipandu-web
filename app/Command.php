<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected $table = 'tb_command';

    public function getAnswerCommand()
    {
        $command = Command::where('parent_id', $this->id)->first();

        return $command->command ?? '-';
    }

    public function getParent()
    {
        $command = Command::find($this->parent_id);

        return $command->command ?? '-';
    }

    public function hasNotChild()
    {
        $answer = Command::where('parent_id', $this->id)->first();
        $child = Command::where('parent_id', $answer->id)->first();

        if(isset($child)) {
            return false;
        } else {
            return true;
        }
    }

    public function getChildId()
    {
        $answer = Command::where('parent_id', $this->id)->first();

        return $answer->id ?? 0;
    }

    public function getMenuChild()
    {
        $child = Command::where('parent_id', $this->id)->get();

        return $child;
    }

    public function cekJenis()
    {
        if ($this->is_numeric == '1') {
            return 'Hanya Angka';
        } else {
            return 'Text';
        }
    }
}
