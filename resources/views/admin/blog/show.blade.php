@extends('layouts.admin')

@section('style')
    <style>
        .blog-show-shell { max-width: 1100px; margin: 0 auto; }
        .blog-show-card, .blog-show-panel { background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%); border: 1px solid #d9e4ff; border-radius: 16px; box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08); }
        .blog-show-card { padding: 28px; margin-bottom: 20px; }
        .blog-show-kicker { font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #d62034; margin-bottom: 8px; }
        .blog-show-title { margin: 0; font-size: 32px; font-weight: 700; color: #0b1f4d; }
        .blog-show-copy { margin-top: 8px; color: #47639d; }
        .blog-show-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 22px; }
        .blog-show-btn-primary, .blog-show-btn-secondary { min-height: 46px; padding: 0 18px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none !important; }
        .blog-show-btn-primary { background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%); color: #ffffff; }
        .blog-show-btn-secondary { background: #fff5f5; border: 1px solid #f3b3ba; color: #c81e33; }
        .blog-show-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
        .blog-show-panel { padding: 22px; }
        .blog-show-label { display: block; font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #6c86bb; margin-bottom: 7px; }
        .blog-show-value { color: #0f172a; font-size: 16px; line-height: 1.7; }
        @media (max-width: 768px) { .blog-show-grid { grid-template-columns: 1fr; } }
    </style>
@endsection

@section('content')
    <div class="blog-show-shell">
        <div class="blog-show-card">
            <div class="blog-show-kicker">Blog</div>
            <h1 class="blog-show-title">{{ $post->title }}</h1>
            <p class="blog-show-copy">{{ $post->is_published ? 'Published' : 'Draft' }} · {{ optional($post->published_at ?: $post->created_at)->format('M d, Y h:i A') }}</p>

            <div class="blog-show-actions">
                <a href="{{ route('admin.blog.index') }}" class="blog-show-btn-primary">Back to Blog</a>
                <a href="{{ route('admin.blog.edit', $post) }}" class="blog-show-btn-primary">Edit Post</a>
                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this blog post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="blog-show-btn-secondary">Delete Post</button>
                </form>
            </div>
        </div>

        <div class="blog-show-grid">
            <div class="blog-show-panel">
                <span class="blog-show-label">Slug</span>
                <div class="blog-show-value">{{ $post->slug }}</div>
            </div>
            <div class="blog-show-panel">
                <span class="blog-show-label">Author</span>
                <div class="blog-show-value">{{ $post->author_name }}</div>
            </div>
            <div class="blog-show-panel">
                <span class="blog-show-label">Excerpt</span>
                <div class="blog-show-value">{{ $post->excerpt ?: 'No excerpt provided.' }}</div>
            </div>
            <div class="blog-show-panel">
                <span class="blog-show-label">SEO Description</span>
                <div class="blog-show-value">{{ $post->seo_description ?: 'No SEO description provided.' }}</div>
            </div>
            <div class="blog-show-panel" style="grid-column: 1 / -1;">
                <span class="blog-show-label">Content</span>
                <div class="blog-show-value">{!! $post->content !!}</div>
            </div>
        </div>
    </div>
@endsection
