<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Recognition</title>

    <style>
        .mb-3 {
            margin-bottom: 12px;
        }

        .mt-3 {
            margin-top: 12px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        video {
            transform: scaleX(-1);
            border-radius: 18px;
            /* border: 1px solid #333; */
        }

        button {
            margin: 10px;
            padding: 10px 15px;
            justify-content: center;
            align-items: center;
            text-align: center;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            /* Jarak antar tombol */
            margin-top: 12px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1 style="align-items: center; display: flex; justify-content: center;">Testing </h1>
    <div>
        <div class="mb-3"
            style="align-items: center; margin-right: auto; margin-left: auto; display: flex; justify-content: center;">
            <video id="video" class="w-full md:w-1/2 lg:w-1/4" height="auto"
                style="transform: scaleX(-1); border-radius: 18px;" autoplay></video>
        </div>
        <div class="button-container">
            <button id="saveFace">Simpan Wajah</button>
            <button id="matchFace">Cocokkan Wajah</button>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js"></script>
    <script defer src="script.js"></script>
</body>

</html>
