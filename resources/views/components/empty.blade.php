@props([
    'label' => 'Nenhum resultado encontrado.',
    'span' => 100,
])
<tr>
    <td colspan="{{ $span }}">
        <div class="empty px-4 py-6 text-center">
            <i class="fa fa-box-open text-5xl text-gray-400"></i>
            <h4 class="mt-2 text-sm text-gray-800 font-semibold">{{ $label }}</h4>
        </div>
    </td>
</tr>
