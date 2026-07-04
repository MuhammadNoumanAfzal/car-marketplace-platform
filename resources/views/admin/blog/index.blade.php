@extends('layouts.admin')

@section('style')
    <style>
        .blog-admin-shell {
            max-width: 1240px;
            margin: 0 auto;
        }

        .blog-admin-toolbar,
        .blog-admin-table {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #d9e4ff;
            border-radius: 14px;
            box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08);
        }

        .blog-admin-toolbar {
            padding: 24px 28px;
            margin-bottom: 20px;
        }

        .blog-admin-heading {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 20px;
        }

        .blog-admin-heading h1 {
            margin: 0;
            font-size: 28px;
            color: #0b1f4d;
        }

        .blog-admin-heading p {
            margin: 6px 0 0;
            color: #47639d;
        }

        .blog-admin-toolbar .form-control {
            min-height: 46px;
            border-radius: 10px;
            border: 1px solid #c8d8ff;
            background: #ffffff;
            color: #0b1f4d;
            box-shadow: none;
        }

        .blog-admin-btn-dark,
        .blog-admin-btn-light {
            min-height: 46px;
            border-radius: 10px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .blog-admin-btn-dark {
            background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%);
            border: 0;
            color: #fff;
        }

        .blog-admin-btn-light {
            background: #fff5f5;
            border: 1px solid #f3b3ba;
            color: #c81e33;
        }

        .blog-admin-table {
            overflow: hidden;
        }

        .blog-admin-table table {
            margin-bottom: 0;
            background: #fff;
        }

        .blog-admin-table thead th {
            background: #eef4ff;
            border-bottom: 1px solid #d9e4ff;
            color: #31519b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .blog-admin-table tbody td {
            background: #ffffff !important;
            color: #0f172a;
            border-top: 1px solid #e5ecff;
            vertical-align: top;
        }

        .blog-post-title {
            font-weight: 700;
            color: #0b1f4d;
        }

        .blog-post-meta {
            font-size: 12px;
            color: #47639d;
            margin-top: 4px;
        }

        .blog-status {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .blog-status--published {
            background: #e7f0ff;
            color: #1d4ed8;
        }

        .blog-status--draft {
            background: #fff5f5;
            color: #c81e33;
        }
    </style>
@endsection

@section('content')
    <div class="blog-admin-shell">
        <div class="blog-admin-toolbar">
            <div class="blog-admin-heading">
                <div>
                    <h1>Blog Posts</h1>
                    <p>Create, publish, and manage public-facing articles.</p>
                </div>
                <a href="{{ route('admin.blog.create') }}" class="blog-admin-btn-dark">Add Blog Post</a>
            </div>

            <form method="GET" action="{{ route('admin.blog.index') }}">
                <div class="form-row">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Search by title, slug, author, or excerpt">
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status" class="form-control">
                            <option value="">All statuses</option>
                            <option value="published" @selected($status === 'published')>Published</option>
                            <option value="draft" @selected($status === 'draft')>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex">
                        <button type="submit" class="btn blog-admin-btn-dark btn-block mr-2">Filter</button>
                        <a href="{{ route('admin.blog.index') }}" class="btn blog-admin-btn-light">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="blog-admin-table">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Post</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>
                                    <div class="blog-post-title">{{ $post->title }}</div>
                                    <div class="blog-post-meta">{{ $post->slug }}</div>
                                </td>
                                <td>
                                    <span class="blog-status {{ $post->is_published ? 'blog-status--published' : 'blog-status--draft' }}">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>{{ $post->author_name }}</td>
                                <td>{{ optional($post->published_at ?: $post->created_at)->format('M d, Y') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.blog.show', $post) }}" class="btn btn-outline-primary btn-sm">View</a>
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No blog posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
