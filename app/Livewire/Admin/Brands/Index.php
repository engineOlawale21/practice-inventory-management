<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;

class Index extends Component
{
    public function delete(int $id): void
    {
        try {
            $brand = Brand::withCount('products')->findOrFail($id);

            if ($brand->products_count > 0) {
                throw new \Exception(
                    "This brand has {$brand->products_count} product(s) and cannot be deleted."
                );
            }

            $brand->delete();

            $this->dispatch('done', success: __('Brand deleted successfully.'));
        } catch (\Throwable $e) {
            report($e);
            $this->dispatch('done', error: __('Something went wrong: :msg', ['msg' => $e->getMessage()]));
        }
    }

    public function render()
    {
        return view('livewire.admin.brands.index', [
            'brands' => Brand::withCount('products')->latest()->get(),
        ]);
    }
}
