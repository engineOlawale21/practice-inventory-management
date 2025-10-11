<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // optional if using bootstrap UI

    public function delete($id): void
    {
        try {
            $client = Client::withCount('sales')->findOrFail($id);

            if ($client->sales_count > 0) {
                throw new \Exception(
                    __("This client has purchased from you :count time(s).", ['count' => $client->sales_count])
                );
            }

            $client->delete();

            $this->dispatch('done', success: __("Client deleted successfully."));
        } catch (\Throwable $e) {
            report($e);
            $this->dispatch('done', error: __("Something went wrong: :msg", ['msg' => $e->getMessage()]));
        }
    }

    public function render()
    {
        return view('livewire.admin.clients.index', [
            'clients' => Client::latest('id')->paginate(10),
        ]);
    }
}
