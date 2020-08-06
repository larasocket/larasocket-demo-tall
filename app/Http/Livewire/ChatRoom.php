<?php

namespace App\Http\Livewire;

use App\Events\MessageSentEvent;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatRoom extends Component
{
    public $messages = [];
    public $here = [];

    protected $listeners = [
        'echo-presence:demo,here' => 'here',
        'echo-presence:demo,joining' => 'joining',
        'echo-presence:demo,leaving' => 'leaving',
    ];

    public function render()
    {
        return view('livewire.chat-room');
    }

    public function mount()
    {
        $this->messages = Message::
        with('user')
            ->latest()
            ->limit(30)
            ->get()
            ->reverse()
            ->values()
            ->toArray();
    }

    public function sendMessage($body)
    {
        if (! $body) {
            $this->addError('messageBody', 'Message body is required.');
            return;
        }

        $message = Auth::user()->messages()->create([
            'body' => $body,
        ]);

        $message->load('user');

        broadcast(new MessageSentEvent($message))->toOthers();

        array_push($this->messages, $message);
    }

    /**
     * @param $message
     */
    public function incomingMessage($message)
    {
        // get the hydrated model from incoming json/array.
        $message = Message::with('user')->find($message['id']);

        array_push($this->messages, $message);
    }

    /**
     * @param $data
     */
    public function here($data)
    {
        $this->here = $data;
    }

    /**
     * @param $data
     */
    public function leaving($data)
    {
        $here = collect($this->here);

        $firstIndex = $here->search(function ($authData) use ($data) {
            return $authData['id'] == $data['id'];
        });

        $here->splice($firstIndex, 1);

        $this->here = $here->toArray();
    }

    /**
     * @param $data
     */
    public function joining($data)
    {
        $this->here[] = $data;
    }
}
