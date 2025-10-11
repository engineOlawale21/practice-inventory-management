<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Bank;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public Client $client;

    protected function rules(): array
    {
        return [
            'client.name'                => ['required', 'string', 'max:255'],
            'client.email'               => [
                'required',
                'email',
                Rule::unique('clients', 'email')->ignore($this->client->id),
            ],
            'client.address'             => ['required', 'string'],
            'client.phone_number'        => ['required', 'string', 'max:20'],
            'client.registration_number' => ['nullable', 'string', 'max:50'],
            'client.tax_id'              => ['required', 'string', 'max:50'],
            'client.bank_id'             => ['required', 'exists:banks,id'],
            'client.account_number'      => ['required', 'string', 'max:50'],
        ];
    }

    public function mount($id): void
    {
        $this->client = Client::findOrFail($id);
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        try {
            $this->client->save();

            $this->dispatch('done', success: __('Client updated successfully.'));
            return redirect()->route('admin.clients.index');
        } catch (\Throwable $e) {
            report($e);
            $this->dispatch('done', error: __('Something went wrong: :msg', ['msg' => $e->getMessage()]));
        }
    }

    public function render()
    {
        return view('livewire.admin.clients.edit', [
            'banks' => Bank::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
