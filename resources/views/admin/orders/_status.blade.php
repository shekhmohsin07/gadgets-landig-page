@php
    $cls = ['pending' => 'warning text-dark', 'confirmed' => 'info text-dark', 'shipped' => 'primary', 'delivered' => 'success', 'cancelled' => 'secondary'][$status] ?? 'secondary';
@endphp
<span class="badge bg-{{ $cls }}">{{ \App\Models\Order::STATUSES[$status] ?? $status }}</span>
