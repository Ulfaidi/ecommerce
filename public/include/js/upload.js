    function handleDragOver(event) {
        event.preventDefault();
        let dragArea = document.getElementById('dragArea');
        dragArea.classList.add('dragover');
    }

    function handleDrop(event) {
        event.preventDefault();
        let dragArea = document.getElementById('dragArea');
        dragArea.classList.remove('dragover');

        let fileInput = document.getElementById('fileInput');
        let files = event.dataTransfer.files;

        if (files.length > 0) {
            fileInput.files = files;
            showImages();
        }
    }

    function selectFile() {
        let fileInput = document.getElementById('fileInput');
        fileInput.click();
    }

    function handleFileSelect(event) {
        showImages();
    }

    function removeImage(index) {
        let fileInput = document.getElementById('fileInput');
        let imagePreview = document.getElementById('imagePreview');
        fileInput.value = ''; // Clear the file input
        fileInput.files = Array.from(fileInput.files).filter((_, i) => i !== index); // Remove the selected file from the files array
        showImages();
    }

    function showImages() {
        let fileInput = document.getElementById('fileInput');
        let imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';

        for (let i = 0; i < fileInput.files.length; i++) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let imageItem = document.createElement('div');
                imageItem.classList.add('image-item');

                let img = document.createElement('img');
                img.src = e.target.result;

                imageItem.appendChild(img);
                imagePreview.appendChild(imageItem);
            };
            reader.readAsDataURL(fileInput.files[i]);
        }
    }

// THUMBNAIL
        let thumbnailFiles = [];
        let thumbnailDragArea = document.getElementById('thumbnailDragArea');
        let thumbnailInput = document.getElementById('thumbnailInput');
        let thumbnailContainer = document.getElementById('thumbnailPreview');

        function selectThumbnailFile() {
            thumbnailInput.click();
        }

        function handleThumbnailFileSelect(event) {
            let file = event.target.files[0];

            if (file && file.type.startsWith('image/')) {
                thumbnailFiles = [file];
                showThumbnail();
            }
        }

        function showThumbnail() {
            let thumbnailInput = document.getElementById('thumbnailInput');
            let thumbnailContainer = document.getElementById('thumbnailPreview');
            thumbnailContainer.innerHTML = '';

            for (let i = 0; i < thumbnailFiles.length; i++) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let thumbnailItem = document.createElement('div');
                    thumbnailItem.classList.add('image-item');

                    let img = document.createElement('img');
                    img.src = e.target.result;

                    thumbnailItem.appendChild(img);
                    thumbnailContainer.appendChild(thumbnailItem);
                };
                reader.readAsDataURL(thumbnailFiles[i]);
            }
        }


        function delThumbnailImage(index) {
            thumbnailFiles.splice(index, 1);
            showThumbnail();
        }

        function handleDragOverThumb(event) {
            event.preventDefault();
            thumbnailDragArea.classList.add('dragover');
        }

        thumbnailDragArea.addEventListener('dragleave', () => {
            thumbnailDragArea.classList.remove('dragover');
        });

        function handleThumbnailDrop(event) {
            event.preventDefault();
            thumbnailDragArea.classList.remove('dragover');

            let file = event.dataTransfer.files[0];

            if (file && file.type.startsWith('image/')) {
                thumbnailFiles = [file];
                showThumbnail();
            }
        }
