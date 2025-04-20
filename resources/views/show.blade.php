<!-- untuk event -->
<img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="img-fluid mb-3">

<div>
    <h1>{{ $event->nama_event }}</h1>
    <p>{{ $event->deskripsi }}</p>
    <p><strong>Waktu:</strong> {{ $event->waktu->format('d-m-Y H:i') }}</p>
    <p><strong>Lokasi:</strong> {{ $event->lokasi }}</p>
</div>

<!-- untuk kegiatan -->
<img src="{{ Storage::url($kegiatan->banner_image) }}" alt="Banner" class="img-fluid mb-3">

<div>
    <h1>{{ $kegiatan->nama_kegiatan }}</h1>
    <p>{{ $kegiatan->deskripsi }}</p>
    <p><strong>Waktu:</strong> {{ $kegiatan->waktu->format('d-m-Y H:i') }}</p>
    <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi }}</p>
</div>
