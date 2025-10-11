<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Edit extends Component
{
    public Bank $bank;

    protected function rules(): array
    {
        return [
            'bank.name'       => ['required', 'string', 'max:255'],
            'bank.short_name' => ['required', 'string', 'max:50'],
            'bank.sort_code'  => ['required', 'string', 'max:20'],
        ];
    }

    public function mount(int $id): void
    {
        $this->bank = Bank::findOrFail($id);
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        try {
            $this->bank->save();

            session()->flash('success', __('Bank updated successfully.'));
            return redirect()->route('admin.banks.index');
        } catch (\Throwable $e) {
            report($e);

            throw ValidationException::withMessages([
                'bank.name' => __('Something went wrong: :msg', ['msg' => $e->getMessage()]),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.banks.edit');
    }
}
