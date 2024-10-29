<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Iar;
use App\Models\Item;

class PrintPreview extends Component
{
    public $iarId;
    public $data;
    public $items;

    public function mount($iarId)
    {
        $this->iarId = $iarId;
        $this->data = Iar::find($iarId);
        $this->items = Item::where('iar_id', '=', $iarId)->get();
    }

    public function render()
    {
        return view('livewire.print-preview');
    }
}
