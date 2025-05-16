<div class="flex items-center" x-data="picturePreview()">
    <div class="rounded-md bg-gray-200 mr-2">
        <img id="preview" src="" alt="" class="w-24 h-24 rounded-md object-cover">
    </div>
    <div>
        <button type="button" @click="document.getElementById('picture').click()"
            class="relative px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                </svg>
                Carregar imagem
            </div>
            <input @change="showPreview(event)" type="file" name="picture" id="picture"
                class="absolute inset-0 w-full h-full opacity-0 -z-10">
        </button>
    </div>
    <script>
        function picturePreview() {
            return {
                showPreview: (event) => {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        document.getElementById('preview').src = src;
                    }
                }
            }
        }
    </script>
</div>