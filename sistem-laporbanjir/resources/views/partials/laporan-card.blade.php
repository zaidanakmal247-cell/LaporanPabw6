@php
    $status = '';
    $badgeClass = '';

    if ($laporan['tinggi_air'] < 30) {
        $status = 'Waspada';
        $badgeClass = 'bg-waspada';
    } elseif ($laporan['tinggi_air'] <= 70) {
        $status = 'Siaga';
        $badgeClass = 'bg-siaga';
    } else {
        $status = 'Awas';
        $badgeClass = 'bg-awas';
    }
@endphp

<div class="card" style="position: relative; margin-bottom: 15px; padding: 15px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div class="card-body">
        <p><strong>Nama Pelapor:</strong> {{ $laporan->nama_pelapor }}</p>
        <p><strong>Tinggi Genangan:</strong> {{ $laporan->tinggi_genangan }} cm</p>
        <p><strong>Lokasi:</strong> {{ $laporan->lokasi }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{ $laporan->tanggal_kejadian }}</p>
        
        {{-- Penentuan Status Genangan --}}
        @if ($laporan->tinggi_genangan >= 100)
            <span style="position: absolute; top: 15px; right: 15px; background-color: #dc3545; color: white; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 12px;">
                Status: Awas
            </span>
        @elseif ($laporan->tinggi_genangan >= 50)
            <span style="position: absolute; top: 15px; right: 15px; background-color: #ffc107; color: black; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 12px;">
                Status: Siaga
            </span>
        @else
            <span style="position: absolute; top: 15px; right: 15px; background-color: #0dcaf0; color: black; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 12px;">
                Status: Waspada
            </span>
        @endif
    </div>
</div>