<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;

trait SessionFlash
{
    // Remove: use LivewireAlert;

    public function successFlash($message, $title = "Well Done !"): void
    {
        if (method_exists($this, 'alert')) {
            $this->alert('success', $message, [
                'position' => 'centre',
                'title' => $title,
                'toast' => false,
                'timer' => 3000,
                'showConfirmButton' => true,
                'confirmButtonText' => 'ok',
            ]);
        } else {
            Session::flash('alert', ['type' => 'success', 'title' => $title, 'message' => $message]);
        }
    }

    public function errorFlash($message, $title = "Uh-oh!"): void
    {
        if (method_exists($this, 'alert')) {
            $this->alert('error', $message, [
                'position' => 'centre',
                'title' => $title,
                'toast' => false,
                'timer' => 3000,
                'showConfirmButton' => true,
                'confirmButtonText' => 'ok',
            ]);
        } else {
            Session::flash('alert', ['type' => 'danger', 'title' => $title, 'message' => $message]);
        }
    }

    // Other methods can follow same pattern...
}
