const video = document.getElementById('video');
let modelsLoaded = false; // Flag untuk cek apakah model sudah selesai dimuat

// Aktifkan webcam sebelum model dimuat
async function startVideo() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
        console.log("✅ Webcam aktif!");
    } catch (err) {
        console.error("❌ Error mengakses webcam:", err);
    }
}

// Load models Face API.js setelah video dimulai
async function loadModels() {
    console.log("🔄 Memuat model...");
    await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
        faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/models') 
    ]);

    modelsLoaded = true;
    console.log("✅ Model selesai dimuat!");
}

// Simpan wajah ke Laravel  
async function saveFace() {
    if (!modelsLoaded) {
        alert("⚠️ Model belum selesai dimuat, coba lagi.");
        return;
    }

    // Deteksi wajah menggunakan tinyFaceDetector
    const detections = await faceapi.detectSingleFace(video, new faceapi.SsdMobilenetv1Options())
        .withFaceLandmarks()
        .withFaceDescriptor();

    if (!detections) {
        console.log("SSD gagal, mencoba Tiny Face Detector...");
        const detectionsTiny = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detectionsTiny) {
            alert('⚠️ Wajah tidak terdeteksi dari kedua model!');
            return;
        }

        console.log("Tiny Face Detector berhasil mendeteksi wajah.");
    }


    const descriptor = detections.descriptor;
    const name = prompt("📝 Masukkan nama:");

    if (!name) {
        alert("⚠️ Nama tidak boleh kosong!");
        return;
    }

    const response = await fetch('/api/face/store', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, face_descriptor: JSON.stringify(descriptor) }),
    });

    const data = await response.json();
    alert(`✅ ${data.message}`);
}

// Cocokkan wajah dengan database
async function matchFace() {
    if (!modelsLoaded) {
        alert("⚠️ Model belum selesai dimuat, coba lagi.");
        return;
    }

    const detections = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceDescriptor();

    if (!detections) {
        alert('⚠️ Wajah tidak terdeteksi!');
        return;
    }

    const descriptor = detections.descriptor;

    const response = await fetch('/api/face/match', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ face_descriptor: JSON.stringify(descriptor) }),
    });

    const data = await response.json();
    alert(`✅ Hasil: ${data.match}`);
}

// Load models & start webcam saat halaman dimuat
window.onload = async () => {
    await loadModels(); // Tunggu model selesai dimuat
    await startVideo();
};

// Event Listener untuk tombol
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById('saveFace').addEventListener('click', saveFace);
    document.getElementById('matchFace').addEventListener('click', matchFace);
});
