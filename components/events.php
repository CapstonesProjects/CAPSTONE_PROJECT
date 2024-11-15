<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Events - LOA OSA</title>
    <style>
        .form-container {
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            display: none;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .image-preview .image-container {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .image-preview .remove-image {
            position: absolute;
            bottom: 50px;
            right: 5px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #ff0000;
            font-weight: bold;
        }

        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s;
            flex: 1;
        }

        .upload-area:hover {
            border-color: #007bff;
        }

        .upload-area.dragover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }

        .upload-container {
            display: flex;
            gap: 20px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container mx-auto mt-10">
        <form action="../phpfiles/add_event.php" method="POST" enctype="multipart/form-data">
            <div class="form-container bg-white rounded-lg shadow-lg" style="width: 1575px; height: 840px;">
                <div class="form-group mb-10">
                    <label for="event-title" class="block text-gray-700 font-bold mb-2">Event Title</label>
                    <input type="text" id="event-title" name="event-title" placeholder="Enter event title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-10">
                    <label for="event-date" class="block text-gray-700 font-bold mb-2">Event Date</label>
                    <input type="date" id="event-date" name="event-date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="form-group mb-10">
                    <label for="event-description" class="block text-gray-700 font-bold mb-2">Event Description</label>
                    <textarea id="event-description" name="event-description" placeholder="Enter event description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div class="form-group mb-10">
                    <label for="event-image" class="block text-gray-700 font-bold mb-2">Event Images</label>
                    <div class="upload-container">
                        <div id="upload-area" class="upload-area">
                            <i class='bx bx-upload text-6xl text-gray-400'></i>
                            <p class="text-gray-600">Drag & drop images here or click to upload</p>
                            <input type="file" id="event-image" name="event-image[]" multiple required>
                        </div>
                        <div id="image-preview" class="image-preview"></div>
                    </div>
                </div>
                <div class="form-group mb-10">
                    <label for="event-location" class="block text-gray-700 font-bold mb-2">Event Location</label>
                    <input type="text" id="event-location" name="event-location" placeholder="Enter event location" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-10">
                    <label for="event-category" class="block text-gray-700 font-bold mb-2">Event Category</label>
                    <select id="event-category" name="event-category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select category</option>
                        <option value="conference">Conference</option>
                        <option value="workshop">Workshop</option>
                        <option value="seminar">Seminar</option>
                        <option value="meetup">Meetup</option>
                    </select>
                </div>
                <div class="form-group flex justify-center items-center">
                    <button type="submit" class="w-2/4 mt-10 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Add Event</button>
                </div>
            </div>
        </form>
        <!-- <h2 class="text-4xl font-semibold text-center mb-8">Add New Event</h2> -->

    </div>

    <script>
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('event-image');
        const imagePreview = document.getElementById('image-preview');

        uploadArea.addEventListener('click', () => fileInput.click());

        uploadArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = event.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', (event) => {
            const files = event.target.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.classList.add('image-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const removeButton = document.createElement('button');
                    removeButton.classList.add('remove-image');
                    removeButton.innerHTML = '&times;';
                    removeButton.addEventListener('click', () => {
                        imgContainer.remove();
                    });

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeButton);
                    imagePreview.appendChild(imgContainer);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>