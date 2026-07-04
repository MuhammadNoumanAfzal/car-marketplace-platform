<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label class="col-form-label" for="title">Title</label>
            <input id="title" type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" placeholder="Article title">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group pt-md-4 mt-md-2">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" value="1" @checked(old('is_published', $post->is_published))>
                <label class="custom-control-label" for="is_published">Published</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label" for="slug">Slug</label>
            <input id="slug" type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}" placeholder="leave blank to auto-generate">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label" for="author_name">Author Name</label>
            <input id="author_name" type="text" name="author_name" class="form-control" value="{{ old('author_name', $post->author_name) }}" placeholder="Author">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label" for="published_at">Publish Date</label>
            <input id="published_at" type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\\TH:i')) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label" for="seo_description">SEO Description</label>
            <input id="seo_description" type="text" name="seo_description" class="form-control" value="{{ old('seo_description', $post->seo_description) }}" placeholder="Optional SEO description">
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-form-label" for="excerpt">Excerpt</label>
    <textarea id="excerpt" name="excerpt" class="form-control" rows="3" placeholder="Short summary for the blog card">{{ old('excerpt', $post->excerpt) }}</textarea>
</div>

<div class="form-group">
    <label class="col-form-label" for="content">Content</label>
    <textarea id="content" name="content" class="form-control js-blog-editor" rows="10" placeholder="Write the article content here">{{ old('content', $post->content) }}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label" for="featured_image_file">Featured Image From Computer</label>
            <input id="featured_image_file" type="file" name="featured_image_file" class="form-control" accept="image/*">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label" for="featured_image">Or Featured Image URL</label>
            <input id="featured_image" type="text" name="featured_image" class="form-control" value="{{ old('featured_image', $post->featured_image) }}" placeholder="https://...">
        </div>
    </div>
</div>

@if (old('featured_image', $post->featured_image))
    <div class="mb-4">
        <p class="mb-2 font-weight-semibold">Current Featured Image</p>
        <img src="{{ preg_match('/^https?:\/\//i', old('featured_image', $post->featured_image)) ? old('featured_image', $post->featured_image) : asset('storage/' . ltrim(str_replace('storage/', '', old('featured_image', $post->featured_image)), '/')) }}" alt="Featured image" style="max-width: 280px; border-radius: 12px; border: 1px solid #d9e4ff;">
    </div>
@endif
