<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Index extends Component
{
    public function delete(int $id): void
    {
        try {
            $bank = Bank::with(['clients', 'suppliers'])->findOrFail($id);

            if ($bank->clients->isNotEmpty() || $bank->suppliers->isNotEmpty()) {
                throw new \Exception(
                    __("This Bank has :clients client(s) and :suppliers supplier(s).", [
                        'clients'   => $bank->clients->count(),
                        'suppliers' => $bank->suppliers->count(),
                    ])
                );
            }

            $bank->delete();

            $this->dispatch('done', success: __("Bank deleted successfully."));
        } catch (\Throwable $e) {
            report($e);

            $this->dispatch('done', error: __("Something went wrong: :msg", [
                'msg' => $e->getMessage(),
            ]));
        }
    }

    public function render()
    {
        return view('livewire.admin.banks.index', [
            'banks' => Bank::withCount(['clients', 'suppliers'])->get(),
        ]);
    }
}
