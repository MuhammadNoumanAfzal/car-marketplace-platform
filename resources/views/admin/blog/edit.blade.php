@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/css/summernote-bs4.css') }}">
    <style>
        .blog-form-shell { max-width: 1180px; margin: 0 auto; }
        .blog-form-panel { border: 1px solid #d8e2ff; border-radius: 14px; background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%); box-shadow: 0 16px 34px rgba(21, 59, 138, 0.08); }
        .blog-form-panel__header { padding: 24px 28px 10px; border-bottom: 1px solid #dbe7ff; }
        .blog-form-panel__body { padding: 28px; }
        .blog-form-kicker { font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #d62034; margin-bottom: 8px; }
        .blog-form-title { margin: 0; font-size: 28px; font-weight: 700; color: #0b1f4d; }
        .blog-form-copy { margin: 8px 0 0; color: #47639d; }
        .blog-form-panel .form-control { min-height: 46px; border-radius: 10px; border-color: #c8d8ff; background: #ffffff; color: #0b1f4d; box-shadow: none; }
        .blog-form-panel textarea.form-control { min-height: 140px; }
        .blog-form-panel .btn-primary { border: 0; border-radius: 10px; background: linear-gradient(90deg, #153b8a 0%, #2563eb 100%); padding: 0.8rem 2.5rem; }
        .blog-form-panel .note-editor.note-frame { border: 1px solid #c8d8ff; border-radius: 10px; overflow: hidden; }
        .blog-form-panel .note-toolbar { background: #eff6ff; border-bottom: 1px solid #d9e4ff; }
        .blog-form-panel .note-editing-area,
        .blog-form-panel .note-editable { background: #ffffff; color: #0b1f4d; }
    </style>
@endsection

@section('content')
    <div class="blog-form-shell">
        <div class="blog-form-panel">
            <div class="blog-form-panel__header">
                <div class="blog-form-kicker">Blog</div>
                <h1 class="blog-form-title">Edit article</h1>
                <p class="blog-form-copy">Update the article content, publishing state, or image.</p>
            </div>
            <div class="blog-form-panel__body">
                <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.blog._form')
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Update Blog Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/summernote/js/summernote-bs4.js') }}"></script>
    <script>
        $(function () {
            $('.js-blog-editor').summernote({
                height: 320,
                placeholder: 'Write the article content here',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>
@endsection
