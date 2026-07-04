<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));
        $status = $request->query('status');

        $posts = BlogPost::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('author_name', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['published', 'draft'], true), function ($query) use ($status) {
                $query->where('is_published', $status === 'published');
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.blog.index', [
            'heading' => 'Blog',
            'title' => 'Manage Blog',
            'active' => 'blog',
            'posts' => $posts,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.create', [
            'heading' => 'Blog',
            'title' => 'Create Blog Post',
            'active' => 'blog',
            'post' => new BlogPost([
                'author_name' => 'Nitro Motors USA',
                'is_published' => true,
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        BlogPost::create($this->validatedPayload($request));

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Blog post created successfully.');
    }

    public function show(BlogPost $blogPost): View
    {
        return view('admin.blog.show', [
            'heading' => 'Blog',
            'title' => 'Blog Post Details',
            'active' => 'blog',
            'post' => $blogPost,
        ]);
    }

    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog.edit', [
            'heading' => 'Blog',
            'title' => 'Edit Blog Post',
            'active' => 'blog',
            'post' => $blogPost,
        ]);
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $blogPost->update($this->validatedPayload($request, $blogPost));

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $this->deleteImagePath($blogPost->featured_image);
        $blogPost->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Blog post deleted successfully.');
    }

    private function validatedPayload(Request $request, ?BlogPost $blogPost = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:blog_posts,slug,' . ($blogPost?->id ?? 'NULL')],
            'excerpt' => ['nullable', 'string', 'max:320'],
            'content' => ['required', 'string'],
            'author_name' => ['required', 'string', 'max:120'],
            'featured_image' => ['nullable', 'string', 'max:2048'],
            'featured_image_file' => ['nullable', 'image', 'max:5120'],
            'seo_description' => ['nullable', 'string', 'max:320'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['slug'] = Str::slug(trim((string) ($validated['slug'] ?: $validated['title'])));
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at'] ?? ($validated['is_published'] ? now() : null);
        $validated['featured_image'] = $this->resolveFeaturedImage($request, $blogPost);

        unset($validated['featured_image_file']);

        return $validated;
    }

    private function resolveFeaturedImage(Request $request, ?BlogPost $blogPost): ?string
    {
        if ($request->hasFile('featured_image_file')) {
            $this->deleteImagePath($blogPost?->featured_image);

            return $request->file('featured_image_file')->store('blog', 'public');
        }

        $manualValue = trim((string) $request->input('featured_image'));

        if ($manualValue !== '') {
            return $manualValue;
        }

        return $blogPost?->featured_image;
    }

    private function deleteImagePath(?string $path): void
    {
        $path = trim((string) $path);

        if ($path === '' || preg_match('/^https?:\/\//i', $path)) {
            return;
        }

        if (str_starts_with($path, 'storage/')) {
            $path = ltrim(Str::after($path, 'storage/'), '/');
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
