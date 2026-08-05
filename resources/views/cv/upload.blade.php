<h2>Upload CV (PDF)</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="/upload-cv" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="cv" required>
    <button type="submit">Upload</button>
</form>