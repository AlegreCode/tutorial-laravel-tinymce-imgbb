<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="./tinymce/tinymce.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen">
    <main class="w-[960px] m-auto">
        <h1 class="text-3xl text-center text-stone-300 py-4">Integración Laravel, TinyMCE e ImgBB</h1>
        <form action="{{ route('save-post') }}" method="post">
            @csrf
            <textarea name="body" id="textarea" cols="30" rows="10"></textarea>
            <input type="submit" value="Enviar" class="bg-sky-900 hover:bg-sky-500 hover:cursor-pointer p-2 mt-2 text-stone-300 rounded block ml-auto">
        </form>
        @for ($i = 0; $i < 3; $i++)
            <x-post/>
        @endfor
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: 'textarea#textarea', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists image',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
                images_upload_handler: (blobInfo) => new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    axios({
                        method: 'POST',
                        url: '/image-upload',
                        data: formData,
                    })
                    .then((r) => {
                        resolve(r.data.location);
                    })
                    .catch((e) => {
                        reject(`Error: ${e.message}`);
                    });
                })
            });
        }, false);
    </script>
</body>
</html>