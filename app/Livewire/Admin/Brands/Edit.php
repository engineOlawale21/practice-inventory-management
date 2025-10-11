<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Brand $brand;
    public $image;

    protected function rules(): array
    {
        return [
            'brand.name' => ['required', 'string', 'max:255'],
            'image'      => ['nullable', 'image', 'max:2048'], // 2MB max
        ];
    }

    public function mount(int $id): void
    {
        $this->brand = Brand::findOrFail($id);
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        try {
            if ($this->image) {
                $this->deleteOldLogo();
                $this->brand->logo_path = $this->storeImage();
            }

            $this->brand->save();

            session()->flash('success', __('Brand updated successfully.'));
            return redirect()->route('admin.brands.index');
        } catch (\Throwable $e) {
            report($e);

            throw ValidationException::withMessages([
                'brand.name' => __('Something went wrong: :msg', ['msg' => $e->getMessage()]),
            ]);
        }
    }

    /**
     * Store uploaded brand logo and return its path.
     */
    protected function storeImage(): string
    {
        $logoName = Str::slug($this->brand->name) . '-logo.' . $this->image->extension();
        $this->image->storeAs('brands/logos', $logoName, 'public');

        return "brands/logos/{$logoName}";
    }

    /**
     * Delete the old logo file if it exists.
     */
    protected function deleteOldLogo(): void
    {
        if ($this->brand->logo_path && Storage::disk('public')->exists($this->brand->logo_path)) {
            Storage::disk('public')->delete($this->brand->logo_path);
        }
    }

    public function render()
    {
        return view('livewire.admin.brands.edit');
    }
}
