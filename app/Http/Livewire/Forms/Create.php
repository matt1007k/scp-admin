<?php

namespace App\Http\Livewire\Forms;

use App\Models\Form;
use App\Models\Volume;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public $volume;
    public $name;
    public $file;

    public $message;

    protected $listeners = ['volumeSelected', 'filePath'];

    public function volumeSelected(Volume $volume): void
    {
        $this->volume = $volume;
    }

    public function filePath(string $filePath): void
    {
        $this->file = $filePath;
        $this->message = 'Archivo subido con éxito';
    }

    public function handleSubmit()
    {
        $this->message = '';
        $this->validate([
            'volume' => 'required',
            'name' => 'required',
            'file' => 'required',
        ]);

        $form = Form::create([
            'volume_id' => $this->volume['id'],
            'name' => $this->name,
            'file' => $this->file
        ]);

        if ($form) {
            session()->flash('success', 'Registrado correctamente.');
            return redirect()->to('/admin/forms');
        }
    }

    public function deleteFile(): void
    {
        if (Storage::disk('public')->exists($this->file)) {
            Storage::disk('public')->delete($this->file);
            $this->file = null;
            $this->message = 'Archivo eliminado con éxito';
        } else {
            $this->message = 'Archivo no existe';
        }
    }

    public function render(): View
    {
        return view('livewire.forms.create');
    }
}
