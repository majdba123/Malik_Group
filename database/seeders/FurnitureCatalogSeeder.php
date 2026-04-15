<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FurnitureCatalogSeeder extends Seeder
{
    private const DEMO_PHONE = '+1 (555) 100-2000';

    /** Written from embedded base64 in EmbeddedShowcaseJpegData (same image as data:image/jpeg;base64,...). */
    private const SHOWCASE_EMBEDDED_JPEG = 'showcase/seeder-embedded-lifestyle.jpg';

    /** Optional files: copy from database/seeders/assets/showcase/ → storage/app/public/showcase/ */
    private const SHOWCASE_FILES = [
        'living-armchair-scene.png',
        'living-sofa-scene.png',
    ];

    public function run(): void
    {
        $categories = [
            [
                'name' => 'Living Room',
                'description' => 'Sofas, sectionals, coffee tables, and accent pieces for your main gathering space.',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&q=85&auto=format&fit=crop',
            ],
            [
                'name' => 'Bedroom',
                'description' => 'Beds, nightstands, dressers, and wardrobes for restful, organized bedrooms.',
                'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=1200&q=85&auto=format&fit=crop',
            ],
            [
                'name' => 'Dining',
                'description' => 'Dining tables, chairs, and sideboards for everyday meals and entertaining.',
                'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=1200&q=85&auto=format&fit=crop',
            ],
            [
                'name' => 'Home Office',
                'description' => 'Desks, ergonomic chairs, and storage to work comfortably from home.',
                'image' => 'https://images.unsplash.com/photo-1593062096033-9a26b09da705?w=1200&q=85&auto=format&fit=crop',
            ],
            [
                'name' => 'Storage & Shelving',
                'description' => 'Bookcases, cabinets, and modular storage to keep every room tidy.',
                'image' => 'https://images.unsplash.com/photo-1595428774223-41702d387c60?w=1200&q=85&auto=format&fit=crop',
            ],
        ];

        $categoryModels = [];
        foreach ($categories as $i => $row) {
            $slug = Str::slug($row['name']);
            $path = $this->storeRemoteOrPlaceholder($row['image'], "seed/categories/{$slug}.jpg");
            $categoryModels[] = Category::query()->updateOrCreate(
                ['name' => $row['name']],
                [
                    'description' => $row['description'],
                    'image_path' => $path,
                ]
            );
        }

        $living = $categoryModels[0];
        $bedroom = $categoryModels[1];
        $dining = $categoryModels[2];
        $office = $categoryModels[3];
        $storage = $categoryModels[4];

        $catalog = [
            [$living, [
                ['name' => 'Linen 3-Seater Sofa — Natural Oak Legs', 'price' => 1899.00, 'images' => [
                    'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1200&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Deep seats, removable linen covers, and solid oak legs. Ideal for open-plan living.'],
                ['name' => 'Round Marble Coffee Table — Brass Base', 'price' => 749.00, 'images' => [
                    'https://images.unsplash.com/photo-1532372320572-cda25653a26d?w=1200&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Carrara-style top with a brushed brass pedestal. Seats four comfortably around.'],
                ['name' => 'Walnut TV Console — 180 cm', 'price' => 920.00, 'images' => [
                    'https://images.unsplash.com/photo-1606744821553-874b6c9e7e98?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Cable management, soft-close doors, and adjustable shelves.'],
            ]],
            [$bedroom, [
                ['name' => 'Upholstered Queen Bed — Channel Tufting', 'price' => 1299.00, 'images' => [
                    'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1200&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1617325247661-675ab4e64f2c?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Low profile frame with padded headboard. Slats included; mattress sold separately.'],
                ['name' => 'Pair of Oak Nightstands — Soft Close', 'price' => 420.00, 'images' => [
                    'https://images.unsplash.com/photo-1618220170808-41391cb46b51?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Sold as a set of two. Hidden drawer runners and cable notch.'],
            ]],
            [$dining, [
                ['name' => 'Extendable Oak Dining Table — Seats 6–10', 'price' => 1599.00, 'images' => [
                    'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=1200&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1611269154421-4e27233ac68c?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Two extension leaves store inside. Solid oak top with trestle base.'],
                ['name' => 'Set of 4 Bouclé Dining Chairs', 'price' => 880.00, 'images' => [
                    'https://images.unsplash.com/photo-1503602642458-232111445657?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Curved back, steel legs, easy-clean fabric. Weight capacity 120 kg per chair.'],
            ]],
            [$office, [
                ['name' => 'Height-Adjustable Desk — 140×70 cm', 'price' => 695.00, 'images' => [
                    'https://images.unsplash.com/photo-1593062096033-9a26b09da705?w=1200&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Dual motor, memory presets, and cable tray. Top in matte white laminate.'],
                ['name' => 'Ergonomic Mesh Office Chair', 'price' => 449.00, 'images' => [
                    'https://images.unsplash.com/photo-1580480055273-228ff5388ef8?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Lumbar support, adjustable arms, and breathable mesh back.'],
            ]],
            [$storage, [
                ['name' => 'Tall Bookcase — 5 Shelves, Oak Veneer', 'price' => 529.00, 'images' => [
                    'https://images.unsplash.com/photo-1595428774223-41702d387c60?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Wall anchor included. Adjustable shelf heights every 32 mm.'],
                ['name' => 'Sideboard — Rattan Doors, 160 cm', 'price' => 1120.00, 'images' => [
                    'https://images.unsplash.com/photo-1600121848594-d8644e57abab?w=1200&q=85&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=1200&q=85&auto=format&fit=crop',
                ], 'description' => 'Three drawers, two cupboards, natural rattan fronts on a walnut frame.'],
            ]],
        ];

        foreach ($catalog as [$category, $items]) {
            foreach ($items as $item) {
                $product = Product::query()->firstOrCreate(
                    [
                        'category_id' => $category->id,
                        'name' => $item['name'],
                    ],
                    [
                        'description' => $item['description'],
                        'phone_number' => self::DEMO_PHONE,
                        'price' => $item['price'],
                        'status' => Product::STATUS_ACTIVE,
                    ]
                );

                if (! $product->wasRecentlyCreated) {
                    $product->update([
                        'description' => $item['description'],
                        'phone_number' => self::DEMO_PHONE,
                        'price' => $item['price'],
                        'status' => Product::STATUS_ACTIVE,
                    ]);
                }

                if ($product->images()->count() > 0) {
                    continue;
                }

                foreach ($item['images'] as $sort => $url) {
                    $rel = $this->storeRemoteOrPlaceholder($url, 'seed/products/'.$product->id.'-'.$sort.'.jpg');
                    if ($rel !== null) {
                        $product->images()->create(['path' => $rel, 'sort_order' => $sort]);
                    }
                }

                if ($product->images()->count() === 0) {
                    $rel = $this->storeRemoteOrPlaceholder('https://invalid.local/placeholder', 'seed/products/'.$product->id.'-fallback.png');
                    if ($rel !== null) {
                        $product->images()->create(['path' => $rel, 'sort_order' => 0]);
                    }
                }
            }
        }

        $this->publishShowcaseAssetsToPublicDisk();
        $this->attachShowcaseImagesToLivingRoomProducts();
    }

    private function publishShowcaseAssetsToPublicDisk(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('showcase');
        $raw = base64_decode(trim(EmbeddedShowcaseJpegData::BASE64), true);
        if ($raw !== false && $raw !== '' && str_starts_with($raw, "\xFF\xD8")) {
            $disk->put(self::SHOWCASE_EMBEDDED_JPEG, $raw);
        } else {
            $this->command?->warn('Embedded showcase JPEG (base64 in EmbeddedShowcaseJpegData) failed to decode; skipping file write.');
        }
        foreach (self::SHOWCASE_FILES as $file) {
            $src = database_path('seeders/assets/showcase/'.$file);
            if (! File::exists($src)) {
                $this->command?->warn("Optional showcase image missing in repo: {$file} (place under database/seeders/assets/showcase/).");

                continue;
            }
            File::copy($src, $disk->path('showcase/'.$file));
        }
    }

    private function attachShowcaseImagesToLivingRoomProducts(): void
    {
        $paths = [];
        if (Storage::disk('public')->exists(self::SHOWCASE_EMBEDDED_JPEG)) {
            $paths[] = self::SHOWCASE_EMBEDDED_JPEG;
        } else {
            $this->command?->warn('Embedded showcase JPEG not on disk; attach skipped for that file.');
        }
        foreach (self::SHOWCASE_FILES as $f) {
            $p = 'showcase/'.$f;
            if (Storage::disk('public')->exists($p)) {
                $paths[] = $p;
            }
        }
        if ($paths === []) {
            $this->command?->warn('No showcase image files on disk; nothing to attach.');

            return;
        }

        $living = Category::query()->where('name', 'Living Room')->first();
        $products = $living
            ? Product::query()->where('category_id', $living->id)->get()
            : Product::query()->get();

        foreach ($products as $product) {
            $sort = (int) $product->images()->max('sort_order');
            foreach ($paths as $path) {
                if ($product->images()->where('path', $path)->exists()) {
                    continue;
                }
                $sort++;
                $product->images()->create([
                    'path' => $path,
                    'sort_order' => $sort,
                ]);
            }
        }
    }

    private function storeRemoteOrPlaceholder(string $url, string $relativePath): ?string
    {
        try {
            $response = Http::timeout(25)
                ->withHeaders(['User-Agent' => 'MalikGroupDemoSeeder/1.0'])
                ->get($url);
            if ($response->successful() && strlen($response->body()) > 500) {
                Storage::disk('public')->put($relativePath, $response->body());

                return $relativePath;
            }
        } catch (\Throwable) {
            // fall through
        }

        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAHElEQVR42mNkYGD4z0AEYBxVSF+FwEtgYGBgAAA9GgADGu6wzAAAAABJRU5ErkJggg==', true);
        if ($png !== false) {
            $path = preg_replace('/\.jpe?g$/i', '.png', $relativePath) ?: $relativePath.'.png';
            Storage::disk('public')->put($path, $png);

            return $path;
        }

        return null;
    }
}
