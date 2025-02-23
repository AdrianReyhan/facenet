<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Recognition dengan Laravel & Face API.js</title>
</head>

<body>
    <h1>Testing Reyhan</h1>
    <div class="mb-3"
        style="align-items: center; margin-right: auto; margin-left: auto; display: flex; justify-content: center;">
        <video id="video" class="w-full md:w-1/2 lg:w-1/4" height="auto"
            style="transform: scaleX(-1); border-radius: 18px;" autoplay></video>
    </div>
    <button id="saveFace">Simpan Wajah</button>
    <button id="matchFace">Cocokkan Wajah</button>
    <script defer src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js"></script>
    <script defer src="script.js"></script>
</body>

</html>
