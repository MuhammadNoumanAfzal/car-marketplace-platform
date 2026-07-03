<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));
        $status = $request->query('status');

        $inventories = Inventory::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('make', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhere('trim', 'like', "%{$search}%")
                        ->orWhere('stock', 'like', "%{$search}%")
                        ->orWhere('vin', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['available', 'sold'], true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.inventory.index', [
            'heading' => 'Inventory',
            'title' => 'Manage Inventory',
            'active' => 'inventory',
            'inventories' => $inventories,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function create(): View
    {
        return view('admin.inventory.create', [
            'heading' => 'Inventory',
            'title' => 'Add Inventory',
            'active' => 'inventory',
            'inventory' => new Inventory([
                'status' => 'available',
                'is_featured' => true,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Inventory::create($this->validatedPayload($request));

        return redirect()
            ->route('admin.inventory.index')
            ->with('status', 'Inventory item created successfully.');
    }

    public function edit(Inventory $inventory): View
    {
        return view('admin.inventory.edit', [
            'heading' => 'Inventory',
            'title' => 'Edit Inventory',
            'active' => 'inventory',
            'inventory' => $inventory,
        ]);
    }

    public function show(Inventory $inventory): View
    {
        return view('admin.inventory.show', [
            'heading' => 'Inventory',
            'title' => 'Inventory Details',
            'active' => 'inventory',
            'inventory' => $inventory,
        ]);
    }

    public function update(Request $request, Inventory $inventory): RedirectResponse
    {
        $inventory->update($this->validatedPayload($request, $inventory->id));

        return redirect()
            ->route('admin.inventory.index')
            ->with('status', 'Inventory item updated successfully.');
    }

    public function destroy(Inventory $inventory): RedirectResponse
    {
        $this->deleteStoredImages($inventory);
        $inventory->delete();

        return redirect()
            ->route('admin.inventory.index')
            ->with('status', 'Inventory item deleted successfully.');
    }

    private function validatedPayload(Request $request, ?int $inventoryId = null): array
    {
        $validated = $request->validate([
            'status' => ['required', 'in:available,sold'],
            'is_featured' => ['nullable', 'boolean'],
            'year' => ['required', 'integer', 'between:1990,2100'],
            'make' => ['required', 'string', 'max:80'],
            'model' => ['required', 'string', 'max:120'],
            'trim' => ['nullable', 'string', 'max:120'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'doc_fee' => ['nullable', 'numeric', 'min:0'],
            'filing_fee' => ['nullable', 'numeric', 'min:0'],
            'tag_fee' => ['nullable', 'numeric', 'min:0'],
            'mileage' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'string', 'max:80', 'unique:inventories,stock,' . $inventoryId],
            'vin' => ['nullable', 'string', 'max:80'],
            'engine' => ['nullable', 'string', 'max:120'],
            'transmission' => ['nullable', 'string', 'max:120'],
            'drivetrain' => ['nullable', 'string', 'max:80'],
            'exterior' => ['nullable', 'string', 'max:80'],
            'interior' => ['nullable', 'string', 'max:80'],
            'fuel' => ['nullable', 'string', 'max:50'],
            'main_image' => ['nullable', 'string', 'max:2048'],
            'main_image_file' => ['nullable', 'image', 'max:5120'],
            'description' => ['nullable', 'string'],
            'gallery_input' => ['nullable', 'string'],
            'gallery_files' => ['nullable', 'array'],
            'gallery_files.*' => ['image', 'max:5120'],
            'features' => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['gallery'] = $this->uploadedGallery($request, $inventoryId);
        $validated['features'] = collect($request->input('features', []))
            ->map(fn ($feature) => trim((string) $feature))
            ->filter()
            ->values()
            ->all();
        $validated['doc_fee'] = $validated['doc_fee'] ?? 0;
        $validated['filing_fee'] = $validated['filing_fee'] ?? 0;
        $validated['tag_fee'] = $validated['tag_fee'] ?? 0;
        $validated['main_image'] = $this->resolveMainImage($request, $inventoryId);

        unset(
            $validated['gallery_input'],
            $validated['main_image_file'],
            $validated['gallery_files']
        );

        return $validated;
    }

    private function resolveMainImage(Request $request, ?int $inventoryId): ?string
    {
        $inventory = $inventoryId ? Inventory::find($inventoryId) : null;

        if ($request->hasFile('main_image_file')) {
            $this->deleteImagePath($inventory?->main_image);

            return $request->file('main_image_file')->store('inventories/main', 'public');
        }

        $manualValue = trim((string) $request->input('main_image'));

        if ($manualValue !== '') {
            return $manualValue;
        }

        return $inventory?->main_image;
    }

    private function uploadedGallery(Request $request, ?int $inventoryId): array
    {
        $inventory = $inventoryId ? Inventory::find($inventoryId) : null;
        $manualGallery = $this->linesToArray($request->input('gallery_input'));

        if (! $request->hasFile('gallery_files')) {
            return ! empty($manualGallery) ? $manualGallery : ($inventory?->gallery ?? []);
        }

        $this->deleteImageSet($inventory?->gallery ?? []);

        $storedGallery = collect($request->file('gallery_files'))
            ->filter()
            ->map(fn ($file) => $file->store('inventories/gallery', 'public'))
            ->values()
            ->all();

        return ! empty($storedGallery) ? $storedGallery : $manualGallery;
    }

    private function linesToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function deleteStoredImages(Inventory $inventory): void
    {
        $this->deleteImagePath($inventory->main_image);
        $this->deleteImageSet($inventory->gallery ?? []);
    }

    private function deleteImageSet(array $paths): void
    {
        foreach ($paths as $path) {
            $this->deleteImagePath($path);
        }
    }

    private function deleteImagePath(?string $path): void
    {
        $path = trim((string) $path);

        if ($path === '' || preg_match('/^https?:\/\//i', $path)) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
