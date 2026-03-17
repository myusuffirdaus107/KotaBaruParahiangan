 @props([
    'contacts' => [
        ['name' => 'Tim Penjualan',    'number' => '082274226163', 'message' => 'Halo, saya ingin menanyakan tentang properti'],
        ['name' => 'Customer Service', 'number' => '082274226163', 'message' => 'Saya membutuhkan informasi lebih lanjut'],
    ]
])

<button class="wa-btn" id="waBtn"><i class="fab fa-whatsapp"></i></button>

<div class="wa-popup" id="waPopup">
    <div class="wa-head">
        <div class="ic"><i class="fab fa-whatsapp"></i></div>
        <p>Selamat Datang!<br>Hubungi kami via WhatsApp</p>
        <button class="wa-close-btn" id="waClose"><i class="fas fa-times"></i></button>
    </div>
    <div class="wa-contacts">
        @foreach($contacts as $contact)
        <div class="wa-contact">
            <div class="av"><i class="fas fa-user"></i></div>
            <div class="info">
                <p class="nm">{{ $contact['name'] }}</p>
                <p class="num">{{ $contact['number'] }}</p>
            </div>
            <a href="https://wa.me/{{ $contact['number'] }}?text={{ urlencode($contact['message']) }}"
               target="_blank" class="chat">Hubungi</a>
        </div>
        @endforeach
    </div>
</div>